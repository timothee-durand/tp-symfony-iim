<?php

namespace App\Controller\Admin;

use App\Entity\Character;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class CharacterCrudController extends AbstractCrudController
{

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Character')
            ->setEntityLabelInPlural('Characters')
            ->setSearchFields(['name']);
    }

    public static function getEntityFqcn(): string
    {
        return Character::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            ImageField::new('imageUrl')->hideOnForm(),
            UrlField::new('imageUrl')->onlyOnForms(),
            AssociationField::new("films")->hideOnDetail(),
            CollectionField::new("films")->onlyOnDetail(),
            AssociationField::new("tvShows")->hideOnDetail(),
            CollectionField::new("tvShows")->onlyOnDetail(),
            AssociationField::new("parkAttractions")->hideOnDetail(),
            CollectionField::new("parkAttractions")->onlyOnDetail(),
            AssociationField::new("videoGames")->hideOnDetail(),
            CollectionField::new("videoGames")->onlyOnDetail(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
