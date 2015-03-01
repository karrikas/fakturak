<?php
namespace Alz\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class ClienteRepository extends EntityRepository
{
    public function findByUser($user_id, $type = 'object')
    {
        $query = $this->getEntityManager()
            ->getRepository('AlzAppBundle:Cliente')->createQueryBuilder('c')
            ->innerJoin('c.empresa', 'e')
            ->innerJoin('e.users', 'u')
            ->where('u.id = :userid')
            ->setParameter('userid', $user_id)
            ->orderBy('c.nombre', 'ASC')
            ->getQuery();

        if ($type == 'object') {
            return $query->getResult();
        } elseif($type == 'array') {
            return $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        }
    }
}
