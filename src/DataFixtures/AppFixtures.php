<?php

namespace App\DataFixtures;

use App\Entity\Competence;
use App\Entity\Freelancer;
use App\Entity\Project;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;

class AppFixtures extends Fixture
{
    private $slugger;

    public function __construct(Slugify $slugify)
    {
        $this->slugger = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        {
        $faker = \Faker\Factory::create('fr_FR');

        //Competence
        $technos = ['HTML', 'CSS', 'PHP', 'MySQL', 'Bootstrap', 'Symfony'];
        $technosPersist = [];
        foreach ($technos as $techno) {
            $competence = new Competence();
            $competence->setTitle($techno);

            $manager->persist($competence);
            $technosPersist[] = $competence;
        }

        //Project
        for ($i = 0; $i < 5; $i++) {
            $project = new Project();
            $project->setTitle($faker->sentence())
                ->setSlug($this->slugger->generate($project->getTitle()))
                ->setAuthor($faker->name(1))
                ->setDescription($faker->paragraph(3))
                ->addCompetence($faker->randomElement($technosPersist))
                ->setCreatedAt($faker->datetime());
            // ->setIllustration('https://th.bing.com/th/id/OIP.5Y4SsvdOpaUq2ymwbJc0iQHaKm?pid=ImgDet&rs=1%27);

            $manager->persist($project);
        }
    

        //Créer 5 freelancers fakées
        
        for ($i = 1; $i <= 5; $i++) {
            $freelancer = new Freelancer();
            $freelancer
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setEmail($faker->email())
                ->setAdress($faker->sentence())
                ->setPhoneNumber($faker->numberBetween(0.9)) 
                ->setCountry($faker->city())
                ->addProject($project)
                ->addCompetence($competence)
                ->setIllustration($faker->imageUrl());
                
            $manager->persist($freelancer);
        }

    }
        $manager->flush();
    }
}