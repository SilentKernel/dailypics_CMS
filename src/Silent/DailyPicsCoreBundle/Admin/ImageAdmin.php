<?php

namespace Silent\DailyPicsCoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ImageAdmin extends Admin
{

    const titleLabel = "Titre";
    const imagePathLabel = "Image";
    const publishDateLabel = "Date de publication";
    const commentLabel = "Commentaire";
    const categoriesLabel = "Catégorie(s)";
    const seoDescriptionLabel = "Description (visible sur les moteurs de recherce)";
    const seoKeywordsLabel = "Mots-clefs (pour les moteurs de recherche)";

    private $ct;

    public function __construct($code, $class, $baseControllerName, $ct=null)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->ct = $ct;
    }

    private function getImagePathParam()
    {
        $fileFieldOptions = array('required' => false, 'data_class' => null, 'mapped' => true, 'label' => self::imagePathLabel);
        $currentImage = $this->getSubject();
        if ($currentImage && ($imageRelative = $currentImage->getRelativeWebPath()) && $imageRelative != null)
            $fileFieldOptions['help'] = '<img src="'.$imageRelative.'" style="width:200px" />';
        return $fileFieldOptions;
    }


    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('title', null, array('required' => true, 'label' => self::titleLabel))
            ->add('imagePath', 'file', $this->getImagePathParam())
            ->add('publishDate', null, array('required' => true, 'label' => self::publishDateLabel))
            ->add('comment', null, array('required' => true, 'label' => self::commentLabel))
            ->add('seoDescription', null, array('required' => true, 'label' => self::seoDescriptionLabel))
            ->add('seoKeywords', null, array('required' => true, 'label' => self::seoKeywordsLabel))
            ->add('categories', null, array('required' => true, 'label' => self::categoriesLabel))

        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, array('label' => self::titleLabel))
            ->add('categories', null, array('label' => self::categoriesLabel))
            ->add('seoKeywords', null, array('label' => self::seoKeywordsLabel))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('title', null, array('label' => self::titleLabel))
            ->add('publishDate', null, array( 'label' => self::publishDateLabel))
            ->add('seoDescription', null, array('label' => self::seoDescriptionLabel))
            ->add('seoKeywords', null, array('label' => self::seoKeywordsLabel))
            ->add('categories', null, array('label' => self::categoriesLabel))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title', null, array('required' => true, 'label' => self::titleLabel))
            ->add('imagePath', 'file', $this->getImagePathParam())
            ->add('publishDate', null, array('required' => true, 'label' => self::publishDateLabel))
            ->add('comment', null, array('required' => true, 'label' => self::commentLabel))
            ->add('seoDescription', null, array('required' => true, 'label' => self::seoDescriptionLabel))
            ->add('seoKeywords', null, array('required' => true, 'label' => self::seoKeywordsLabel))
            ->add('categories', null, array('required' => true, 'label' => self::categoriesLabel))
        ;
    }

    public function prePersist($image)
    {
        $this->ct->get('stof_doctrine_extensions.uploadable.manager')->markEntityToUpload($image, $image->getImagePath());
    }
}
