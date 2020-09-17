<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use App\Repository\PersonneRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/personne")
 */
class PersonneController extends AbstractController
{
//    /**
//     * @Route("/", name="personne_index", methods={"GET"})
//     */
//    public function index(PersonneRepository $personneRepository): Response
//    {
//        return $this->render('personne/index.html.twig', [
//            'personnes' => $personneRepository->findAll(),
//        ]);
//    }

    /**
     * @Route("/", name="personne_new", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function new(Request $request, SerializerInterface $serializer): Response
    {
        $data=$request->getContent();

        $personne=$serializer->deserialize($data, Personne::class,'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($personne);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);

        /*$personne = new Personne();
        $form = $this->createForm(PersonneType::class, $personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personne);
            $entityManager->flush();

            return $this->redirectToRoute('personne_index');
        }

        return $this->render('personne/new.html.twig', [
            'personne' => $personne,
            'form' => $form->createView(),
        ]);*/
    }

    /**
     * @Route("/show/{id}", name="personne_show", methods={"GET"})
     * @param Personne $personne
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function show(Personne $personne,SerializerInterface $serializer): Response
    {

        $data= $serializer->serialize($personne,'json');

       /* dump($data);

        return false;*/

        $response= new Response($data);

        $response->headers->set('Content-Type','application/json');

        return $response;

        /*return $this->render('personne/show.html.twig', [
            'personne' => $personne,
        ]);*/
    }

//    /**
//     * @Route("/{id}/edit", name="personne_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, Personne $personne): Response
//    {
//        $form = $this->createForm(PersonneType::class, $personne);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('personne_index');
//        }
//
//        return $this->render('personne/edit.html.twig', [
//            'personne' => $personne,
//            'form' => $form->createView(),
//        ]);
//    }

//    /**
//     * @Route("/{id}", name="personne_delete", methods={"DELETE"})
//     */
//    public function delete(Request $request, Personne $personne): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$personne->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($personne);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('personne_index');
//    }
}
