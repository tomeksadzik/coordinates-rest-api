<?php

namespace App\Service;

use App\Entity\Point;

interface BasePointFieldsToArrayConverterInterface
{
    /**
     * @param Point $point
     * @return array
     */
    public function convert(Point $point): array;
}