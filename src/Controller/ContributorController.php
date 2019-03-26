<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 26/03/2019
 * Time: 20:49
 */

namespace App\Controller;


use App\Entity\Contributor;
use App\Repository\ContributorRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContributorController extends AbstractController
{
   private $repository;
  // private $em;
    /**
     * ContributorController constructor.
     * @param ContributorRepository $repository
     */
    public function __construct(ContributorRepository $repository)
    {
    $this->repository = $repository;
    //$this->em = $em;
    }

    /**
     * @Route("/",  name="home_contributor_page")
     * @return Response
     */
    public function home():Response
    {
        /**
         * Avant utilisation autowinring
         * $repository = $this->getDoctrine()->getRepository(Contributor::class);
        dump($repository);
         */
        $contributors =$this->repository->findAll() ;
        /**$contributors[3]->setPwd('ccsd');*/
        return $this->render('index/index.html.twig',[
           'contributors' => $contributors
        ]);
    }

    /**
     * @Route("/user/show/{id}", name ="show_contributor_page")
     * @param $id
     * @return Response
     */
    public function show($id):Response
    {
        $contributor =$this->repository->find($id) ;
        return $this->render('index/show.html.twig',[
            'contributor' => $contributor
        ]);
    }
    /**
     * @Route("/user/login",  name="login_page")
     * @return Response
     */
    public function add()  : Response
    {
        $user  = new Contributor();
        $user->setLogin('khaoula-abaidi')
            ->setPwd('a230110*')
            ->setIsAdmin(false);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->render('index/home.html.twig');
    }
}