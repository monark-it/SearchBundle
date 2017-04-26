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

interface SearchableInterface
{
    /**
     * Search this object.
     *
     * @param $query
     * @param null $context
     * @param null $callback
     * @return mixed
     */
    public function search($query, $context=null, $callback = null);

    /**
     * Remove this from the registry.
     *
     * @return mixed
     */
    public function remove();

    /**
     * @return mixed
     */
    public function update();

    /**
     * @return mixed
     */
    public function insert();

    /**
     * @return mixed
     */
    public function toArray();
}