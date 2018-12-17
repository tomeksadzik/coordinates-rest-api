<?php

namespace App\Service;

use App\Entity\Point;

interface PointUpdaterInterface
{
    /**
     * @param int $pointId
     * @param array $pointData
     * @return Point
     */
    public function update(int $pointId, array $pointData): Point;

}