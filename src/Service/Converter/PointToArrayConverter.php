<?php

namespace App\Service\Converter;

use App\Entity\Point;
use App\Service\BasePointFieldsToArrayConverterInterface;
use App\Service\PointToArrayConverterInterface;

class PointToArrayConverter implements PointToArrayConverterInterface
{
    /**
     * @var BasePointFieldsToArrayConverterInterface
     */
    private $basePointFieldsConverter;

    /**
     * PointToArrayConverter constructor.
     * @param BasePointFieldsToArrayConverterInterface $basePointFieldsConverter
     */
    public function __construct(BasePointFieldsToArrayConverterInterface $basePointFieldsConverter)
    {
        $this->basePointFieldsConverter = $basePointFieldsConverter;
    }

    /**
     * @param Point $point
     * @return array
     */
    public function convert(Point $point): array
    {
        $convertedPoint = $this->basePointFieldsConverter->convert($point);
        $convertedPoint[Point::RELATED_POINTS_FIELD_NAME] = $this->convertRelatedPoints($point);

        return $convertedPoint;
    }

    /**
     * @param Point $point
     * @return array
     */
    protected function convertRelatedPoints(Point $point): array
    {
        $convertedPoints = [];
        foreach ($point->getRelatedPoints() as $relatedPoint) {
            $convertedPoints[] = $this->basePointFieldsConverter->convert($relatedPoint);
        }

        return $convertedPoints;
    }

}