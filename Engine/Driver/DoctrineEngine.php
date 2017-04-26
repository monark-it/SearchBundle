<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SearchBundle\Engine\Driver;

use Doctrine\ORM\EntityManagerInterface;
use MIT\Bundle\SearchBundle\Contracts\EngineInterface;
use Symfony\Component\VarDumper\VarDumper;

class DoctrineEngine implements EngineInterface
{
    const name = 'doctrine_engine';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * DoctrineEngine constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Search in the registry. The query shoul contain the entity and the search criteria.
     *
     * @param $query
     * @param null $context
     * @return array
     */
    public function search($query, $context=null)
    {
        $result = array();

        foreach(array_keys($query) as $type){
            $result[$type]  = $this->searchInSearchable($this->getClassName($type), $query[$type]);
        }
        return $result;
    }

    public function remove($searchable)
    {
        // TODO: Implement remove() method.
    }

    public function update($searchable)
    {
        // TODO: Implement update() method.
    }

    public function insert($searchable)
    {
    }

    /**
     * @param $searchableClass
     * @param array $criteria
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function buildQuery($searchableClass, array $criteria)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('sb')
            ->from($searchableClass, 'sb');

        foreach (array_keys($criteria) as $field){
            $qb->andWhere($qb->expr()->like('sb.'.$field, '\'%'.$criteria[$field].'%\''));
        }
        return $qb;
    }

    private function getClassName($type)
    {
        return $type
            ? $this->em->getClassMetadata($type)->getName()
            : null
        ;
    }

    private function searchInSearchable($searchableClass, array $criteria)
    {
        if (empty($searchableClass)) return [];
        $qb = $this->buildQuery($searchableClass, $criteria);

        return $qb->getQuery()->getResult();
    }
}
