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

        return $this->renderForm('formData/new.html.twig', [
            'form' => $form,
        ]);
    }
}
