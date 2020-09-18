<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use App\Repository\PersonneRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/personne")
 * @method view(\Symfony\Component\Validator\ConstraintViolationListInterface $errors, int $HTTP_BAD_REQUEST)
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
     * @Rest\Post(
     *     path="/nouveau",
     *     name="personne_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("personne", converter="fos_rest.request_body")
     * @param Personne $personne
     * @param ConstraintViolationList $violations
     * @return string
     */
    public function createAction(Personne $personne, ConstraintViolationList $violations)
    {
        //$errors = $validator->validate($personne);

        if (count($violations)) {

            return (string) $violations;
            //return $this->view($errors, Response::HTTP_BAD_REQUEST);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($personne);
        $em->flush();

        return $personne;
        /*
        return $this->view($personne, Response::HTTP_CREATED, ['Location' =>
            $this->generateUrl('personne_show', ['id' => $personne->getId(), UrlGeneratorInterface::ABSOLUTE_URL])]);*/

    }

//    /**
//     * @Route("/", name="personne_new", methods={"POST"})
//     * @param Request $request
//     * @param SerializerInterface $serializer
//     * @return Response
//     */
//    public function new(Request $request, SerializerInterface $serializer): Response
//    {
//        $data=$request->getContent();
//
//        $personne=$serializer->deserialize($data, Personne::class,'json');
//
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($personne);
//        $em->flush();
//
//        return new Response('', Response::HTTP_CREATED);
//
//        /*$personne = new Personne();
//        $form = $this->createForm(PersonneType::class, $personne);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($personne);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('personne_index');
//        }
//
//        return $this->render('personne/new.html.twig', [
//            'personne' => $personne,
//            'form' => $form->createView(),
//        ]);*/
//    }

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
