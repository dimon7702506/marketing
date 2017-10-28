<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Catmc
 *
 * @ORM\Table(name="catmc")
 * @ORM\Entity
 */
class Catmc
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="prod_id", type="integer", nullable=false)
     */
    private $prodId;

    /**
     * @var integer
     *
     * @ORM\Column(name="tax_id", type="integer", nullable=false)
     */
    private $taxId;

    /**
     * @var integer
     *
     * @ORM\Column(name="morion_id", type="integer", nullable=true)
     */
    private $morionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="marketing_id", type="integer", nullable=true)
     */
    private $marketingId;

    /**
     * @var integer
     *
     * @ORM\Column(name="reg_nac", type="integer", nullable=true)
     */
    private $regNac;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Catmc
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
     * Set prodId
     *
     * @param integer $prodId
     *
     * @return Catmc
     */
    public function setProdId($prodId)
    {
        $this->prodId = $prodId;

        return $this;
    }

    /**
     * Get prodId
     *
     * @return integer
     */
    public function getProdId()
    {
        return $this->prodId;
    }

    /**
     * Set taxId
     *
     * @param integer $taxId
     *
     * @return Catmc
     */
    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;

        return $this;
    }

    /**
     * Get taxId
     *
     * @return integer
     */
    public function getTaxId()
    {
        return $this->taxId;
    }

    /**
     * Set morionId
     *
     * @param integer $morionId
     *
     * @return Catmc
     */
    public function setMorionId($morionId)
    {
        $this->morionId = $morionId;

        return $this;
    }

    /**
     * Get morionId
     *
     * @return integer
     */
    public function getMorionId()
    {
        return $this->morionId;
    }

    /**
     * Set marketingId
     *
     * @param integer $marketingId
     *
     * @return Catmc
     */
    public function setMarketingId($marketingId)
    {
        $this->marketingId = $marketingId;

        return $this;
    }

    /**
     * Get marketingId
     *
     * @return integer
     */
    public function getMarketingId()
    {
        return $this->marketingId;
    }

    /**
     * Set regNac
     *
     * @param integer $regNac
     *
     * @return Catmc
     */
    public function setRegNac($regNac)
    {
        $this->regNac = $regNac;

        return $this;
    }

    /**
     * Get regNac
     *
     * @return integer
     */
    public function getRegNac()
    {
        return $this->regNac;
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
}
