<?php

namespace App\Service;

use App\Entity\Point;

class PointDataValidator implements PointDataValidatorInterface
{

    /**
     * @param array $pointData
     */
    public function validate(array $pointData): void
    {
        $this->validateId($pointData);
        $this->validateRelatedPoints($pointData);
    }

    /**
     * @param array $pointData
     */
    private function validateRelatedPoints(array $pointData): void
    {
        if (array_key_exists(Point::RELATED_POINTS_FIELD_NAME , $pointData)) {
            throw new \InvalidArgumentException('Points can be link only with the dedicated method.');
        }
    }

    /**
     * @param array $pointData
     */
    private function validateId(array $pointData): void
    {
        if (array_key_exists(Point::ID_FIELD_NAME , $pointData)) {
            throw new \InvalidArgumentException('You can not define id yourself.');
        }
    }

}