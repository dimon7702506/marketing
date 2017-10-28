<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oborot
 *
 * @ORM\Table(name="oborot", uniqueConstraints={@ORM\UniqueConstraint(name="oborot_id", columns={"id"})})
 * @ORM\Entity
 */
class Oborot
{
    /**
     * @var integer
     *
     * @ORM\Column(name="tov_id", type="integer", nullable=false)
     */
    private $tovId;

    /**
     * @var float
     *
     * @ORM\Column(name="saldo_kol", type="float", precision=10, scale=0, nullable=false)
     */
    private $saldoKol;

    /**
     * @var integer
     *
     * @ORM\Column(name="apteka_id", type="integer", nullable=false)
     */
    private $aptekaId;

    /**
     * @var float
     *
     * @ORM\Column(name="prihod_kol", type="float", precision=10, scale=0, nullable=false)
     */
    private $prihodKol;

    /**
     * @var float
     *
     * @ORM\Column(name="rashod_kol", type="float", precision=10, scale=0, nullable=false)
     */
    private $rashodKol;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="sum", type="float", precision=10, scale=0, nullable=false)
     */
    private $sum;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set tovId
     *
     * @param integer $tovId
     *
     * @return Oborot
     */
    public function setTovId($tovId)
    {
        $this->tovId = $tovId;

        return $this;
    }

    /**
     * Get tovId
     *
     * @return integer
     */
    public function getTovId()
    {
        return $this->tovId;
    }

    /**
     * Set saldoKol
     *
     * @param float $saldoKol
     *
     * @return Oborot
     */
    public function setSaldoKol($saldoKol)
    {
        $this->saldoKol = $saldoKol;

        return $this;
    }

    /**
     * Get saldoKol
     *
     * @return float
     */
    public function getSaldoKol()
    {
        return $this->saldoKol;
    }

    /**
     * Set aptekaId
     *
     * @param integer $aptekaId
     *
     * @return Oborot
     */
    public function setAptekaId($aptekaId)
    {
        $this->aptekaId = $aptekaId;

        return $this;
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

    /**
     * Set prihodKol
     *
     * @param float $prihodKol
     *
     * @return Oborot
     */
    public function setPrihodKol($prihodKol)
    {
        $this->prihodKol = $prihodKol;

        return $this;
    }

    /**
     * Get prihodKol
     *
     * @return float
     */
    public function getPrihodKol()
    {
        return $this->prihodKol;
    }

    /**
     * Set rashodKol
     *
     * @param float $rashodKol
     *
     * @return Oborot
     */
    public function setRashodKol($rashodKol)
    {
        $this->rashodKol = $rashodKol;

        return $this;
    }

    /**
     * Get rashodKol
     *
     * @return float
     */
    public function getRashodKol()
    {
        return $this->rashodKol;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Oborot
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set sum
     *
     * @param float $sum
     *
     * @return Oborot
     */
    public function setSum($sum)
    {
        $this->sum = $sum;

        return $this;
    }

    /**
     * Get sum
     *
     * @return float
     */
    public function getSum()
    {
        return $this->sum;
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
