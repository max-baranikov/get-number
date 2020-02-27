<?php


namespace App\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class NumberRepository extends EntityRepository
{
    public function findAllWithId()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT n.numberId as number from App\Entity\Number n'
            )
            ->getResult();
    }

    /**
     * @param $number
     * @return mixed
     */
    public function addNumber($number)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('result', 'number');

        return $this->getEntityManager()
            ->createNativeQuery('CALL AddNumber(?)', $rsm)
            ->setParameter(1, $number)
            ->getResult();
    }

    public function removeAll()
    {
        return $this->getEntityManager()
            ->createQuery(
                'DELETE from App\Entity\Number n'
            )
            ->getResult();
    }
}