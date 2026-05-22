<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route(
        '/sitio/{pagina?}', // <-- Añadido el '?' para hacerlo opcional
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
}