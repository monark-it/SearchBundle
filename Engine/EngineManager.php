<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SearchBundle\Engine;

use MIT\Bundle\SearchBundle\Engine\Driver\DoctrineEngine;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EngineManager implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * EngineManager constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function engine($name)
    {
        if(!in_array($name, array_keys($this->engines()), true)) throw new \Exception('This engine does not exist.');
        return $this->engines()[$name];
    }

    protected function engines()
    {
        // TODO: Register this engines in the dependency injection.
        return [
            'algolia'               => null,
            'elasticsearch'         => null,
            'solr'                  => null,
            DoctrineEngine::name    => $this->container->get('mit_search.dotrine_engine')
        ];
    }
}