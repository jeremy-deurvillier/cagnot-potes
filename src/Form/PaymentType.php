<?php

namespace App\Form;

use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', IntegerType::class, [
                'label' => 'Votre participation',
                'row_attr' => [
                    'class' => 'input-field col s12 l6'
                ],
                'attr' => [
                    'id' => 'mount',
                    'class' => 'validate',
                    'min' => 1
                ]
            ])
            //->add('createdAt')
            //->add('updatedAt')
            ->add('participant', ParticipantType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            //'data_class' => Payment::class,
        ]);
    }
}
