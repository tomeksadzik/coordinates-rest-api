<?php

namespace App\Service;

interface PointDataValidatorInterface
{
    /**
     * @param array $pointData
     */
    public function validate(array $pointData): void;

}