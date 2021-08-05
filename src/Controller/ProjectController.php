<?php

namespace App\Controller;
use App\Entity\Competence;
use App\Entity\Freelancer;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Repository\CompetenceRepository;
use App\Repository\FreelancerRepository;
use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Slugify;



/**
 * @Route("/project", name="project")
 */
class ProjectController extends AbstractController
{
    private $competenceRepository;
    private $freelancerRepository;
    private $projectRepository;
    
    public function __construct(
        CompetenceRepository $competenceRepository ,
        FreelancerRepository $freelancerRepository, 
        ProjectRepository $projectRepository)
    {
        $this->competenceRepository = $competenceRepository;
        $this->freelanceurRepository = $freelancerRepository;
        $this->projectRepository = $projectRepository;
    }
    /**
     * @Route("/", name="_index", methods={"GET"})
     */
    public function index(): Response
    {
        $projects=$this->getDoctrine()
        ->getRepository(Project::class)
        ->findAll();
        $competences=$this->getDoctrine()
        ->getRepository(Competence::class)
        ->findAll();

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
            'competences' => $competences,

        ]);
    }

    /**
     * @Route("/new", name="_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('project_index');
        }

        return $this->render('project/new.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show", name="_show", methods={"GET"})
     */
    public function show(Project $project,  Competence $competence, Freelancer $freelancer): Response
    {
        return $this->render('project/show.html.twig', [
            'project' => $project,
            'competence' => $competence,
            'freelancer' => $freelancer,

        ]);
    }
    /**
     * @Route("/{id}", name="_show_unity", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function show_unity(Project $project): Response
    {
        return $this->render('project/show_unity.html.twig', [
            'project' => $project,
            

        ]);
    }


    /**
     * @Route("/{id}/edit", name="project_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Project $project): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('project_index');
        }

        return $this->render('project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="project_delete", methods={"POST"})
     */
    public function delete(Request $request, Project $project): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('project_index');
    }
}
        