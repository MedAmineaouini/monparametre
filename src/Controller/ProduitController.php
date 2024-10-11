<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Pays;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/produit')]
final class ProduitController extends AbstractController
{
//    #[Route(name: 'app_produit_index', methods: ['GET'])]
//    public function index(Request $request, ProduitRepository $produitRepository, EntityManagerInterface $entityManager): Response
//
//    {
//        $paysList = $entityManager->getRepository(Pays::class)->findAll();
//        return $this->render('produit/index.html.twig', [
//            'produits' => $produitRepository->findAll(),
//            'paysList' => $paysList,
//
//        ]);
//    }
    #[Route(name: 'app_produit_index', methods: ['GET'])]
    public function index2(Request $request, ProduitRepository $produitRepository, EntityManagerInterface $entityManager): Response
    {
        $paysList = $entityManager->getRepository(Pays::class)->findAll();
        $codeProd = $request->query->get('codeprod');
        $libProd = $request->query->get('libprod');
        $pays = $request->query->get('pays');

        $queryBuilder = $produitRepository->createQueryBuilder('p')
            ->leftJoin('p.IDPAYS', 'pays')
            ->addSelect('pays');
//        if ($codeProd) {
//            $queryBuilder->andWhere('p.SEQPROD LIKE :codeprod')
//                ->setParameter('codeprod', '%'.$codeProd.'%');
//        }

        if ($libProd) {
            $queryBuilder->andWhere('p.LIBPROD LIKE :libprod')
                ->setParameter('libprod', '%'.$libProd.'%');
        }

        if ($pays) {
            $queryBuilder->andWhere('pays.LIBPAYS LIKE :pays')
                ->setParameter('pays', '%'.$pays.'%');
        }
        $query = $queryBuilder->getQuery();
        $sql = $query->getSQL(); // Obtenir la requête SQL

        // Afficher la requête dans un dump

        // Récupérer les résultats de la requête
//        $produits = $query->getResult();

        //$produits = $queryBuilder->getQuery()->getResult();
        return $this->render('produit/index.html.twig', [
            'query' => $sql,
            'paysList' => $paysList,
        ]);
    }

    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{SEQPROD}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{SEQPROD}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{SEQPROD}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getSEQPROD(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
