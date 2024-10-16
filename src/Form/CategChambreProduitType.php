<?php

namespace App\Form;

use App\Entity\CategChambreProduit;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategChambreProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('SEQCATEGORIECHAMBRE')
            ->add('LIBCATEGCHAMBREPRODUIT')
            ->add('LIBCATEGCHAMBREPRODUIT2')
            ->add('STOPSALE')
            ->add('SEQPROD', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CategChambreProduit::class,
        ]);
    }
}
