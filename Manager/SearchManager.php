<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SearchBundle\Manager;

use MIT\Bundle\SearchBundle\Contracts\EngineInterface;
use MIT\Bundle\SearchBundle\Contracts\SearchManagerInterface;
use MIT\Bundle\SearchBundle\Engine\Driver\DoctrineEngine;
use MIT\Bundle\SearchBundle\Engine\EngineManager;

class SearchManager implements SearchManagerInterface
{
    /**
     * @var EngineManager
     */
    private $engineManager;

    /**
     * SearchManager constructor.
     * @param EngineManager $engineManager
     */
    public function __construct(EngineManager $engineManager)
    {
        $this->engineManager = $engineManager;
    }

    /**
     * @param $query
     * @param null $context
     * @return mixed
     */
    public function search($query, $context = null)
    {
        return $this->engine(DoctrineEngine::name)->search($query);
    }

    public function remove($searchable)
    {
        return $this->engine(DoctrineEngine::name)->remove($searchable);
    }

    public function update($searchable)
    {
        return $this->engine(DoctrineEngine::name)->update($searchable);
    }

    public function insert($searchable)
    {
        return $this->engine(DoctrineEngine::name)->insert($searchable);
    }

    /**
     * @param $name
     * @return EngineInterface
     */
    public function engine($name)
    {
        return $this->engineManager->engine($name);
    }
}