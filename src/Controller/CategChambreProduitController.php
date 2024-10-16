<?php

namespace App\Controller;

use App\Entity\CategChambreProduit;
use App\Form\CategChambreProduitType;
use App\Repository\CategChambreProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/categchambreproduit')]
final class CategChambreProduitController extends AbstractController
{
    #[Route(name: 'app_categ_chambre_produit_index', methods: ['GET'])]
    public function index(CategChambreProduitRepository $categChambreProduitRepository): Response
    {
        return $this->render('categ_chambre_produit/index.html.twig', [
            'categ_chambre_produits' => $categChambreProduitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categ_chambre_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categChambreProduit = new CategChambreProduit();
        $form = $this->createForm(CategChambreProduitType::class, $categChambreProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categChambreProduit);
            $entityManager->flush();

            return $this->redirectToRoute('app_categ_chambre_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categ_chambre_produit/new.html.twig', [
            'categ_chambre_produit' => $categChambreProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{SEQCATEGCHAMBREPRODUIT}', name: 'app_categ_chambre_produit_show', methods: ['GET'])]
    public function show(CategChambreProduit $categChambreProduit): Response
    {
        return $this->render('categ_chambre_produit/show.html.twig', [
            'categ_chambre_produit' => $categChambreProduit,
        ]);
    }

    #[Route('/{SEQCATEGCHAMBREPRODUIT}/edit', name: 'app_categ_chambre_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategChambreProduit $categChambreProduit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategChambreProduitType::class, $categChambreProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categ_chambre_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categ_chambre_produit/edit.html.twig', [
            'categ_chambre_produit' => $categChambreProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{SEQCATEGCHAMBREPRODUIT}', name: 'app_categ_chambre_produit_delete', methods: ['POST'])]
    public function delete(Request $request, CategChambreProduit $categChambreProduit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categChambreProduit->getSEQCATEGCHAMBREPRODUIT(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($categChambreProduit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categ_chambre_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
