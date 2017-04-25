<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SearchBundle\Searchable;

use MIT\Bundle\SearchBundle\Contracts\SearchableInterface;

trait Searchable
{
    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }

    /**
     * @param array $query
     * @param null $context
     * @param null $callback
     * @return mixed
     */
    public function search(array $query, $context = null, $callback = null)
    {
        // TODO: Implement search() method.
    }

    /**
     * Remove this searchable from the search repository.
     *
     * @return mixed
     */
    public function remove()
    {
        // TODO: Implement remove() method.
    }

    /**
     * @return SearchableInterface
     */
    public function update()
    {
        // TODO: Implement update() method.
    }

    public function insert()
    {
        // TODO: Implement insert() method.
    }

    /**
     * @return SearchableInterface
     */
    public function makeSearchable()
    {
        // TODO: Implement makeSearchable() method.
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }

    public function getName()
    {
        return static::class;
    }

    public function getType()
    {
        return $this->getName();
    }
}