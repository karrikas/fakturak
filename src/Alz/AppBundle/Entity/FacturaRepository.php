<?php
namespace Alz\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class FacturaRepository extends EntityRepository
{
    public function findByUser($user_id)
    {
        $query = $this->getEntityManager()
            ->getRepository('AlzAppBundle:Factura')->createQueryBuilder('f')
            ->innerJoin('c.empresa', 'e')
            ->innerJoin('e.users', 'u')
            ->where('u.id = :userid')
            ->setParameter('userid', $user_id)
            ->getQuery();

        return $query->getResult();
    }

    public function getNumero($user_id, $ano)
    {
        $sql = 'SELECT f.numero FROM factura f INNER JOIN users_empresas u ON (u.empresa_id = f.empresa_id) WHERE u.userclone_id = :userid AND YEAR(f.fecha) = :ano ORDER BY f.numero DESC LIMIT 1';
        $params = array('userid' => $user_id, 'ano' => $ano);

        $em = $this->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $numero = $stmt->fetchColumn();

        if (is_null($numero)) {
            $numero = 0;
        }

        return $numero + 1;
    }
}

