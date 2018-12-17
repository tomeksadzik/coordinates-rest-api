<?php

namespace App\Service;

use App\Entity\Point;

interface PointProviderInterface
{
    /**
     * @param int $pointId
     * @return Point
     */
    public function getPoint(int $pointId): Point;

    /**
     * @return Point[]
     */
    public function getAllPoints(): array;

}