<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\Imagen;
use App\Form\ImagenType;

class ImagenController extends AbstractController
{
    /**
     * @Route("/imagen", name="imagen")
     */


    public function createImagen(Request $request){
        $imagen = new Imagen();
        $form = $this->createForm(ImagenType::class, $imagen);  

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($imagen);
            $entityManager->flush(); 

            //Session flag
            $session = new Session();
            $session->getFlashBag()->add('mensaje', 'Imagen creada');

            return $this->redirectToRoute('crear_imagen');

        }

        return $this->render('imagen/crearImagen.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function index()
    {
        $imagen_repo = $this->getDoctrine()->getRepository(Imagen::class);

        //$imagenes = $imagen_repo->findAll();

        // Me saca un valor de la base de datos según la condición, aunque existan varios sólo trae uno
        // $imagen = $imagen_repo->findOneBy([
        //     'nombre' => 'imagen2' //Condición
        // ]);


        // Me saca los valores que coincidan con la condición, todos los que haya en la base de datos
        // $imagen = $imagen_repo->findBy([
        //     'nombre' => 'imagen2'
        // ], [
        //     'id' => 'DESC' //Ordena la entrega de los registros en pantalla de manera descendente
        // ]);
        
        //SQL -> sentencia para traer los datos de la bd en la tabla imagen
        // $connection = $this->getDoctrine()->getConnection();
        // $sql = 'SELECT *FROM imagen ORDER BY id ASC';
        // $prepare = $connection->prepare($sql);
        // $prepare->execute();
        // $resultset = $prepare->fetchAll();

        //Repository
        // $imagenes = $imagen_repo->getImageByName('DESC');
        // var_dump($imagenes);
        
        return $this->render('imagen/index.html.twig', [
            'controller_name' => 'ImagenController',
            // 'imagenes' => $imagenes
        ]);
    }

    public function save(){

        //Obtener datos del formulario



        // //Guardar en tabla de base de datos
        // $entityManager = $this->getDoctrine()->getManager();

        // //Creo objeto y le doy valores
        // $imagen = new Imagen();
        // $imagen->setNombre('imagen5');
        // $imagen->setDescripcion('imagen de prueba, a ver qué pasa');

        // //Persiste el objeto en doctrine
        // $entityManager->persist($imagen);

        // //Mandar a tabla de bd
        // $entityManager->flush();

        // return new Response('Se guardo la imagen con el id '.$imagen->getId());
    }

    public function imagen(Imagen $imagen){
        // //Buscar en base de datos
        // //Cargar un repositorio
        // $imagen_repo = $this->getDoctrine()->getRepository(Imagen::class);

        // //Consulta
        // $imagen = $imagen_repo->find($id);

        //Comprobar resultado
        if (!$imagen) {
            $message = 'La imagen no existe';
        }else{
            $message = 'Has elegido la imagen: '.$imagen->getNombre().'-'.$imagen->getDescripcion();
        }

        return new Response($message);

    }

    public function update($id){
        //Cargar doctrine
        $doctrine = $this->getDoctrine();

        //Cargar entityManager
        $entityManager = $doctrine->getManager();

        //Cargar repo
        $imagen_repo = $entityManager->getRepository(Imagen::class);

        //Find para conseguir el objeto
        $imagen = $imagen_repo->find($id);

        //Comprobar si llega el objeto
        if(!$imagen){
            $message = 'La imagen no existe en la BD';
        }else{
            //Asignar valores a objeto conseguido
            $imagen->setNombre('Nombre cambiado');
            $imagen->setDescripcion('Descripcion cambiada');

            //Persistir el objeto 
            $entityManager->persist($imagen);

            //Guardar en BD
            $entityManager->flush();
            $message = 'Se actualizó el registro con éxito'.$imagen->getID();
        }

        //Responde
        return new Response($message);

    }

    public function delete(Imagen $imagen){

        $entityManager = $this->getDoctrine()->getManager();

        if ($imagen && is_object($imagen)) {
            $entityManager->remove($imagen);
            $entityManager->flush();

            $mesaage = 'Imagen borrado correctamente';
        }else{
            $message = 'No se encuentra la imagen';
        }

        return new Response($mesaage);

    }


}
