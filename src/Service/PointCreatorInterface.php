<?php

namespace App\Service;

use App\Entity\Point;

interface PointCreatorInterface
{
    /**
     * @param array $pointData
     * @return Point
     */
    public function create(array $pointData): Point;
}