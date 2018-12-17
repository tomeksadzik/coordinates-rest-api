<?php

namespace App\Service\Converter;

use App\Entity\Point;
use App\Service\BasePointFieldsToArrayConverterInterface;

class BasePointFieldsToArrayConverter implements BasePointFieldsToArrayConverterInterface
{
    /**
     * @param Point $point
     * @return array
     */
    public function convert(Point $point): array
    {
        return [
            'id' => $point->getId(),
            'type' => $point->getType(),
            'name' => $point->getName(),
            'lat' => $point->getLat(),
            'lng' => $point->getLng(),
        ];
    }
}