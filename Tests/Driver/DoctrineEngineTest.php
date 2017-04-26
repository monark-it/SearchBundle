<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SearchBundle\Tests\Driver;

use MIT\Bundle\SearchBundle\Contracts\EngineInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DoctrineEngineTest extends WebTestCase
{
    private $doctrineEngine;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        self::bootKernel();
        $this->doctrineEngine = self::$kernel->getContainer()->get('mit_search.dotrine_engine');

        $this->assertInstanceOf(EngineInterface::class, $this->doctrineEngine);
    }

    public function testIndex()
    {
    }
}