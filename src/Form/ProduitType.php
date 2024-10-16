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
            ->add('CODEPROD', null, [
                'label' => 'Code produit',  // Changer le label ici
                'attr' => ['readonly' => true],
            ])
            ->add('LIBPROD', null, [
                'label' => 'Libillé',  // Changer le label ici
            ])
            ->add('ADRESSE', null, [
                'label' => 'Adresse',  // Changer le label ici
            ])
            ->add('TEL', null, [
                'label' => 'Telephone',  // Changer le label ici
            ])
            ->add('EMAIL', null, [
                'label' => 'Email',  // Changer le label ici
            ])
            ->add('IDPAYS', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'LIBPAYS',
                'label' => 'Pays'
            ])
            ->add('SEQSOUSPAYS', EntityType::class, [
                'class' => Souspays::class,
                'choice_label' => 'LIBSOUSPAYS',
                'label' => 'Sous pays'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
            'csrf_protection' => true,
        ]);
    }
}
