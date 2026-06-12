<?php

namespace App\Controller\Admin;

use App\Repository\EventoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/evento')]
class AdminEventoController extends AbstractAdminBaseController
{
    #[Route(
        '/listar',
        name: 'admin_evento_listar'
    )]
    public function listar(
        EventoRepository $eventoRepository
    ): Response
    {
        $eventos = $eventoRepository->findEventosAlfabeticamente();

        return $this->render(
            'admin/evento/listar.html.twig',
            [
                'eventos' => $eventos
            ]
        );
    }

    #[Route(
        '/inscriptos/{id}',
        name: 'app_admin_evento_inscriptos',
        requirements: ['id' => '\d+']
    )]
    public function inscriptos(
        int $id,
        EventoRepository $eventoRepository
    ): Response
    {
        $evento = $eventoRepository->find($id);

        if (!$evento) {
            throw $this->createNotFoundException(
                'Evento no encontrado'
            );
        }

        return $this->render(
            'admin/evento/inscriptos.html.twig',
            [
                'evento' => $evento
            ]
        );
    }

    #[Route(
        '/borrar/{id}',
        name: 'admin_evento_borrar',
        requirements: ['id' => '\d+']
    )]
    public function borrar(
        int $id,
        EventoRepository $eventoRepository,
        EntityManagerInterface $entityManager
    ): Response
    {
        $evento = $eventoRepository->find($id);

        if (!$evento) {
            throw $this->createNotFoundException(
                'No existe el evento solicitado.'
            );
        }

        $entityManager->remove($evento);

        $entityManager->flush();

        
        $this->addInfoMessage(
            sprintf(
                "El evento '%s' se ha borrado correctamente.",
                $evento->getTitulo()
            )
        );

        return $this->redirectToRoute(
            'admin_evento_listar'
        );

    }


}