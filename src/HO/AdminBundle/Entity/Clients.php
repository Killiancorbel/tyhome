<?php

namespace HO\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clients
 *
 * @ORM\Table(name="clients")
 * @ORM\Entity(repositoryClass="HO\AdminBundle\Repository\ClientsRepository")
 */
class Clients
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="forename", type="string", length=255)
     */
    private $forename;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroTVA", type="string", length=255, nullable=true)
     */
    private $numeroTVA;

    /**
     * @ORM\OneToOne(targetEntity="HO\UserBundle\Entity\User", cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\Column(name="company", type="string", length=255, nullable=true)
     */
    private $company;


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
     * Set name
     *
     * @param string $name
     *
     * @return Clients
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set forename
     *
     * @param string $forename
     *
     * @return Clients
     */
    public function setForename($forename)
    {
        $this->forename = $forename;

        return $this;
    }

    /**
     * Get forename
     *
     * @return string
     */
    public function getForename()
    {
        return $this->forename;
    }

    /**
     * Set numeroTVA
     *
     * @param string $numeroTVA
     *
     * @return Clients
     */
    public function setNumeroTVA($numeroTVA)
    {
        $this->numeroTVA = $numeroTVA;

        return $this;
    }

    /**
     * Get numeroTVA
     *
     * @return string
     */
    public function getNumeroTVA()
    {
        return $this->numeroTVA;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getCompany()
    {
        return $this->company;
    }
    public function setCompany($company)
    {
        $this->company = $company;
    }
}

