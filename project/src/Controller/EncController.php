<?php

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class EncController extends AbstractController
{



    #[Route('/', name: 'app.home')]
    public function index() : Response
    {
        return $this->render("pages/enc/index.html.twig");
    }




}
