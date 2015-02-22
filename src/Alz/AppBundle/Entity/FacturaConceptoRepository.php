<?php
namespace Alz\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class FacturaConceptoRepository extends EntityRepository
{
    public function findAllByFactura($factura_id, $user_id)
    {
        $query = $this->getEntityManager()
            ->getRepository('AlzAppBundle:Factura')->createQueryBuilder('f')
            //->innerJoin('fc.factura', 'f')
            ->innerJoin('f.empresa', 'e')
            /*
            ->innerJoin('e.users', 'u')
            ->where('u.id = :userid')
            ->setParameter('userid', $user_id)
*/
            ->getQuery();

        return $query->getResult();
    }
}
