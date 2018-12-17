<?php

namespace App\Service;

use App\Entity\Point;

class PointUpdater extends PointBaseCreator implements PointUpdaterInterface
{
    /**
     * @param int $pointId
     * @param array $pointData
     * @return Point
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function update(int $pointId, array $pointData): Point
    {
       $point  = $this->getPointById($pointId);
       $filledPoint = $this->fill($point, $pointData);
       $this->pointWriteRepository->update($filledPoint);

       return $point;
    }

}