<?php

namespace App\Form;

use App\Entity\Disertante;
use App\Entity\Evento;
use App\Entity\Usuario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('slug')
            ->add('descripcion')
            ->add('fecha')
            ->add('hora')
            ->add('duracion')
            ->add('idioma')
            ->add('estado')
            ->add('disertante', EntityType::class, [
                'class' => Disertante::class,
                'choice_label' => 'id',
            ])
            ->add('usuarios', EntityType::class, [
                'class' => Usuario::class,
                'choice_label' => 'id',
                'multiple' => true,
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
