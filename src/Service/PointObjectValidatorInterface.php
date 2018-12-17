<?php

namespace App\Service;

use App\Entity\Point;

interface PointObjectValidatorInterface
{
    /**
     * @param Point $point
     * @return array
     */
    public function validate(Point $point): array;

}