<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Project;
use App\Entity\Competence;
use App\Repository\ProjectRepository;
// use App\Repository\FreelancerRepository;
use App\Repository\CompetenceRepository;
use App\Service\Slugify;


class HomeController extends AbstractController
{
    private $competenceRepository;
    private $freelancerRepository;
    private $projectRepository;
    
    public function __construct(
        CompetenceRepository $competenceRepository ,
        // FreelancerRepository $freelancerRepository, 
        ProjectRepository $projectRepository)
    {
        $this->competenceRepository = $competenceRepository;
        // $this->freelanceurRepository = $freelancerRepository;
        $this->projectRepository = $projectRepository;
    }
    /**
     * @Route("/", name="home")
     */                                                                                                                                                                                                                                                                                                                                                
    public function index( ProjectRepository $projectRepository): Response
    {
        $project = $this->getDoctrine()
        ->getRepository(Project::class)
        ->findAll();

                return $this->render('home/index.html.twig', [
                    'project' => $projectRepository->findAll(),
                   
        ]);
    }

    /**
     * @Route("/insert", name="insert")
     */                                                                                                                                                                                                                                                                                                                                                
     public function insert( ProjectRepository $projectRepository): Response
     {
        return $this->render('home/insert.html.twig');
     }

     /**
     * @Route("/show", name="show")
     */                                                                                                                                                                                                                                                                                                                                                
    public function show( ProjectRepository $projectRepository): Response
    {
        $project = $this->getDoctrine()
        ->getRepository(Project::class)
        ->findAll();

                return $this->render('home/show.html.twig', [
                    'project' => $projectRepository->findBy([], ['id' => 'DESC'], 3),
        ]);
    }
    /**
     * @Route("/showOne", name="showOne")
     */                                                                                                                                                                                                                                                                                                                                                
     public function showOne(): Response
     {
         $compentence = $this->getDoctrine()
         ->getRepository(CompetenceRepository::class)
         ->findAll();
         $project = $this->getDoctrine()
         ->getRepository(ProjectRepository::class)
         ->findAll();
         $freelanceur = $this->getDoctrine()
         ->getRepository(FreelancerRepository::class)
         ->findAll();
 
                 return $this->render('home/index.html.twig', [
         ]);
     }
}
