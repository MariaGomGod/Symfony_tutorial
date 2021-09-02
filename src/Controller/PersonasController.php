<?php

namespace App\Controller;

use App\Entity\Persona;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

const CLASE_PERSONA = 'App\Entity\Persona';

class PersonasController extends AbstractController {

   /**
    * @Route("/personas", name="get_personas", methods={"GET"})
    */
    public function getPersonas(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository(CLASE_PERSONA);
        $personas = $repository->findBy(['activo' => true]);

        return $this->render('lucky/persona.html.twig', [
            'Personas' => $personas
        ]);
    }

    /**
    * @Route("/personas/{id}", name="get_una_persona", methods={"GET"})
    */
    public function getUnaPersona(int $id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $persona = $entityManager->find(CLASE_PERSONA, $id);

        $data = [
            'id_persona' => $persona->getIdPersona(),
            'nombre' => $persona->getNombre(),
            'rubia' => $persona->getRubia(),
            'alta' => $persona->getAlta(),
            'gafas' => $persona->getGafas(),
            'activo' => $persona->getActivo(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
    * @Route("/personas", name="post_persona", methods={"POST"})
    */
    public function addPersona(Request $request): JsonResponse
    {
        
        $data = json_decode($request->getContent(), true);

        if (!isset($data['nombre']) || !isset($data['rubia']) ||
            !isset($data['alta']) || !isset($data['gafas'])) {
                throw new NotFoundHttpException('Error de validación!');
        }

        $persona = new Persona();
        $persona->setNombre($data['nombre'])
                ->setRubia($data['rubia'])
                ->setAlta($data['alta'])
                ->setGafas($data['gafas'])
                ->setActivo(true);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($persona);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Persona creada!'], Response::HTTP_CREATED);
    }

    /**
    * @Route("/personas/{id}", name="update_persona", methods={"PUT"})
    */
    public function updatePersona(int $id, Request $request): JsonResponse
    {
        $entityManager= $this->getDoctrine()->getManager();
        $persona = $entityManager->find(CLASE_PERSONA, $id);

        if (!empty($persona)) {

            $data = json_decode($request->getContent(), true);

            empty($data['nombre']) ? true : $persona->setNombre($data['nombre']);
            empty($data['rubia']) ? true : $persona->setRubia($data['rubia']);
            empty($data['alta']) ? true : $persona->setAlta($data['alta']);
            empty($data['gafas']) ? true : $persona->setGafas($data['gafas']);
            
            $entityManager->flush();
        }

        return new JsonResponse(['status' => 'Persona modificada!'], Response::HTTP_NO_CONTENT);
    }

    /**
    * @Route("/personas/{id}/activo", name="update_to_active_persona", methods={"PUT"})
    */
    public function updateToActivePersona(int $id, Request $request): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $persona = $entityManager->find(CLASE_PERSONA, $id);

        if (!empty($persona)) {

            $persona->setActivo(true);
            $entityManager->flush();
        }

        return new JsonResponse(['status' => 'Empleado activado!'], Response::HTTP_NO_CONTENT);
    }

    /**
    * @Route("/personas/{id}", name="delete_persona", methods={"DELETE"})
    */
    public function deletePersona(int $id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $persona = $entityManager->find(CLASE_PERSONA, $id);

        if (!empty($persona)) {

            $persona->setActivo(false);
            $entityManager->flush();
        }

        return new JsonResponse(['status' => 'persona borrada!'], Response::HTTP_NO_CONTENT);
    }
}