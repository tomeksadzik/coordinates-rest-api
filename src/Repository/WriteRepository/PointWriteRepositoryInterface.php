<?php

namespace App\Repository\WriteRepository;

use App\Entity\Point;

interface PointWriteRepositoryInterface
{

    /**
     * @param Point $point
     * @return Point
     */
    public function save(Point $point): Point;

    /**
     * @param Point $point
     * @return Point
     */
    public function update(Point $point): Point;

    /**
     * @param Point $point
     */
    public function remove(Point $point): void;

}