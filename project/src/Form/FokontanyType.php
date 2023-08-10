<?php

namespace App\Form;

use App\Entity\Commune;
use App\Entity\Fokontany;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FokontanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => "Fokontany"
            ])

            ->add('commune', EntityType::class, [
                'class' => Commune::class,
                'choice_label' => function($commune){
                    return $commune->getNom();
                },
                "required" => true,
                "constraints" => new NotBlank([
                    "message" => "La commune ne peut pas être vide."
                ]),
            ])

            ->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event){
                dd($event->getForm());
                $this->setUpdatedAt = new \DateTimeImmutable();
            })


        ;

       // dd($builder);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fokontany::class,
        ]);
    }
}
