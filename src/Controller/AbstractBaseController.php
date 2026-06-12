<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

abstract class AbstractBaseController extends AbstractController
{
    protected function addInfoMessage(
        string $message
    ): void
    {
        $this->addFlash(
            'info',
            $message
        );
    }

    protected function addWarnMessage(
        string $message
    ): void
    {
        $this->addFlash(
            'warning',
            $message
        );
    }

    protected function addErrorMessage(
        string $message
    ): void
    {
        $this->addFlash(
            'danger',
            $message
        );
    }

    protected function addSuccessMessage(
        string $message
    ): void
    {
        $this->addFlash(
            'success',
            $message
        );
    }

    protected function redirectToHome(): RedirectResponse
    {
        return $this->redirectToRoute('app_portada');
    }
}