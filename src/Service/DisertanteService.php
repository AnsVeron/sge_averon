<?php

namespace App\Service;

use App\Entity\Disertante;

class DisertanteService
{
    public function obtenerNombreCompleto(
        Disertante $disertante
    ): string
    {
        return $disertante->getNombre().' '.$disertante->getApellido();
    }
}
