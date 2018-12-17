<?php

namespace App\Service;

use App\Entity\Point;

interface PointLinkerInterface
{
    /**
     * @param int $pointId
     * @param array $pointData
     * @return Point
     */
    public function link(int $pointId, array $pointData): Point;
}