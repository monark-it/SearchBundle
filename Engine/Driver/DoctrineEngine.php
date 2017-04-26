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
        // TODO: Implement insert() method.
    }

    private function getClassName($type)
    {
        $index=$this->em->getRepository('MITSearchBundle:DoctrineEngineIndex')->findOneBy(['slug' => $type]);

        return $index
            ? $this->em->getClassMetadata($index->getClassName())->getName()
            : $index
        ;
    }

    private function searchInSearchable($searchableClass, array $criteria)
    {
        $rep = $this->em->getRepository($searchableClass);

        return $rep->findBy($criteria);
    }
}
