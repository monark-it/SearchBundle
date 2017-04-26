<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SearchBundle\Contracts;

interface SearchManagerInterface
{
    /**
     * @param $query
     * @param null $context
     * @return mixed
     */
    public function search($query, $context=null);

    /**
     * @param $searchable
     * @return mixed
     */
    public function remove($searchable);

    /**
     * @param $searchable
     * @return mixed
     */
    public function update($searchable);

    /**
     * @param $searchable
     * @return mixed
     */
    public function insert($searchable);

    /**
     * @param $name
     * @return EngineInterface
     */
    public function engine($name);
}