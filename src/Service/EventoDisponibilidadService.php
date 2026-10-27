<?php

namespace App\Service;

use App\Entity\Evento;

class EventoDisponibilidadService
{
    public function tieneCupos(Evento $evento): bool
    {
        return $evento->getCapacidad() === null || $evento->getCapacidad() > 0;
    }

    public function obtenerMensaje(Evento $evento): string
    {
        if ($this->tieneCupos($evento)) {
            return 'El evento tiene cupos disponibles';
        }

        return 'El evento está completo';
    }
}