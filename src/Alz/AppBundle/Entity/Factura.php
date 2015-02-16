<?php
namespace Alz\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Alz\AppBundle\Entity\FacturaConcepto;

/**
 * @ORM\Entity
 * @ORM\Table(name="factura")
 */
class Factura
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
    protected $numero;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fecha;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    protected $total;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    protected $totaliva;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $empresainfo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $clienteinfo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $informacion;

    /**
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="facturas")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     **/
    private $empresa;

    /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="facturas")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     **/
    private $cliente;

    /**
     * @ORM\OneToMany(targetEntity="FacturaConcepto", mappedBy="factura")
     **/
    private $conceptos;

    public function __construct() {
        $this->conceptos = new ArrayCollection();
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
     * Set numero
     *
     * @param string $numero
     * @return Factura
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Factura
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set total
     *
     * @param string $total
     * @return Factura
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
     * @return Factura
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
     * Set empresa
     *
     * @param string $empresa
     * @return Factura
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return string 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set cliente
     *
     * @param string $cliente
     * @return Factura
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return string 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set informacion
     *
     * @param string $informacion
     * @return Factura
     */
    public function setInformacion($informacion)
    {
        $this->informacion = $informacion;

        return $this;
    }

    /**
     * Get informacion
     *
     * @return string 
     */
    public function getInformacion()
    {
        return $this->informacion;
    }

    /**
     * Add conceptos
     *
     * @param \Alz\AppBundle\Entity\FacturaConcepto $conceptos
     * @return Factura
     */
    public function addConcepto(\Alz\AppBundle\Entity\FacturaConcepto $conceptos)
    {
        $this->conceptos[] = $conceptos;

        return $this;
    }

    /**
     * Remove conceptos
     *
     * @param \Alz\AppBundle\Entity\FacturaConcepto $conceptos
     */
    public function removeConcepto(\Alz\AppBundle\Entity\FacturaConcepto $conceptos)
    {
        $this->conceptos->removeElement($conceptos);
    }

    /**
     * Get conceptos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConceptos()
    {
        return $this->conceptos;
    }

    /**
     * Set product
     *
     * @param \Alz\AppBundle\Entity\Empresa $product
     * @return Factura
     */
    public function setProduct(\Alz\AppBundle\Entity\Empresa $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Alz\AppBundle\Entity\Empresa 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set empresainfo
     *
     * @param string $empresainfo
     * @return Factura
     */
    public function setEmpresainfo($empresainfo)
    {
        $this->empresainfo = $empresainfo;

        return $this;
    }

    /**
     * Get empresainfo
     *
     * @return string 
     */
    public function getEmpresainfo()
    {
        return $this->empresainfo;
    }

    /**
     * Set clienteinfo
     *
     * @param string $clienteinfo
     * @return Factura
     */
    public function setClienteinfo($clienteinfo)
    {
        $this->clienteinfo = $clienteinfo;

        return $this;
    }

    /**
     * Get clienteinfo
     *
     * @return string 
     */
    public function getClienteinfo()
    {
        return $this->clienteinfo;
    }
}
