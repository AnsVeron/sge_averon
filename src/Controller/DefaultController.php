<?php

namespace App\Controller;

<<<<<<< HEAD
=======
use App\Entity\Evento;
use App\Repository\EventoRepository;
// use Doctrine\ORM\EntityManagerInterface;
>>>>>>> main
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

<<<<<<< HEAD
final class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route(
        '/sitio/{pagina}',
=======
class DefaultController extends AbstractController
{
    #[Route(
        '/sitio/{pagina?}',
>>>>>>> main
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
<<<<<<< HEAD
}
=======

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
>>>>>>> main
