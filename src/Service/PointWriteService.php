<?php

namespace App\Service;

use App\Repository\PointRepository;
use App\Repository\WriteRepository\PointWriteRepositoryInterface;

abstract class PointWriteService extends PointService
{
    /**
     * @var PointWriteRepositoryInterface
     */
    protected $pointWriteRepository;

    public function __construct(PointRepository $pointRepository, PointWriteRepositoryInterface $pointWriteRepository)
    {
        parent::__construct($pointRepository);
        $this->pointWriteRepository = $pointWriteRepository;
    }

}