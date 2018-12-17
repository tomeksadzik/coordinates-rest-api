<?php

namespace App\Service;

use App\Entity\Point;

class PointCreator extends PointBaseCreator implements PointCreatorInterface
{

    /**
     * @param array $pointData
     * @return Point
     */
    public function create(array $pointData): Point
    {
        $point  = new Point();
        $filledPoint = $this->fill($point, $pointData);
        $this->pointWriteRepository->save($filledPoint);

        return $point;

    }

}