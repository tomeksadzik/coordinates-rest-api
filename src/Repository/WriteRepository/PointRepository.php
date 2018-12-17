<?php

namespace App\Repository\WriteRepository;

use App\Entity\Point;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class PointRepository implements PointWriteRepositoryInterface
{

    /**
     * @var EntityManager
     */
    public $entityManager;

    /**
     * PointRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Point $point
     * @return Point
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Point $point): Point
    {
        $this->entityManager->persist($point);
        $this->entityManager->flush();

        return $point;
    }

    /**
     * @param Point $point
     * @return Point
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Point $point): Point
    {
        return $this->save($point);
    }

    /**
     * @param Point $point
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Point $point): void
    {
       $this->entityManager->remove($point);
       $this->entityManager->flush();
    }

}