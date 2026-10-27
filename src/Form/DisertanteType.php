<?php

namespace App\Form;

use App\Entity\Disertante;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DisertanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', null, [
                'label' => 'Nombre',
                'attr' => ['placeholder' => 'Ingrese el nombre'],
            ])
            ->add('apellido', null, [
                'label' => 'Apellido',
                'attr' => ['placeholder' => 'Ingrese el apellido'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Correo electrónico',
                'attr' => ['placeholder' => 'nombre@dominio.com'],
            ])
            ->add('especialidad', null, [
                'label' => 'Especialidad',
                'attr' => ['placeholder' => 'Ingrese la especialidad'],
            ])
            ->add('biografia', TextareaType::class, [
                'label' => 'Biografía (opcional)',
                'required' => false,
                'attr' => ['rows' => 5],
            ])
            ->add('activo', CheckboxType::class, [
                'label' => 'Activo',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Disertante::class,
        ]);
    }
}
