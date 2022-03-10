<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'form-control text-white',
                    'style' => 'border:none;background:#2e2e2e;',
                    'required' => true
                )
            ])
            ->add('stock', IntegerType::class, [
                'attr' => array(
                    'class' => 'form-control text-white',
                    'style' => 'border:none;background:#2e2e2e;',
                    'required' => true
                )
            ])
            ->add('price', IntegerType::class, [
                'attr' => array(
                    'class' => 'form-control text-white',
                    'style' => 'border:none;background:#2e2e2e;',
                    'required' => true
                )
            ])
            ->add('description', TextareaType::class, [
                'attr' => array(
                    'class' => 'form-control text-white mb-3',
                    'style' => 'border:none;background:#2e2e2e;',
                    'required' => false
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
