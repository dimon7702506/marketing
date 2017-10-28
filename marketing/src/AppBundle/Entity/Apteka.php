<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Apteka
 *
 * @ORM\Table(name="apteka", uniqueConstraints={@ORM\UniqueConstraint(name="apteka_id", columns={"apteka_id"}), @ORM\UniqueConstraint(name="ip_adres", columns={"ip_adres"})})
 * @ORM\Entity
 */
class Apteka
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="adres", type="string", length=200, nullable=false)
     */
    private $adres;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_act", type="datetime", nullable=false)
     */
    private $dateAct = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="ip_adres", type="string", length=15, nullable=false)
     */
    private $ipAdres;

    /**
     * @var string
     *
     * @ORM\Column(name="db_name", type="string", length=10, nullable=false)
     */
    private $dbName;

    /**
     * @var integer
     *
     * @ORM\Column(name="apteka_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aptekaId;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Apteka
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
     * Set adres
     *
     * @param string $adres
     *
     * @return Apteka
     */
    public function setAdres($adres)
    {
        $this->adres = $adres;

        return $this;
    }

    /**
     * Get adres
     *
     * @return string
     */
    public function getAdres()
    {
        return $this->adres;
    }

    /**
     * Set dateAct
     *
     * @param \DateTime $dateAct
     *
     * @return Apteka
     */
    public function setDateAct($dateAct)
    {
        $this->dateAct = $dateAct;

        return $this;
    }

    /**
     * Get dateAct
     *
     * @return \DateTime
     */
    public function getDateAct()
    {
        return $this->dateAct;
    }

    /**
     * Set ipAdres
     *
     * @param string $ipAdres
     *
     * @return Apteka
     */
    public function setIpAdres($ipAdres)
    {
        $this->ipAdres = $ipAdres;

        return $this;
    }

    /**
     * Get ipAdres
     *
     * @return string
     */
    public function getIpAdres()
    {
        return $this->ipAdres;
    }

    /**
     * Set dbName
     *
     * @param string $dbName
     *
     * @return Apteka
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;

        return $this;
    }

    /**
     * Get dbName
     *
     * @return string
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * Get aptekaId
     *
     * @return integer
     */
    public function getAptekaId()
    {
        return $this->aptekaId;
    }
}
