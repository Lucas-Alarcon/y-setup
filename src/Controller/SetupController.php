<?php

namespace App\Controller;

use App\Entity\Setup;
use App\Form\SetupType;
use App\Repository\SetupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/setup")
 */
class SetupController extends AbstractController
{
    /**
     * @Route("/", name="setup_index", methods={"GET"})
     */
    public function index(SetupRepository $setupRepository): Response
    {
        return $this->render('setup/index.html.twig', [
            'setups' => $setupRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="setup_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $setup = new Setup();
        $form = $this->createForm(SetupType::class, $setup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($setup);
            $entityManager->flush();

            return $this->redirectToRoute('setup_index');
        }

        return $this->render('setup/new.html.twig', [
            'setup' => $setup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="setup_show", methods={"GET"})
     */
    public function show(Setup $setup): Response
    {
        return $this->render('setup/show.html.twig', [
            'setup' => $setup,
            'equipments' => $setup->getEquipments(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="setup_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Setup $setup): Response
    {
        $form = $this->createForm(SetupType::class, $setup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('setup_index');
        }

        return $this->render('setup/edit.html.twig', [
            'setup' => $setup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="setup_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Setup $setup): Response
    {
        if ($this->isCsrfTokenValid('delete'.$setup->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($setup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('setup_index');
    }
}
