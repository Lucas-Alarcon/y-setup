<?php

namespace App\Controller;

use App\Entity\Youtubeur;
use App\Form\YoutubeurType;
use App\Repository\YoutubeurRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/youtubeur")
 */
class YoutubeurController extends AbstractController
{
    /**
     * @Route("/", name="youtubeur_index", methods={"GET"})
     */
    public function index(YoutubeurRepository $youtubeurRepository): Response
    {
        return $this->render('youtubeur/index.html.twig', [
            'youtubeurs' => $youtubeurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="youtubeur_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $youtubeur = new Youtubeur();
        $form = $this->createForm(YoutubeurType::class, $youtubeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            if ($image) {
                $imageFileName = $fileUploader->upload($image, 'images_youtubeurs_directory');
                $youtubeur->setImage($imageFileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($youtubeur);
            $entityManager->flush();

            return $this->redirectToRoute('youtubeur_index');
        }

        return $this->render('youtubeur/new.html.twig', [
            'youtubeur' => $youtubeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="youtubeur_show", methods={"GET"})
     */
    public function show(Youtubeur $youtubeur): Response
    {
        return $this->render('youtubeur/show.html.twig', [
            'youtubeur' => $youtubeur,
            'setups' => $youtubeur->getSetups(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="youtubeur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Youtubeur $youtubeur): Response
    {
        $form = $this->createForm(YoutubeurType::class, $youtubeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('youtubeur_index');
        }

        return $this->render('youtubeur/edit.html.twig', [
            'youtubeur' => $youtubeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="youtubeur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Youtubeur $youtubeur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$youtubeur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($youtubeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('youtubeur_index');
    }
}
