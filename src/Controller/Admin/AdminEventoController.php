<?php

namespace App\Controller\Admin;

use App\Entity\Evento;
use App\Form\EventoType;
use App\Repository\EventoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/eventos')]
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
        '/nuevo',
        name: 'admin_evento_nuevo',
        methods: ['GET', 'POST']
    )]
    public function nuevo(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $evento = new Evento();

        $form = $this->createForm(
            EventoType::class,
            $evento
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($evento);

            $entityManager->flush();

            $this->addSuccessMessage('Evento creado correctamente.');

            return $this->redirectToRoute(
                'admin_evento_listar'
            );
        }

        return $this->render(
            'admin/evento/nuevo.html.twig',
            [
                'form' => $form,
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

    // borrar inscripto de evento
    #[Route(
        '/inscriptos/{id}/eliminar/{idUsuario}',
        name: 'admin_evento_inscripto_eliminar',
        requirements: ['id' => '\d+', 'idUsuario' => '\d+']
    )]
    public function eliminarInscriptos(
        int $id,
        int $idUsuario,
        EventoRepository $eventoRepository,
        EntityManagerInterface $entityManagerInterface
    ): Response
    {
        $evento = $eventoRepository->find($id);

        if (!$evento) {
            throw $this->createNotFoundException(
                'Evento no encontrado'
            );
        }

        $usuario = $evento->getUsuarios()->filter(function ($usuario) use ($idUsuario) {
            return $usuario->getId() === $idUsuario;
        })->first();

        if (!$usuario) {
            throw $this->createNotFoundException(
                'Usuario no encontrado en el evento'
            );
        }

        $evento->removeUsuario($usuario);

        $entityManagerInterface->flush();

        $this->addInfoMessage(
            sprintf(
                "El usuario '%s %s' ha sido eliminado del evento '%s'.",
                $usuario->getNombre(),
                $usuario->getApellido(),
                $evento->getTitulo()
            )
        );

        return $this->redirectToRoute(
            'app_admin_evento_inscriptos',
            ['id' => $id]
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
