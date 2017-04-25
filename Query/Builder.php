<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SearchBundle\Query;

use MIT\Bundle\SearchBundle\Exception\MalFormedQueryException;
use Symfony\Component\VarDumper\VarDumper;

class Builder
{
    protected $query;

    public function build(array $query)
    {
        foreach (array_keys($query) as $key) {
            $this->validate($key, $query[$key]);
        }
        return $query;
    }

    public function getEntityClass($model)
    {
        $class = is_string($model)
            ? get_class(new $model())
            : get_class($model);
        if (!class_exists($class)) throw new MalFormedQueryException("The class $class does not exist.");
        return $class;
    }

    public function validate($model, $filters)
    {
        $class = $this->getEntityClass($model);
        foreach (array_keys($filters) as $key) {
            if (!property_exists($class, $key)) throw new MalFormedQueryException("The class $class has no property named $key.");
        }
    }
}