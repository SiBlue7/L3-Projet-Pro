<?php

namespace App\Controller\Admin;

use App\Entity\Test;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Test::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            ArrayField::new('inputs'),
            ArrayField::new('outputs')
        ];
    }

}
