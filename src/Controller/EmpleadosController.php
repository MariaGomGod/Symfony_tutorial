<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmpleadosController extends AbstractController {

    /**
     * @Route("/empleados", name = "get_empleado", methods = {"GET"})
     */
    public function getEmpleados(): Response 
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository(Empleado::class);
        $empleados = $repository->findAll();

        return $this->render('lucky/empleado.html.twig', [
            'Empleados' => $empleados
        ]);
    }

    /**
     * @Route("/empleados/{id}", name = "delete_empleado", methods = {"DELETE"})
     */
    public function removeEmpleado(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $empleado = $entityManager->find(Empleado::class, $id);
        $entityManager->remove($empleado);
        $entityManager->flush();
       
        return new JsonResponse(Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/empleados/{id}", name = "update_empleado", methods = {"PUT"})
     */
    public function updateEmpleado(int $id, Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $empleado = $entityManager->find(Empleado::class, $id);
        $data = json_decode($request->getContent(), true);

        empty($data['nombre']) ? true : $empleado->setNombre($data['nombre']);
        empty($data['apellidos']) ? true : $empleado->setApellidos($data['apellidos']);
        empty($data['f_nacimiento']) ? true : $empleado->setFNacimiento($data['f_nacimiento']);
        empty($data['sexo']) ? true : $empleado->setSexo($data['sexo']);
        empty($data['cargo']) ? true : $empleado->setCargo($data['cargo']);
        empty($data['salario']) ? true : $empleado->setSalario($data['salario']);

        $entityManager->flush();

        return new Response();
        
    }
}