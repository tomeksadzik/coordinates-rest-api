<?php

namespace App\Service;

use App\Entity\Point;

class PointLinker extends PointWriteService implements PointLinkerInterface
{
    /**
     * @param int $pointId
     * @param array $pointData
     * @return Point
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function link(int $pointId, array $pointData): Point
    {
        $parentObject = $this->getPointById($pointId);

        $childId = $this->extractId($pointData);
        $childObject = $this->getPointById($childId);

        $parentObject->addRelatedPoint($childObject);
        $this->pointWriteRepository->update($parentObject);

        return $parentObject;

    }

    /**
     * @param array $pointData
     * @return int
     */
    public function extractId(array $pointData): int
    {
        if (!array_key_exists(Point::ID_FIELD_NAME, $pointData)) {
            throw new \InvalidArgumentException('Id of related to Point required');
        }
        return $pointData[Point::ID_FIELD_NAME];
    }

}