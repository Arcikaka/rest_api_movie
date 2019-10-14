<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class MovieController extends Controller
{
    /**
     * @Route("/api/", name="show_all", methods="GET")
     * On this Route you will get information about all movies in database
     * All records are in Json thanks to Serializer
     */
    public function showAllMoviesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Movie');
        $movies = $repo->findAll();

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $movieJson = $serializer->serialize($movies, 'json');

        return $this->render('movies.html.twig', ['movies' => $movieJson]);
    }

    /**
     * @param $id
     * @Route("/api/{id}/", name="show_movie_by_id", methods="GET")
     * @return Response
     * On this Route you will get information about single record from database
     * If record is not in database you will get proper information
     * All records are in Json thanks to Serializer
     */
    public function showMovieByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Movie');

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $movie = $repo->find($id);
        // if $movie is empty proper information is send
        if (empty($movie)) {
            $message =array("Message" => "Movie on this id not found");
            $jsonMessage = $serializer->serialize($message, 'json');
            return $this->render('movieById.html.twig', ['movie' => $jsonMessage]);
        }
        $jsonMovie = $serializer->serialize($movie, 'json');

        return $this->render('movieById.html.twig', ['movie' => $jsonMovie]);

    }
}
