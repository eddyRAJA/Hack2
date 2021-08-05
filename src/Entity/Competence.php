<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
class Competence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity=Freelancer::class, mappedBy="competence")
     */
    private $freelancers;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class, mappedBy="competence")
     */
    private $projects;

    public function __construct()
    {
        $this->freelancers = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle() ?: '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Freelancer[]
     */
    public function getFreelancers(): Collection
    {
        return $this->freelancers;
    }

    public function addFreelancer(Freelancer $freelancer): self
    {
        if (!$this->freelancers->contains($freelancer)) {
            $this->freelancers[] = $freelancer;
            $freelancer->addCompetence($this);
        }

        return $this;
    }

    public function removeFreelancer(Freelancer $freelancer): self
    {
        if ($this->freelancers->removeElement($freelancer)) {
            $freelancer->removeCompetence($this);
        }

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->addCompetence($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            $project->removeCompetence($this);
        }

        return $this;
    }
}