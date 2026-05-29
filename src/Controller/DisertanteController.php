<?php

namespace App\Controller;
use App\Repository\DisertanteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DisertanteController extends AbstractController
{
    #[Route('/disertantes', name: 'app_disertantes')]
    public function disertantes(
        DisertanteRepository $repository
    ): Response
    {
        $disertantes = $repository
            ->findDisertantesAlfabeticamente();

        return $this->render(
            'disertante/disertantes.html.twig',
            [
                'disertantes' => $disertantes
            ]
        );
    }

    #[Route(
        '/disertante/{id}',
        name: 'app_disertante_detalle'
    )]
    public function disertante(
        int $id,
        DisertanteRepository $repository
    ): Response
    {
        $disertante = $repository->find($id);

        if (!$disertante) {
            throw $this->createNotFoundException(
                'No existe el disertante solicitado'
            );
        }

        return $this->render(
            'disertante/disertante.html.twig',
            [
                'disertante' => $disertante
            ]
        );
    }
}
