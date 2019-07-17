<?php

namespace App\Controller;

use App\Entity\Performance;
use App\Form\PerformanceType;
use App\Repository\PerformanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class PerformanceController extends AbstractController
{
    /**
     * @Route("/performance", name="performance_index", methods={"GET"})
     */
    public function index(PerformanceRepository $performanceRepository): Response
    {
        return $this->render('performance/index.html.twig', [
            'performances' => $performanceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/performance/new", name="performance_new", methods={"GET","POST"})
     */
    public function new(Request $request, \Swift_Mailer $mailer): Response
    {
        $performance = new Performance();
        $form = $this->createForm(PerformanceType::class, $performance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($performance);
            $entityManager->flush();

            $message = (new \Swift_Message('Une nouvelle performance vient d\'être annoncée !'))
                ->setFrom($this->getParameter('mailer_from'))
                ->setTo($this->getParameter('mailer_from'))
                ->setBody($this->renderView('performance/email/notification.html.twig',
                    ['performance' => $performance,
                        'name' => $this->getParameter('mailer_from')]),
                    'text/html'
                );
            ;
            $mailer->send($message);

            return $this->redirectToRoute('performance_index');
        }

        return $this->render('performance/new.html.twig', [
            'performance' => $performance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/performance/{id}", name="performance_show", methods={"GET"})
     */
    public function show(Performance $performance): Response
    {
        return $this->render('performance/show.html.twig', [
            'performance' => $performance,
        ]);
    }

    /**
     * @Route("/performance/{id}/edit", name="performance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Performance $performance): Response
    {
        $form = $this->createForm(PerformanceType::class, $performance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('performance_index');
        }

        return $this->render('performance/edit.html.twig', [
            'performance' => $performance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/performance/{id}", name="performance_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Performance $performance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$performance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($performance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('performance_index');
    }
}
