<?php

namespace App\Service;

use App\Entity\Point;

interface PointMapperInterface
{
    /**
     * @param array $pointData
     * @return Point
     */
    public function mapValues(Point $point, array $pointData): Point;

}