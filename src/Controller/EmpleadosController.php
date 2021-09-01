<?php

namespace App\Controller;

use App\Entity\Empleado;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

const CLASE_EMPLEADO = 'App\Entity\Empleado';

class EmpleadosController extends AbstractController {

    /**
    * @Route("/empleados", name="get_empleados", methods={"GET"})
    */
    public function getEmpleados(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository(CLASE_EMPLEADO);
        $empleados = $repository->findBy(['activo' => true]);

        return $this->render('lucky/empleado.html.twig', [
            'Empleados' => $empleados
        ]);
    }

    /**
    * @Route("/empleados/{id}", name="get_un_empleado", methods={"GET"})
    */
    public function getUnEmpleado(int $id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
       
        $empleado = $entityManager->find(CLASE_EMPLEADO, $id);

        $data = [
            'id_empleado' => $empleado->getIdEmpleado(),
            'nombre' => $empleado->getNombre(),
            'apellidos' => $empleado->getApellidos(),
            'f_nacimiento' => $empleado->getFNacimiento(),
            'sexo' => $empleado->getSexo(),
            'cargo' => $empleado->getCargo(),
            'salario' => $empleado->getSalario(),
            'activo' => $empleado->getActivo(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
    * @Route("/empleados", name="add_empleado", methods={"POST"})
    */
    public function addEmpleado(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['nombre']) || empty($data['apellidos']) || empty($data['f_nacimiento']) ||
        empty($data['sexo']) || empty($data['cargo']) || empty($data['salario'])) {

            throw new NotFoundHttpException('Error de validación!');
        }

        $empleado = new Empleado();
        $empleado->setNombre($data['nombre'])
                 ->setApellidos($data['apellidos'])
                 ->setFNacimiento($data['f_nacimiento'])
                 ->setSexo($data['sexo'])
                 ->setCargo($data['cargo'])
                 ->setSalario($data['salario'])
                 ->setActivo(true);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($empleado);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Empleado creado!'], Response::HTTP_CREATED);
    }

    /**
    * @Route("/empleados/{id}", name="update_empleado", methods={"PUT"})
    */
    public function updateEmpleado(int $id, Request $request): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $empleado = $entityManager->find(CLASE_EMPLEADO, $id);

        if (!empty($empleado)) {

            $data = json_decode($request->getContent(), true);

            empty($data['nombre']) ? true : $empleado->setNombre($data['nombre']);
            empty($data['apellidos']) ? true : $empleado->setApellidos($data['apellidos']);
            empty($data['f_nacimiento']) ? true : $empleado->setFNacimiento($data['f_nacimiento']);
            empty($data['sexo']) ? true : $empleado->setSexo($data['sexo']);
            empty($data['cargo']) ? true : $empleado->setCargo($data['cargo']);
            empty($data['salario']) ? true : $empleado->setSalario($data['salario']);

            $entityManager->flush();
        }

        return new JsonResponse(['status' => 'Empleado modificado!'], Response::HTTP_NO_CONTENT);
    }

    /**
    * @Route("/empleados/{id}/activo", name="update_to_active_empleado", methods={"PUT"})
    */
    public function updateToActiveEmpleado(int $id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $empleado = $entityManager->find(CLASE_EMPLEADO, $id);
        
        if (!empty($empleado)) {

            $empleado->setActivo(true);
            $entityManager->flush();
        }

        return new JsonResponse(['status' => 'Empleado activado!'], Response::HTTP_NO_CONTENT);

    }

    /**
    * @Route("/empleados/{id}", name="delete_empleado", methods={"DELETE"})
    */
    public function deleteEmpleado(int $id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $empleado = $entityManager->find(CLASE_EMPLEADO, $id);
        
        if (!empty($empleado)) {

            $empleado->setActivo(false);
            $entityManager->flush();
        }

        return new JsonResponse(['status' => 'Empleado borrado!'], Response::HTTP_NO_CONTENT);

    }
}
