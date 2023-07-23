<?php

namespace App\Controller\Admin;

use App\Entity\Exercices;
use App\Entity\LanguageCategory;
use App\Entity\ThematiqueCategory;
use Doctrine\DBAL\Types\TextType;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;

class ExercicesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Exercices::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            IdField::new('id'),
            TextField::new('title'),
            CodeEditorField::new('enonce'),
            ArrayField::new('languageCategories')->hideOnForm(),
            AssociationField::new('languageCategories')
                ->setFormTypeOption('by_reference', false)
                ->setCrudController(LanguageCategoryCrudController::class),
            ArrayField::new('thematiqueCategories')->hideOnForm(),
            AssociationField::new('thematiqueCategories')
                ->setFormTypeOption('by_reference', false)
                ->setCrudController(ThematiqueCategoryCrudController::class),

            ArrayField::new('tests')->hideOnForm(),
            AssociationField::new('tests')
                ->setFormTypeOption('by_reference', false)
                ->setCrudController(TestCrudController::class),

            DateTimeField::new('createdAt')->setFormat('dd-MM-yyyy hh-mm'),
        ];
    }


}
