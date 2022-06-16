<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class InscriptionType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('etudiant',EtudiantType::class,[
                'required' => false,
                'label' => 'Informations Etudiant',
                'label_attr' => ['class' => 'label-text text-black text-2xl mb-10 relative bottom-2'],
            ])

            ->add('classe',null,[
                'required' => false,
                'attr' => ['class' => 'select select-info w-full']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
