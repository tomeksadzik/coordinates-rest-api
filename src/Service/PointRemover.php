<?php

namespace App\Service;

class PointRemover extends PointWriteService implements PointRemoverInterface
{
    /**
     * @param int $pointId
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function remove(int $pointId): void
    {
        $point = $this->getPointById($pointId);
        $this->pointWriteRepository->remove($point);
    }
}