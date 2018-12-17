<?php

namespace App\Service;

use App\Entity\Point;
use Doctrine\ORM\EntityNotFoundException;

class PointProvider extends PointService implements PointProviderInterface
{
    /**
     * @param int $pointId
     * @return Point
     * @throws EntityNotFoundException
     */
    public function getPoint(int $pointId): Point
    {
        return $this->getPointById($pointId);
    }

    /**
     * @return array
     */
    public function getAllPoints(): array
    {
        return $this->pointReadRepository->findAll();
    }

}