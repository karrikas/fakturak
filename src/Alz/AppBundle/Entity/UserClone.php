<?php
namespace Alz\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Alz\AppBundle\Entity\Empresa;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_clone")
 */
class UserClone
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Empresa", inversedBy="users")
     * @ORM\JoinTable(name="users_empresas")
     **/
    private $empresas;

    public function __construct() {
        $this->empresas = new ArrayCollection();
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
     * Add empresas
     *
     * @param \Alz\AppBundle\Entity\Empresa $empresas
     * @return UserClone
     */
    public function addEmpresa(\Alz\AppBundle\Entity\Empresa $empresas)
    {
        $this->empresas[] = $empresas;

        return $this;
    }

    /**
     * Remove empresas
     *
     * @param \Alz\AppBundle\Entity\Empresa $empresas
     */
    public function removeEmpresa(\Alz\AppBundle\Entity\Empresa $empresas)
    {
        $this->empresas->removeElement($empresas);
    }

    /**
     * Get empresas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmpresas()
    {
        return $this->empresas;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return UserClone
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
