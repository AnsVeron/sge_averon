<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Repository\EventoRepository;
// use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route(
        '/sitio/{pagina?}',
        name: 'app_estatica',
        defaults: ['pagina' => 'patrocinadores'],
        requirements: [
            'pagina' => 'patrocinadores|privacidad|condiciones|licencia'
        ]
    )]
    public function estatica(string $pagina): Response
    {
        return $this->render('estatica/' . $pagina . '.html.twig');
    }

    #[Route('/', name: 'app_portada')]
    // public function portada(EntityManagerInterface $em): Response
    public function portada(EventoRepository $repository): Response
    {
        $eventos = $repository->findEventosAlfabeticamente();
        shuffle($eventos);
        $eventos = array_slice($eventos, 0, 8);

        return $this->render('default/portada.html.twig', [
            'eventosCol1' => array_slice($eventos, 0, 4),
            'eventosCol2' => array_slice($eventos, 4, 4),
        ]);

    }
}
