<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

final class RedirectToSonataController extends AbstractController
{
    #[Route('/', name: 'app_redirect_to_sonata')]
    public function urlRedirect(): RedirectResponse
    {

        return new RedirectResponse($this->generateUrl('sonata_admin_dashboard'));
    }
}
