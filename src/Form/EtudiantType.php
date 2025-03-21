<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Etudiant;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
    ->add('email', EmailType::class, [
        'label' => 'Adresse email',
        'attr' => [
            'class' => 'form-control',
            'placeholder' => 'exemple@domaine.com',
        ],
        'constraints' => [
            new NotBlank(['message' => 'Veuillez saisir une adresse email']),
            new Email(['message' => 'L\'adresse email n\'est pas valide']),
        ],
    ])
    ->add('password', PasswordType::class, [
        'label' => 'Mot de passe',
        'attr' => [
            'class' => 'form-control',
            'placeholder' => 'Votre mot de passe',
        ],
        'constraints' => [
            new NotBlank(['message' => 'Veuillez saisir un mot de passe']),
            new Length([
                'min' => 8,
                'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères',
            ]),
        ],
    ])
    ->add('tuteur', TextType::class, [
        'label' => 'Nom du tuteur',
        'attr' => [
            'class' => 'form-control',
            'placeholder' => 'Nom et prénom du tuteur',
        ],
    ])
    ->add('classe', EntityType::class, [
        'class' => Classe::class,
        'choice_label' => 'libelle', // Changement de 'id' à 'nom' pour une meilleure expérience utilisateur
        'label' => 'Classe',
        'attr' => [
            'class' => 'form-select',
        ],
        'placeholder' => 'Sélectionnez une classe',
        'query_builder' => function (EntityRepository $er) {
            return $er->createQueryBuilder('c')
                ->orderBy('c.libelle', 'ASC');
        },
    ])
    ->add('submit', SubmitType::class, [
        'label' => 'Enregistrer',
        'attr' => [
            'class' => 'btn btn-primary mt-3',
        ],
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
