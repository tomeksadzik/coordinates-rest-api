<?php

namespace App\Service;

use App\Entity\Point;
use App\Repository\PointRepository;
use App\Repository\WriteRepository\PointWriteRepositoryInterface;

abstract class PointBaseCreator extends PointWriteService
{
    /**
     * @var PointMapperInterface
     */
    private $pointMapper;

    /**
     * @var PointObjectValidatorInterface
     */
    private $pointValidator;

    /**
     * @var PointDataValidatorInterface
     */
    private $pointDataValidator;

    /**
     * PointCreator constructor.
     * @param PointRepository $pointRepository
     * @param PointWriteRepositoryInterface $pointWriteRepository
     * @param PointMapperInterface $pointMapper
     * @param PointObjectValidatorInterface $pointValidator
     * @param PointDataValidatorInterface $pointDataValidator
     */
    public function __construct(
        PointRepository $pointRepository,
        PointWriteRepositoryInterface $pointWriteRepository,
        PointMapperInterface $pointMapper,
        PointObjectValidatorInterface $pointValidator,
        PointDataValidatorInterface $pointDataValidator
    )
    {
        parent::__construct($pointRepository, $pointWriteRepository);
        $this->pointMapper = $pointMapper;
        $this->pointValidator = $pointValidator;
        $this->pointDataValidator = $pointDataValidator;
    }

    /**
     * @param Point $point
     * @param array $pointData
     * @return Point
     */
    protected function fill(Point $point, array $pointData): Point
    {
        $this->pointDataValidator->validate($pointData);
        $mappedPoint = $this->pointMapper->mapValues($point, $pointData);
        $errors = $this->pointValidator->validate($mappedPoint);

        if (count($errors) > 0) {
            throw new \InvalidArgumentException(implode(", ",$errors));
        }

        return $mappedPoint;
    }
}