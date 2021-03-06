<?php
namespace Alz\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Alz\AppBundle\Entity\Factura;
use Alz\AppBundle\Entity\ClienteRepository;

/**
 * @ORM\Entity
 * @ORM\Table(name="cliente")
 * @ORM\Entity(repositoryClass="Alz\AppBundle\Entity\ClienteRepository")
 */
class Cliente
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $cif;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $direccion1;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $direccion2;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $cp;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $region;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $ciudad;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $telefono;


    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $fax;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $email;

    /**
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="clientes")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     **/
    private $empresa;

    /**
     * @ORM\OneToMany(targetEntity="Factura", mappedBy="cliente")
     **/
    private $facturas;

    public function __toString()
    {
        return $this->getNombre();
    }

    public function __construct() {
        $this->facturas = new ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Cliente
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
     * Set cif
     *
     * @param string $cif
     * @return Cliente
     */
    public function setCif($cif)
    {
        $this->cif = $cif;

        return $this;
    }

    /**
     * Get cif
     *
     * @return string 
     */
    public function getCif()
    {
        return $this->cif;
    }

    /**
     * Set direccion1
     *
     * @param string $direccion1
     * @return Cliente
     */
    public function setDireccion1($direccion1)
    {
        $this->direccion1 = $direccion1;

        return $this;
    }

    /**
     * Get direccion1
     *
     * @return string 
     */
    public function getDireccion1()
    {
        return $this->direccion1;
    }

    /**
     * Set direccion2
     *
     * @param string $direccion2
     * @return Cliente
     */
    public function setDireccion2($direccion2)
    {
        $this->direccion2 = $direccion2;

        return $this;
    }

    /**
     * Get direccion2
     *
     * @return string 
     */
    public function getDireccion2()
    {
        return $this->direccion2;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return Cliente
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Cliente
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     * @return Cliente
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Cliente
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Cliente
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Cliente
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add facturas
     *
     * @param \Alz\AppBundle\Entity\Factura $facturas
     * @return Cliente
     */
    public function addFactura(\Alz\AppBundle\Entity\Factura $facturas)
    {
        $this->facturas[] = $facturas;

        return $this;
    }

    /**
     * Remove facturas
     *
     * @param \Alz\AppBundle\Entity\Factura $facturas
     */
    public function removeFactura(\Alz\AppBundle\Entity\Factura $facturas)
    {
        $this->facturas->removeElement($facturas);
    }

    /**
     * Get facturas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFacturas()
    {
        return $this->facturas;
    }

    /**
     * Set empresa
     *
     * @param \Alz\AppBundle\Entity\Empresa $empresa
     * @return Cliente
     */
    public function setEmpresa(\Alz\AppBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \Alz\AppBundle\Entity\Empresa 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }
}
