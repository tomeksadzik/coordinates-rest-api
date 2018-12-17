<?php

namespace App\Service;

interface PointRemoverInterface
{
    /**
     * @param int $pointId
     */
    public function remove(int $pointId): void;
}