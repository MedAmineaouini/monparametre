<?php

namespace App\Controller;

use App\Entity\Souspays;
use App\Form\Souspays1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/souspays')]
final class SouspaysController extends AbstractController
{
    #[Route(name: 'app_souspays_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $query = $entityManager->createQuery(
            'SELECT s, p
        FROM App\Entity\Souspays s
        JOIN s.IDPAYS p'
        )
            ->setMaxResults(200); // Limite à 200 résultats

        $souspays = $query->getResult();

        return $this->render('souspays/index.html.twig', [
            'souspays' => $souspays,
        ]);
    }

    #[Route('/new', name: 'app_souspays_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $souspay = new Souspays();
        $form = $this->createForm(Souspays1Type::class, $souspay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($souspay);
            $entityManager->flush();

            return $this->redirectToRoute('app_souspays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('souspays/new.html.twig', [
            'souspay' => $souspay,
            'form' => $form,
        ]);
    }

    #[Route('/{SEQSOUSPAYS}', name: 'app_souspays_show', methods: ['GET'])]
    public function show(Souspays $souspay): Response
    {
        return $this->render('souspays/show.html.twig', [
            'souspay' => $souspay,
        ]);
    }

    #[Route('/{SEQSOUSPAYS}/edit', name: 'app_souspays_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Souspays $souspay, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Souspays1Type::class, $souspay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_souspays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('souspays/edit.html.twig', [
            'souspay' => $souspay,
            'form' => $form,
        ]);
    }

    #[Route('/{SEQSOUSPAYS}', name: 'app_souspays_delete', methods: ['POST'])]
    public function delete(Request $request, Souspays $souspay, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$souspay->getSEQSOUSPAYS(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($souspay);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_souspays_index', [], Response::HTTP_SEE_OTHER);
    }
}
