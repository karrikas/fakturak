<?php
namespace Alz\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="factura_concepto")
 */
class FacturaConcepto
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $iva;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    protected $total;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    protected $totaliva;

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
     * Set nombre
     *
     * @param string $nombre
     * @return FacturaConcepto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set iva
     *
     * @param integer $iva
     * @return FacturaConcepto
     */
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    /**
     * Get iva
     *
     * @return integer 
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set total
     *
     * @param string $total
     * @return FacturaConcepto
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set totaliva
     *
     * @param string $totaliva
     * @return FacturaConcepto
     */
    public function setTotaliva($totaliva)
    {
        $this->totaliva = $totaliva;

        return $this;
    }

    /**
     * Get totaliva
     *
     * @return string 
     */
    public function getTotaliva()
    {
        return $this->totaliva;
    }
}
