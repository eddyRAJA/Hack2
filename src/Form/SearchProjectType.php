<?php

namespace App\Form;

use App\Form\TextType ;
use App\Entity\Project;
use App\Entity\Competence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class SearchProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('competence', EntityType::class, [
                'class' => Competence::class, 
                'choice_label' => 'title',
                'multiple' => true])
            
            ->add('research', SubmitType::class);
        
    }
}