<?php
namespace Alz\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="factura_concepto")
 * @ORM\Entity(repositoryClass="Alz\AppBundle\Entity\FacturaConceptoRepository")
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
     * @ORM\Column(type="decimal", nullable=true)
     */
    protected $precio;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $cantidad;

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
     * @ORM\ManyToOne(targetEntity="Factura", inversedBy="conceptos")
     * @ORM\JoinColumn(name="factura_id", referencedColumnName="id")
     **/
    private $factura;

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

    /**
     * Set factura
     *
     * @param \Alz\AppBundle\Entity\Factura $factura
     * @return FacturaConcepto
     */
    public function setFactura(\Alz\AppBundle\Entity\Factura $factura = null)
    {
        $this->factura = $factura;

        return $this;
    }

    /**
     * Get factura
     *
     * @return \Alz\AppBundle\Entity\Factura 
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * Set precio
     *
     * @param string $precio
     * @return FacturaConcepto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set integer
     *
     * @param integer $integer
     * @return FacturaConcepto
     */
    public function setInteger($integer)
    {
        $this->integer = $integer;

        return $this;
    }

    /**
     * Get integer
     *
     * @return integer 
     */
    public function getInteger()
    {
        return $this->integer;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return FacturaConcepto
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }
}
