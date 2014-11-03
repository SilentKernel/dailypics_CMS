<?php
namespace Silent\DailyPicsCoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class CategoryAdmin extends Admin
{

    const nameLabel = "Nom de la catégorie";
    const seoDescriptionLabel = "Description de la catégorie (pour les moteurs de recherche)";

    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('name', null, array('required' => true, 'label' => self::nameLabel))
            ->add('seoDescription', null, array('required' => true, 'label' => self::seoDescriptionLabel))
        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array('label' => self::nameLabel))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('name', null, array('label' => self::nameLabel))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name', null, array('required' => true, 'label' => self::nameLabel))
            ->add('seoDescription', null, array('required' => true, 'label' => self::seoDescriptionLabel))
        ;
    }

} 