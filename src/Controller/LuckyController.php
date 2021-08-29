<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky/number", methods = {"GET"})
     */
    public function number(): Response

    {
        $number = random_int(1, 4);

        $entityManager = $this->getDoctrine()->getManager();
        $empleado = $entityManager->find('App\Entity\Empleado', $number);

        return $this->render('lucky/number.html.twig', [
            'number' => $empleado->getNombre()
        ]);
    }

}