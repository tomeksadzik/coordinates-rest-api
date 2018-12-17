<?php

namespace App\Service;

use App\Entity\Point;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PointObjectValidator implements PointObjectValidatorInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * PointValidator constructor.
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param Point $point
     * @return array
     */
    public function validate(Point $point): array
    {
        $errors =  $this->validator->validate($point);
        return $this->convertErrorMessage($errors);
    }

    /**
     * @param ConstraintViolationListInterface $errors
     * @return array
     */
    private function convertErrorMessage(ConstraintViolationListInterface $errors): array
    {
        $errorArr = [];
        foreach ($errors as $error) {
            $errorArr[] = sprintf('(%s) %s ',$error->getPropertyPath(), $error->getMessage() );
        }

        return $errorArr;
    }

}