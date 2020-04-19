<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Imagen;

class ImagenController extends AbstractController
{
    /**
     * @Route("/imagen", name="imagen")
     */
    public function index()
    {
        return $this->render('imagen/index.html.twig', [
            'controller_name' => 'ImagenController',
        ]);
    }

    public function save(){
        //Guardar en tabla de base de datos
        $entityManager = $this->getDoctrine()->getManager();

        //Creo objeto y le doy valores
        $imagen = new Imagen();
        $imagen->setNombre('imagen1');
        $imagen->setDescripcion('imagen de prueba, a ver qué pasa');

        //Persiste el objeto en doctrine
        $entityManager->persist($imagen);

        //Mandar a tabla de bd
        $entityManager->flush();

        return new Response('Se guardo la imagen con el id '.$imagen->getId());
    }
}
