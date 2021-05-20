<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use App\Repository\StudioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $repoMovie;
    private $repoActor;
    private $repoGenre;
    private $repoStudio;

    /**
     * HomeController constructor.
     * @param MovieRepository $repoMovie
     * @param ActorRepository $repoActor
     * @param GenreRepository $repoGenre
     * @param StudioRepository $repoStudio
     */
    public function __construct(MovieRepository $repoMovie, ActorRepository $repoActor, GenreRepository $repoGenre, StudioRepository $repoStudio)
    {
        $this->repoMovie = $repoMovie;
        $this->repoActor = $repoActor;
        $this->repoGenre = $repoGenre;
        $this->repoStudio = $repoStudio;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $movies = $this->repoMovie->findAll();
        $genres = $this->repoGenre->findAll();
        $actors = $this->repoActor->findAll();
        $studios = $this->repoStudio->findAll();
        return $this->render('home/index.html.twig', [
            'movies' => $movies,
            'genres' => $genres,
            'actors' => $actors,
            'studios' => $studios
        ]);
    }
    /**
     * @Route("/about", name="about")
     */
    public function about():Response
    {
        return $this->render('home/about.html.twig');
    }
    /**
     * @Route("/actor/{id}", name="movieActor")
     */
    public function viewActorMovie($id): Response
    {
        $actor = $this->repoActor->find($id);
        $movies = $actor->getMovies();
        $genres = $this->repoGenre->findAll();
        $studios = $this->repoStudio->findAll();
        return $this->render('home/actor.html.twig', [
            'actor' => $actor,
            'movies' => $movies,
            'genres' => $genres,
            'studios'=>$studios
        ]);
    }
    /**
     * @Route("/actors", name="actors")
     */
    public function viewActors(): Response
    {
        $actors = $this->repoActor->findAll();

        return $this->render('home/actor_list.html.twig', [
            'actors' => $actors,
        ]);
    }

    /**
     * @Route("/genres", name="genres")
     */
    public function viewGenres(): Response
    {
        $genres = $this->repoGenre->findAll();

        return $this->render('home/genre_list.html.twig', [
            'genres' => $genres,
        ]);
    }
    /**
     * @Route("/studios", name="studios")
     */
    public function viewStudios(): Response
    {
        $studios = $this->repoStudio->findAll();

        return $this->render('home/studio_list.html.twig', [
            'studios' => $studios,
        ]);
    }
    /**
     * @Route("/studio/{id}", name="movieStudio")
     */
    public function viewStudioMovie($id): Response
    {

        $studio = $this->repoStudio->find($id);
        $movies = $studio->getMovies();
        $genres = $this->repoGenre->findAll();
        $studios = $this->repoStudio->findAll();
        return $this->render('home/studio.html.twig', [
            'studio' => $studio,
            'movies' => $movies,
            'genres' => $genres,
            'studios'=>$studios
        ]);
    }

    /**
     * @Route("/genre/{id}", name="movieGenre")
     */
    public function viewGenre($id): Response
    {
        $genre = $this->repoGenre->find($id);
        $movies = $genre->getMovies();
        $genres = $this->repoGenre->findAll();
        $studios = $this->repoStudio->findAll();
        return $this->render('home/genre.html.twig', [
            'genre' => $genre,
            'movies' => $movies,
            'genres' => $genres,
            'studios'=>$studios
        ]);
    }
}
