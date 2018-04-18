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

///////

      public function remove($query)
    {
       // $cpt=0;
        foreach(array_keys($query) as $type){

            $this->deleteQuery($this->getClassName($type),$query[$type]);
         }
       // return !$cpt ? 1 : 0;
    }


    public function update($values)
    {
        foreach(array_keys($values) as $val){

             $this->updateQuery($this->getClassName($val),$values[$val]);
        }
    }


    public function insert($query)
    {

        foreach (array_keys($query) as $value)
        {
            $this->insertQuery($this->getClassName($value),$query[$value]);
        }

    }

    private function deleteQuery($searchableClass, $filtres)
    {
        //$res=0;
        foreach ($filtres as $val)
        {
            $prop=array_keys($filtres)[0];
            $qb = $this->em->createQueryBuilder();
            $res= $qb->delete($searchableClass,'sb')
                ->where("sb.$prop = :value")
                ->setParameter('value',$val)
                ->getQuery()
                ->getResult();
        }
       // return !$res ? 1 : 0;
    }


    private function insertQuery($searchableClass,$values)
    {
        $obj=new $searchableClass();
        $i=-1;
        foreach ($values as $val)
        {
           $i++;
           $prop="set".ucfirst(array_keys($values)[$i]);
           $obj->$prop($val);
        }

        try{
            $this->em->persist($obj);
            $this->em->flush();
            return "Record ajouter!";
        }
        catch (Exception $e){

            return "Record non ajouter!";
        }

    }

    private function updateQuery($searchableClass, $values)
    {
        if (array_key_exists('id', $values)) {

            $i=-1;
            foreach ($values as $val)
            {
                $i++;$cpt=0;
                $prop=array_keys($values)[$i];

                if($i==0)
                {
                    $obj= $this->em->getRepository($searchableClass)->findOneBy(["id"=>$val]);
                }
                if($prop!="id")
                {
                    $prop="set".ucfirst(array_keys($values)[$i]);
                    $obj->$prop($val);
                }
            }

            $this->em->persist($obj);
            $this->em->flush();
          //  return 1;
        }
        //return 0;
    }

    //////

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