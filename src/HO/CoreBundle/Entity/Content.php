<?php

namespace HO\CoreBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;


use Doctrine\ORM\Mapping as ORM;

/**
 * Content
 *
 * @ORM\Table(name="content")
 * @ORM\Entity(repositoryClass="HO\CoreBundle\Repository\ContentRepository")
 */
class Content
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="text")
     */
    private $code;

    /**
     * @ORM\ManyToMany(targetEntity="HO\CoreBundle\Entity\Video", cascade={"persist"})
     * @ORM\JoinTable(name="content_video")
     */
    private $videos;


    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

    public function addVideo(Video $video)
    {
        $this->videos[] = $video;
    }

    public function removeVideo(Video $video)
    {
        $this->videos->removeElement($video);
    }

    public function getVideos()
    {
        return $this->videos;
    }



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Content
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Content
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}

