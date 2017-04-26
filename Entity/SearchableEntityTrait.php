<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SearchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

trait SearchableEntityTrait
{
    /**
     * True if this object is searchable.
     *
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $searchable = true;

    /**
     * @return bool
     */
    public function isSearchable()
    {
        return $this->searchable;
    }

    /**
     * @param bool $searchable
     */
    public function setSearchable($searchable)
    {
        $this->searchable = $searchable;
    }
}