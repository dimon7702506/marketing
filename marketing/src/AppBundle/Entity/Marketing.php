<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marketing
 *
 * @ORM\Table(name="marketing", uniqueConstraints={@ORM\UniqueConstraint(name="marketing_id", columns={"marketing_id"})})
 * @ORM\Entity
 */
class Marketing
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="percent", type="integer", nullable=false)
     */
    private $percent;

    /**
     * @var float
     *
     * @ORM\Column(name="sum", type="float", precision=10, scale=0, nullable=false)
     */
    private $sum;

    /**
     * @var integer
     *
     * @ORM\Column(name="marketing_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $marketingId;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Marketing
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
     * Set percent
     *
     * @param integer $percent
     *
     * @return Marketing
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;

        return $this;
    }

    /**
     * Get percent
     *
     * @return integer
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * Set sum
     *
     * @param float $sum
     *
     * @return Marketing
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
     * Get marketingId
     *
     * @return integer
     */
    public function getMarketingId()
    {
        return $this->marketingId;
    }
}
