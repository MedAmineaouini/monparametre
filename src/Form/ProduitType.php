<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\Produit;
use App\Entity\Souspays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('LIBPROD')
            ->add('ADRESSE')
            ->add('TEL')
            ->add('EMAIL')
            ->add('SEQSOUSPAYS', EntityType::class, [
                'class' => Souspays::class,
                'choice_label' => 'id',
            ])
            ->add('IDPAYS', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
