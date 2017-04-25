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

interface EngineInterface
{
    /**
     * @param $query
     * @param $context
     * @return mixed
     */
    public function search($query, $context=null);

    /**
     * Remove a searchable object from the registry.
     *
     * @param $searchable
     * @return mixed
     */
    public function remove($searchable);

    /**
     * Update searchable object in the registry.
     *
     * @param $searchable
     * @return mixed
     */
    public function update($searchable);

    /**
     * Insert a searchable in the registry.
     *
     * @param $searchable
     * @return mixed
     */
    public function insert($searchable);
}
