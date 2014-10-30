<?php

namespace Silent\DailyPicsCoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Keyword
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Silent\DailyPicsCoreBundle\Entity\KeywordRepository")
 */
class Keyword
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="word", type="string", length=255)
     */
    private $word;

    /**
     * @ORM\ManyToMany(targetEntity="Silent\DailyPicsCoreBundle\Entity\Image", mappedBy="seoKeywords")
     * @ORM\OrderBy({"publishDate" = "DESC"})
     **/
    private $images;

    /**
     * @var string
     * @Gedmo\Slug(fields={"word"})
     * @ORM\Column(name="slug", type="string", length=255, nullable=false, unique=true)
     */
    private $slug;

    public function __toString()
    {
        return $this->word;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set word
     *
     * @param string $word
     * @return Keyword
     */
    public function setWord($word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Get word
     *
     * @return string 
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Keyword
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add images
     *
     * @param \Silent\DailyPicsCoreBundle\Entity\Image $images
     * @return Keyword
     */
    public function addImage(\Silent\DailyPicsCoreBundle\Entity\Image $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \Silent\DailyPicsCoreBundle\Entity\Image $images
     */
    public function removeImage(\Silent\DailyPicsCoreBundle\Entity\Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
}
