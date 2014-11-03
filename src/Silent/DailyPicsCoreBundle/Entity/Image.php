<?php

namespace Silent\DailyPicsCoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Silent\DailyPicsCoreBundle\Entity\ImageRepository")
 * @Gedmo\Uploadable(allowOverwrite=false, filenameGenerator="SHA1", allowedTypes="image/gif,image/jpeg,image/png")
 */

class Image
{
    // this shoud be improved, this const must be in paraeters.yml
    const IMAGES_DIR = "/images/";

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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="image_path", type="string", length=255, nullable=false, unique=true)
     * @Gedmo\UploadableFilePath
     */
    private $imagePath;

    /**
     * @var string
     * @ORM\Column(name="image_name", type="string", length=255, nullable=false, unique=true)
     * @Gedmo\UploadableFileName
     */
    private $imageName;

    /**
     * @var string
     * @ORM\Column(name="image_SHA1", type="string", length=50, nullable=false, unique=true)
     */
    private $imageSHA1;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=false)
     */
    private $comment;

    /**
     * @ORM\ManyToMany(targetEntity="Silent\DailyPicsCoreBundle\Entity\Category", inversedBy="images")
     * @ORM\JoinTable(name="image_category")
     * @ORM\OrderBy({"name" = "ASC"})
     **/
    private $categories;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_date", type="datetime", nullable=false)
     */
    private $publishDate;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=160, nullable=false)
     */
    private $seoDescription;

    /**
     * @ORM\ManyToMany(targetEntity="Silent\DailyPicsCoreBundle\Entity\Keyword", inversedBy="images")
     * @ORM\JoinTable(name="image_keyword")
     * @ORM\OrderBy({"word" = "ASC"})
     **/
    private $seoKeywords;

    /**
     * @var string
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true, nullable=false)
     */
    private $slug;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->seoKeywords = new \Doctrine\Common\Collections\ArrayCollection();
    }

    // get the relative Path to show them in twig template
    public function getRelativeWebPath()
    {
        if ($this->getImageName() != "")
            return self::IMAGES_DIR.$this->getImageName();
        else return null;
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
     * Set title
     *
     * @param string $title
     * @return Image
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

 
    /**
     * Set comment
     *
     * @param string $comment
     * @return Image
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set publishDate
     *
     * @param \DateTime $publishDate
     * @return Image
     */
    public function setPublishDate($publishDate)
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    /**
     * Get publishDate
     *
     * @return \DateTime
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return Image
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Image
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
     * Add categories
     *
     * @param \Silent\DailyPicsCoreBundle\Entity\Category $categories
     * @return Image
     */
    public function addCategory(\Silent\DailyPicsCoreBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Silent\DailyPicsCoreBundle\Entity\Category $categories
     */
    public function removeCategory(\Silent\DailyPicsCoreBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add seoKeywords
     *
     * @param \Silent\DailyPicsCoreBundle\Entity\Keyword $seoKeywords
     * @return Image
     */
    public function addSeoKeyword(\Silent\DailyPicsCoreBundle\Entity\Keyword $seoKeywords)
    {
        $this->seoKeywords[] = $seoKeywords;

        return $this;
    }

    /**
     * Remove seoKeywords
     *
     * @param \Silent\DailyPicsCoreBundle\Entity\Keyword $seoKeywords
     */
    public function removeSeoKeyword(\Silent\DailyPicsCoreBundle\Entity\Keyword $seoKeywords)
    {
        $this->seoKeywords->removeElement($seoKeywords);
    }

    /**
     * Get seoKeywords
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeoKeywords()
    {
        return $this->seoKeywords;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     * @return Image
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set imageSHA1
     *
     * @param string $imageSHA1
     * @return Image
     */
    public function setImageSHA1($imageSHA1)
    {
        // see setImagePath()
        //$this->imageSHA1 = $imageSHA1;

        return $this;
    }

    /**
     * Get imageSHA1
     *
     * @return string 
     */
    public function getImageSHA1()
    {
        return $this->imageSHA1;
    }

    /**
     * Set imagePath
     *
     * @param string $imagePath
     * @return Image
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
        $this->imageSHA1 = sha1_file($this->imagePath);

        return $this;
    }

    /**
     * Get imagePath
     *
     * @return string 
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }
}
