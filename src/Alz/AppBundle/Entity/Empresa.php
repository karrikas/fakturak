<?php
namespace Alz\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Alz\UserBundle\Entity\User;
use Alz\AppBundle\Entity\Cliente;
use Alz\AppBundle\Entity\Factura;

/**
 * @ORM\Entity
 * @ORM\Table(name="empresa")
 */
class Empresa
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $logo;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    protected $monedatipo;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $monedaformato;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $mensajefacturas;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $premium = 0;

    /**
     * @ORM\ManyToMany(targetEntity="UserClone", mappedBy="empresas")
     **/
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="Cliente", mappedBy="empresa")
     **/
    private $clientes;

    /**
     * @ORM\OneToMany(targetEntity="Factura", mappedBy="empresa")
     **/
    private $facturas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->clientes = new ArrayCollection();
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
     * @return Empresa
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
     * @return Empresa
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
     * @return Empresa
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
     * @return Empresa
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
     * @return Empresa
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
     * @return Empresa
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
     * @return Empresa
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
     * @return Empresa
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
     * @return Empresa
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
     * @return Empresa
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
     * Set logo
     *
     * @param string $logo
     * @return Empresa
     */
    public function setLogo($logo)
    {
        if (null === $logo) {
            $this->logo = $this->getLogo();
        } else {
            $this->logo = $logo;
        }

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Add users
     *
     * @param \Alz\AppBundle\Entity\User $users
     * @return Empresa
     */
    public function addUser(\Alz\AppBundle\Entity\UserClone $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Alz\AppBundle\Entity\User $users
     */
    public function removeUser(\Alz\AppBundle\Entity\UserClone $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add clientes
     *
     * @param \Alz\AppBundle\Entity\Cliente $clientes
     * @return Empresa
     */
    public function addCliente(\Alz\AppBundle\Entity\Cliente $clientes)
    {
        $this->clientes[] = $clientes;

        return $this;
    }

    /**
     * Remove clientes
     *
     * @param \Alz\AppBundle\Entity\Cliente $clientes
     */
    public function removeCliente(\Alz\AppBundle\Entity\Cliente $clientes)
    {
        $this->clientes->removeElement($clientes);
    }

    /**
     * Get clientes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientes()
    {
        return $this->clientes;
    }

    /**
     * Add facturas
     *
     * @param \Alz\AppBundle\Entity\Factura $facturas
     * @return Empresa
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

    public function upload()
    {
        if (null === $this->getLogo()) {
            return;
        }

        if (is_string($this->getLogo())) {
            return;
        }

        $filename = $this->id . '.' .$this->getlogo()->guessextension();

        // you must throw an exception here if the file cannot be moved
        // so that the entity is not persisted to the database
        // which the UploadedFile move() method does
        $this->getLogo()->move(
            $this->getUploadDir(),
            $filename
        );

        $this->setLogo($filename);

        $this->imageResize();
    }

    private function getUploadDir()
    {
        return __DIR__ . '/../../../../web/empresa/';
    }

    private function imageResize($w = 100)
    {
        $file = $this->getUploadDir() . $this->logo;
        $ext = pathinfo($file, PATHINFO_EXTENSION);

        copy($file, $this->getUploadDir() . $this->id . '_original.' . $ext);
    
        list($width, $height) = getimagesize($file);
        $per = $w * 100 / $width;
        $h = $per * $height / 100;

        
        $thumb = imagecreatetruecolor($w, $h);
        switch ($ext) {
            case 'gif':
                $source = imageCreateFromGif($file);
            break;
            case 'jpeg':
            case 'jpg':
                $source = imageCreateFromJpeg($file);
            break;
            case 'png':
                $source = imageCreateFromPng($file);
                imagealphablending($thumb, false);
                imagesavealpha($thumb, true);
                $transparent = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
                imagefilledrectangle($thumb, 0, 0, $w, $h, $transparent);
            break;
            case 'bmp' :
                $source = imageCreateFromBmp($file);
            break;
        }    

        // Resize
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $w, $h, $width, $height);

        // Output
        switch ($ext) {
            case 'gif': 
                imagegif($thumb, $file); 
                break;
            case 'jpeg': 
            case 'jpg': 
                imagejpeg($thumb, $file, 100); 
                break; // best quality
            case 'png': 
                imagepng($thumb, $file, 0); 
                break; // no compression
            default: 
                // nothing
        }
    }

    /**
     * Set premium
     *
     * @param boolean $premium
     * @return Empresa
     */
    public function setPremium($premium)
    {
        $this->premium = $premium;

        return $this;
    }

    /**
     * Get premium
     *
     * @return boolean 
     */
    public function getPremium()
    {
        return $this->premium;
    }

    /**
     * Set monedatipo
     *
     * @param string $monedatipo
     * @return Empresa
     */
    public function setMonedatipo($monedatipo)
    {
        $this->monedatipo = $monedatipo;

        return $this;
    }

    /**
     * Get monedatipo
     *
     * @return string 
     */
    public function getMonedatipo()
    {
        return $this->monedatipo;
    }

    /**
     * Set monedaformato
     *
     * @param string $monedaformato
     * @return Empresa
     */
    public function setMonedaformato($monedaformato)
    {
        $this->monedaformato = $monedaformato;

        return $this;
    }

    /**
     * Get monedaformato
     *
     * @return string 
     */
    public function getMonedaformato()
    {
        return $this->monedaformato;
    }

    /**
     * Set mensajefacturas
     *
     * @param string $mensajefacturas
     * @return Empresa
     */
    public function setMensajefacturas($mensajefacturas)
    {
        $this->mensajefacturas = $mensajefacturas;

        return $this;
    }

    /**
     * Get mensajefacturas
     *
     * @return string 
     */
    public function getMensajefacturas()
    {
        return $this->mensajefacturas;
    }
}
