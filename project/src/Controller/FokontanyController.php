<?php

namespace App\Controller;

use App\Entity\Fokontany;
use App\Form\FokontanyType;
use App\Repository\FokontanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fokontany')]
class FokontanyController extends AbstractController
{
    #[Route('/', name: 'app_fokontany_index', methods: ['GET'])]
    public function index(FokontanyRepository $fokontanyRepository): Response
    {
        return $this->render('fokontany/index.html.twig', [
            'fokontanies' => $fokontanyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fokontany_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fokontany = new Fokontany();
        $form = $this->createForm(FokontanyType::class, $fokontany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fokontany);
            $entityManager->flush();

            return $this->redirectToRoute('app_fokontany_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fokontany/new.html.twig', [
            'fokontany' => $fokontany,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fokontany_show', methods: ['GET'])]
    public function show(Fokontany $fokontany): Response
    {
        return $this->render('fokontany/show.html.twig', [
            'fokontany' => $fokontany,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fokontany_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fokontany $fokontany, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FokontanyType::class, $fokontany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fokontany_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fokontany/edit.html.twig', [
            'fokontany' => $fokontany,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fokontany_delete', methods: ['POST'])]
    public function delete(Request $request, Fokontany $fokontany, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fokontany->getId(), $request->request->get('_token'))) {
            $entityManager->remove($fokontany);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fokontany_index', [], Response::HTTP_SEE_OTHER);
    }
}
