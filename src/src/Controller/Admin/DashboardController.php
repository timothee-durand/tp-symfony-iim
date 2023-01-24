<?php

namespace App\Controller\Admin;

use App\Entity\Film;
use App\Entity\ParkAttractions;
use App\Entity\TvShows;
use App\Entity\User;
use App\Entity\VideoGames;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(CharacterCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Html');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Characters', 'fa fa-user-group');
        yield MenuItem::linkToCrud('Films', 'fa fa-clapperboard', Film::class);
        yield MenuItem::linkToCrud('Attractions', 'fa fa-car-rear', ParkAttractions::class);
        yield MenuItem::linkToCrud('Tv Shows', 'fa fa-tv', TvShows::class);
        yield MenuItem::linkToCrud('Video games', 'fa fa-gamepad', VideoGames::class);

        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
    }

}
