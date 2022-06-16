<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Mime\Message;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet',null,[
                'required' => false,
                'attr' => ['placeholder' => 'Kony Js','class' => 'input input-bordered input-info w-full'],
                'constraints' => [
                    new NotBlank(message:"Nomp Complet obligatoire"),
                ]
            ])
            ->add('login',EmailType::class,[
                'required' => false,
                'attr' => ['placeholder' => 'example@gmail.com','class' => 'email input input-bordered input-info w-full',"id" => "email"],
                'constraints' => [
                    new NotBlank(message:"Champ obligatoire"),
                    new Email(message:"Email Invalide")
                ]
            ])
            ->add('sexe',ChoiceType::class,[
                "choices" => array(
                    "" => null,
                    "Masculin" => "M",
                    "Feminin" => "F",
                ),
                'required' => false,
                'attr' => ['class' => 'select select-info w-full'],
                'constraints' => [
                    new NotBlank(message:"Sexe obligatoire"),
                ]
            ])
            ->add('adresse',null,[
                'required' => false,
                'attr' => ['placeholder' => 'KM P/A U10','class' => 'input input-bordered input-info w-full'],
                'constraints' => [
                    new NotBlank(message:"Adresse obligatoire"),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
