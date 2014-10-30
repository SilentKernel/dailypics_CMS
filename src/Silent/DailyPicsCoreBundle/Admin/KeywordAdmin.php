<?php
namespace Silent\DailyPicsCoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class KeywordAdmin extends Admin
{

    const nameLabel = "Mot clef";
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('word', null, array('required' => true, 'label' => self::nameLabel))
        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('word', null, array('label' => self::nameLabel))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('word', null, array('label' => self::nameLabel))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('word', null, array('required' => true, 'label' => self::nameLabel))
        ;
    }

} 