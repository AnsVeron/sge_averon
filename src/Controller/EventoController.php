<?php

namespace App\Controller;

use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EventoController extends AbstractController
{
    // #[Route('/evento', name: 'app_evento')]
    // public function index(): Response
    // {
    //     return $this->render('evento/index.html.twig', [
    //         'controller_name' => 'EventoController',
    //     ]);
    // }

    #[Route('/eventos', name: 'eventos')]
    public function eventos(EventoRepository $repository): Response
    {
        $eventos = $repository->findEventosAlfabeticamente();

        return $this->render('evento/eventos.html.twig', [
            'eventos' => $eventos
        ]);
    }

    #[Route('/evento/{slug}', name: 'evento_detalle')]
    public function evento(
        string $slug,
        EventoRepository $repository
    ): Response
    {
        $evento = $repository->findOneBy([
            'slug' => $slug
        ]);

        if (!$evento) {
            throw $this->createNotFoundException(
                'No existe el evento solicitado'
            );
        }

        return $this->render('evento/evento.html.twig', [
            'evento' => $evento
        ]);
    }

}
