<?php

namespace App\Form;
use App\Form\TextType ;
use App\Entity\Project;
use App\Entity\Competence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('attr' => array
            ( 'style' => 'border-radius:1rem;
            height:2.5rem; background-color:#ebebeb; text-align:center')))
            ->add('author', null, array('attr' => array
            ( 'style' => 'border-radius:1rem;
            height:2.5rem; background-color:#ebebeb; text-align:center')))
            ->add('description', null, array('attr' => array
            ( 'style' => 'border-radius:1rem;
            height:2.5rem; background-color:#ebebeb; text-align:center')))
            ->add('createdAt', null, array('attr' => array
        ( 'style' => 'border-radius:1rem;
         ')))
        ;    
        $builder->add('competence', EntityType::class,[
            'class' => Competence::class,
            'label' => 'Skills Needed',
            'multiple' => true,
            'expanded' => true,
        ]);
    }
        

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
