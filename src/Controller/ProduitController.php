<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Pays;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use App\Repository\SouspaysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/produit')]
final class ProduitController extends AbstractController
{
    #[Route( '/getSouspays',name: 'get_souspays',  methods: ['GET'])]
    public function getSouspays(Request $request, SouspaysRepository $souspaysRepository): JsonResponse
    {
        $idPays = $request->query->get('IDPAYS');
        $souspays = $souspaysRepository->findBy(['IDPAYS' => $idPays]);

        $response = [];
        foreach ($souspays as $sp) {
            $response[] = [
                'id' => $sp->getSEQSOUSPAYS(),
                'name' => $sp->getLIBSOUSPAYS(),
            ];
        }

        return new JsonResponse($response);
    }
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
        // Récupérer la liste des pays
        $paysList = $entityManager->getRepository(Pays::class)->findAll();

        // Récupérer les paramètres de requête
        $codeProd = $request->query->get('codeprod');
        $libProd = $request->query->get('libprod');
        $pays = $request->query->get('pays');

        // Construire la requête
        $queryBuilder = $produitRepository->createQueryBuilder('p')
            ->leftJoin('p.IDPAYS', 'pays')
            ->leftJoin('p.SEQSOUSPAYS', 'souspays') // Assurez-vous de faire un join ici
            ->addSelect('pays', 'souspays'); // Inclure aussi souspays

        // Filtrer par code produit si fourni
        if ($codeProd) {
            $queryBuilder->andWhere('p.CODEPROD LIKE :codeprod')
                ->setParameter('codeprod', '%' . $codeProd . '%');
        }

        // Filtrer par libellé produit si fourni
        if ($libProd) {
            $queryBuilder->andWhere('p.LIBPROD LIKE :libprod')
                ->setParameter('libprod', '%' . $libProd . '%');
        }

        // Filtrer par pays si fourni
        if ($pays) {
            $queryBuilder->andWhere('pays.IDPAYS = :pays')
                ->setParameter('pays', $pays);
        }

        // Exécuter la requête
        $query = $queryBuilder->getQuery();

        try {
            $produits = $query->getArrayResult();

            // Vérifier si des produits ont été trouvés
            if (empty($produits)) {
                $produits = []; // Vous pouvez également ajouter un message informatif ici
            }
        } catch (\Exception $e) {
            // Gérer l'erreur (journalisation, message d'erreur, etc.)
            var_dump($e->getMessage());
            die();
        }

        // Rendre la vue
        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
            'paysList' => $paysList,
        ]);
    }


    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        // Récupérer le produit avec la plus grande valeur de codeprod
        $query = $entityManager->createQuery(
            'SELECT p 
         FROM App\Entity\Produit p 
         WHERE p.CODEPROD IS NOT NULL 
         ORDER BY p.CODEPROD DESC'
            )
            ->setMaxResults(1);
        $dernierProduit = $query->getOneOrNullResult();

        // Générer le prochain codeprod
        if ($dernierProduit) {
            $dernierCodeprod = $dernierProduit->getCodeprod();
            // Extraire le numéro et l'incrémenter
            $numero = (int)substr($dernierCodeprod, 1); // Extrait la partie numérique (sans le "H")
            $nouveauCodeprod = 'H' . str_pad($numero + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Si aucun produit n'existe encore, commencer par H0001
            $nouveauCodeprod = 'H0001';
        }

        // Assigner la valeur générée à l'entité Produit
        $produit->setCodeprod($nouveauCodeprod);

        // Création du formulaire
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
        if ($this->isCsrfTokenValid('delete' . $produit->getSEQPROD(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
