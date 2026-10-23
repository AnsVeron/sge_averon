<?php

namespace App\Controller\Admin;

use App\Entity\Evento;
use App\Form\EventoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/eventos')]
class AdminEventoController extends AbstractController
{
    #[Route(
        '/nuevo',
        name: 'admin_evento_nuevo',
        methods: ['GET', 'POST']
    )]
    public function nuevo(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {

        $evento = new Evento();

        $form = $this->createForm(
            EventoType::class,
            $evento
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($evento);

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Evento creado correctamente.'
            );

            return $this->redirectToRoute(
                'admin_evento_index'
            );
        }

        return $this->render(
            'admin/evento/nuevo.html.twig',
            [
                'form' => $form,
            ]
        );
    }
}
