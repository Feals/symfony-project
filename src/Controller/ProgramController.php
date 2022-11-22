<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Form\ProgramType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;


#[Route('/program', name: 'program_')]
Class ProgramController extends AbstractController

{

    #[Route('/', name: 'index')]

    public function index(ProgramRepository $programRepository): Response

    {
        $programs = $programRepository->findAll();
        return $this->render('program/index.html.twig', [

            'programs' => $programs
     
         ]);
    }

    #[Route('/new', name: 'new')]

    public function new(Request $request, ProgramRepository $programRepository, SluggerInterface $slugger): Response

    {

        $program = new Program();
        $slug = $slugger->slug($program->getTitle());
        $program->setSlug($slug);


        // Create the form, linked with $category

        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $programRepository->save($program, true);
            return $this->redirectToRoute('program_index');
        }
        

        // Render the form (best practice)

        return $this->renderForm('program/new.html.twig', [

            'form' => $form,

        ]);
    }

    #[Route('/show/{id<^[0-9]+$>}', name: 'show')]

public function show(int $id, ProgramRepository $programRepository, Program $program):Response

{   
    $program = $programRepository->findOneBy(['id' => $id]);

    $seasonsProgam = $program->getSeasons();

    if (!$program) {

        throw $this->createNotFoundException(

            'No program with id : '.$id.' found in program\'s table.'

        );

    }

    return $this->render('program/show.html.twig', [

        'program' => $program,
        'seasonsProgram' => $seasonsProgam


    ]);

}

    #[Route('/{program}/seasons/{season}',
    requirements: ['programId' => '\d+', 'id' => '\d+'],
    methods: ["GET"],
    name: 'season_show'
)]


public function seasonShow(Program $program, Season $season, Episode $episode): Response
{   $episodesSeasonProgam = $season->getEpisodes();

    return $this->render('program/season_show.html.twig', [
        'program' => $program,
        'season' => $season,
        'episodes' => $episodesSeasonProgam
    ]);
}
}


