<?php

namespace App\Controller;

use App\Form\FormDataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FormData;
use Symfony\Component\HttpFoundation\Request;

class FormDataController extends AbstractController
{
    /**
     * @Route("/", name="form_data")
     */
    public function new(Request $request): Response
    {
        $formData = new FormData();
        $form = $this->createForm(FormDataType::class, $formData);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formData);
            $em->flush();

            return $this->redirectToRoute('form_success', [
            ]);
        }


        return $this->renderForm('formData/new.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route ("/success", name="form_success")
     * @param Request $request
     * @return string
     */
    public function success(Request $request)
    {
        return $this->render('formData/success.html.twig');
    }
}
