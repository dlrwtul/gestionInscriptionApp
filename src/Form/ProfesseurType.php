<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Module;
use App\Entity\Professeur;
use App\Repository\ClasseRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfesseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet',null,[
                'required' => false,
            ])
            ->add('grade',ChoiceType::class,[
                'choices' => Professeur::getGrades()
            ],[
                'required' => false,
            ])
            ->add('modules',EntityType::class,[
                'multiple' => true,
                'class' => Module::class,
                'required' => false,
                'attr' => ['class' => 'msm']
            ])
            ->add('classes',EntityType::class,[
                'multiple' => true,
                'class' => Classe::class,
                'required' => false,
                'attr' => ['class' => 'msm2']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
