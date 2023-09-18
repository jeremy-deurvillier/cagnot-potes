<?php

namespace App\Form;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom sur la carte',
                'row_attr' => [
                    'class' => 'input-field col s12'
                ],
                'attr' => [
                    'id' => 'card_name',
                    'class' => 'validate'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre Email',
                'row_attr' => [
                    'class' => 'input-field col s12 l6'
                ],
                'attr' => [
                    'id' => 'email',
                    'class' => 'validate'
                ]
            ])
            ->add('identityIsHide', CheckboxType::class, [
                'label' => 'Masquer mon identité auprès des autres participants',
                'required' => false,
                'attr' => [
                    'id' => 'identityIsHide'
                ]
            ])
            ->add('amountIsHide', CheckboxType::class, [
                'label' => 'Masquer le montant de ma participation auprès des autres participants',
                'required' => false,
                'attr' => [
                    'id' => 'amountIsHide'
                ]
            ])
            //->add('campaign')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
