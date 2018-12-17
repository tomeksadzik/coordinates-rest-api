<?php

namespace App\Service;

use App\Entity\Point;

class PointMapper implements PointMapperInterface
{

    /**
     * @param Point $point
     * @param array $pointData
     * @return Point
     */
    public function mapValues(Point $point, array $pointData): Point
    {
        $point = $this->mapType($point, $pointData);
        $point = $this->mapName($point, $pointData);
        $point = $this->mapLat($point, $pointData);
        $point = $this->mapLng($point, $pointData);

        return $point;
    }

    /**
     * @param array $pointData
     * @param string $fieldName
     * @return string|null
     */
    private function getValue(array $pointData, string $fieldName): string
    {
        return $pointData[$fieldName] ?? '';
    }

    /**
     * @param Point $point
     * @param array $pointData
     * @return Point
     */
    private function mapType(Point $point, array $pointData): Point
    {
        $type = $this->getValue($pointData, Point::TYPE_FIELD_NAME);
        if (!is_null($type)) {
            $point->setType($type);
        }

        return $point;
    }
    /**
     * @param Point $point
     * @param array $pointData
     * @return Point
     */
    private function mapName(Point $point, array $pointData): Point
    {
        $name = $this->getValue($pointData, Point::NAME_FIELD_NAME);
        if (!is_null($name)) {
            $point->setName($name);
        }

        return $point;
    }

    /**
     * @param Point $point
     * @param array $pointData
     * @return Point
     */
    private function mapLat(Point $point, array $pointData): Point
    {
        $lat = $this->getValue($pointData, Point::LAT_FIELD_NAME);
        if (!is_null($lat)) {
            $point->setLat($lat);
        }

        return $point;
    }

    /**
     * @param Point $point
     * @param array $pointData
     * @return Point
     */
    private function mapLng(Point $point, array $pointData): Point
    {
        $lng = $this->getValue($pointData, Point::LNG_FIELD_NAME);
        if (!is_null($lng)) {
            $point->setLng($lng);
        }

        return $point;
    }

}