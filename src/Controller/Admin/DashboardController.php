<?php

namespace App\Controller\Admin;

use App\Entity\Exercices;
use App\Entity\LanguageCategory;
use App\Entity\Test;
use App\Entity\ThematiqueCategory;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     * IsGranted("ROLE_SUPER_ADMIN")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Site Auto Evaluation Code L3');
    }

    public function configureMenuItems(): iterable
    {
        // Partie administration
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Administration');
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);

        // Partie Exercice
        yield MenuItem::section('Exercice');
        yield MenuItem::linkToCrud('Exercices', 'fa fa-pdf', Exercices::class);
        yield MenuItem::linkToCrud('Langages', 'fa fa-pdf', LanguageCategory::class);
        yield MenuItem::linkToCrud('Thématiques', 'fa fa-pdf', ThematiqueCategory::class);
        yield MenuItem::linkToCrud('Test', 'fa fa-pdf', Test::class);

        // Partie Logout
        yield MenuItem::section('Exit');
        yield MenuItem::linkToUrl('Exit', 'fa fa-home', 'https://127.0.0.1:8000/page/exercice');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
