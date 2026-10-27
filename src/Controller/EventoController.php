<?php

namespace App\Controller;

use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Evento;
use App\Service\EventoDisponibilidadService;

final class EventoController extends AbstractBaseController
{
    // #[Route('/evento', name: 'app_evento')]
    // public function index(): Response
    // {
    //     return $this->render('evento/index.html.twig', [
    //         'controller_name' => 'EventoController',
    //     ]);
    // }

    #[Route('/evento/{id}/disponibilidad', name: 'evento_disponibilidad')]
    public function disponibilidad(
        Evento $evento,
        EventoDisponibilidadService $disponibilidadService
    ): Response {
        $mensaje = $disponibilidadService
            ->obtenerMensaje($evento);

        return $this->render(
            'evento/disponibilidad.html.twig',
            [
                'evento' => $evento,
                'mensaje' => $mensaje,
            ]
        );
    }

    #[Route('/eventos', name: 'app_eventos')]
    public function eventos(EventoRepository $repository): Response
    {
        $eventos = $repository->findEventosAlfabeticamente();

        return $this->render('evento/eventos.html.twig', [
            'eventos' => $eventos
        ]);
    }

    #[Route('/evento/{slug}', name: 'app_evento_detalle')]
    public function evento(
        Request $request,
        EventoRepository $repository
    ): Response
    {   
        $slug = $request->attributes->get('slug');

        $evento = $repository->findOneBy([
            'slug' => $slug
        ]);

        if (!$evento) {
            throw $this->createNotFoundException(
                'No existe el evento solicitado'
            );
        }
        
        $this->addInfoMessage(
            'Evento leído'
        );

        return $this->render('evento/evento.html.twig', [
            'evento' => $evento
        ]);
        
    }

}
