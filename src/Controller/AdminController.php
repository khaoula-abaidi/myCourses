<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 26/03/2019
 * Time: 22:46
 */

namespace App\Controller;


use App\Entity\Contributor;
use App\Repository\ContributorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @var ContributorRepository
     */
    private $repository;
    public function __construct(ContributorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("user/admin", name="admin_index_page")
     * @return Response
     */
    public function index(): Response{
        $users = $this->repository->findAll();
        return $this->render('admin/contributor/index.html.twig',compact('users'));
    }

    /**
     * @Route("/user/admin/edit/{id}", name = "admin_edit_page")
     * @return Response
     */
    public function edit(Contributor $user):Response{
        $form = $this->createForm(ContributorType::class,$user);
        return $this->render('admin/contributor/edit.html.twig',[
            'user'=>$user,
            'form'=>$form->createView()]);

    }

}