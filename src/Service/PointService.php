<?php

namespace App\Service;

use App\Entity\Point;
use App\Repository\PointRepository;
use Doctrine\ORM\EntityNotFoundException;

abstract class PointService
{
    /**
     * @var PointRepository
     */
    protected $pointReadRepository;

    public function __construct(PointRepository $pointRepository)
    {
        $this->pointReadRepository = $pointRepository;
    }

    /**
     * @param int $pointId
     * @return Point
     * @throws EntityNotFoundException
     */
    protected function getPointById(int $pointId): Point
    {
        $point = $this->pointReadRepository->find($pointId);

        if (!$point) {
            throw new EntityNotFoundException(sprintf('Article with id %d does not exist!', $pointId));
        }

        return $point;
    }

}