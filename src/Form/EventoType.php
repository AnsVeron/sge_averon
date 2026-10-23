<?php

namespace App\Form;

use App\Entity\Disertante;
use App\Entity\Evento;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo', null, [
                'label' => 'Título del evento',
                'attr' => [
                    'placeholder' => 'Ingrese el título del evento',
                ],
            ])
            ->add('descripcion', TextareaType::class, [
                'label' => 'Descripción',
                'attr' => [
                    'placeholder' => 'Ingrese una descripción',
                    'rows' => 5,
                ],
            ])
            ->add('fecha', DateType::class, [
                'label' => 'Fecha del evento',
                'widget' => 'single_text',
            ])
            ->add('hora', TimeType::class, [
                'label' => 'Hora de inicio',
                'widget' => 'single_text',
            ])
            ->add('duracion', null, [
                'label' => 'Duración (minutos)',
                'attr' => [
                    'placeholder' => 'Ingrese la duración en minutos',
                ],
            ])
            ->add('idioma', null, [
                'label' => 'Idioma',
                'attr' => [
                    'placeholder' => 'Ingrese el idioma del evento',
                ],
            ])
            ->add('capacidad', null, [
                'label' => 'Capacidad máxima',
            ])
            ->add('estado', ChoiceType::class, [
                'label' => 'Estado',
                'choices' => [
                    'Activo' => 'Activo',
                    'Cancelado' => 'Cancelado',
                    'Finalizado' => 'Finalizado',
                ],
            ])
            ->add('disertante', EntityType::class, [
                'class' => Disertante::class,
                'label' => 'Disertante',
                'placeholder' => 'Seleccione un disertante',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evento::class,
        ]);
    }
}
