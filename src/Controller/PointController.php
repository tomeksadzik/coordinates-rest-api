<?php

namespace App\Controller;

use App\Service\Converter\PointToArrayConverter;
use App\Service\PointCreatorInterface;
use App\Service\PointLinkerInterface;
use App\Service\PointProviderInterface;
use App\Service\PointRemoverInterface;
use App\Service\PointToArrayConverterInterface;
use App\Service\PointUpdaterInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PointController extends AbstractController
{
    /**
     * Add new Point
     *
     * @Rest\Post("/points")
     *
     * @param Request $request
     * @param PointCreatorInterface $pointCreator
     * @param PointToArrayConverter $pointConverter
     * @return View
     */
    public function addPoint(Request $request, PointCreatorInterface $pointCreator, PointToArrayConverter $pointConverter): View
    {
        $point = $pointCreator->create($request->request->all());
        $convertedPoint = $pointConverter->convert($point);

        return View::create($convertedPoint, Response::HTTP_CREATED);
    }

    /**
     * Change Point resource
     *
     * @Rest\Put("/points/{pointId}")
     *
     * @param int $pointId
     * @param Request $request
     * @param PointUpdaterInterface $pointUpdater
     * @param PointToArrayConverter $pointConverter
     * @return View
     */
    public function updatePoint(int $pointId,Request $request, PointUpdaterInterface $pointUpdater, PointToArrayConverter $pointConverter): View
    {
        $point = $pointUpdater->update($pointId, $request->request->all());
        $convertedPoint = $pointConverter->convert($point);

        return View::create($convertedPoint, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Point resource
     *
     * @Rest\Get("/points")
     * @param PointProviderInterface $pointProvider
     * @param PointToArrayConverterInterface $pointToArrayConverter
     * @return View
     */
    public function getPoints(PointProviderInterface $pointProvider, PointToArrayConverterInterface $pointToArrayConverter): View
    {
        $points = $pointProvider->getAllPoints();
        $convertedPoints = [];
        foreach ($points as $point) {
            $convertedPoints[] = $pointToArrayConverter->convert($point);
        }

        return View::create($convertedPoints,Response::HTTP_OK);
    }

    /**
     * Retrieves a Point resource
     *
     * @Rest\Get("/points/{pointId}")
     * @param int $pointId
     * @param PointProviderInterface $pointProvider
     * @param PointToArrayConverterInterface $pointToArrayConverter
     * @return View
     */
    public function getPoint(int $pointId, PointProviderInterface $pointProvider, PointToArrayConverterInterface $pointToArrayConverter): View
    {
        $point = $pointProvider->getPoint($pointId);
        $convertedPoint = $pointToArrayConverter->convert($point);

        return View::create($convertedPoint,Response::HTTP_OK);
    }

    /**
     * Remove Point resource
     *
     * @Rest\Delete("/points/{pointId}")
     * @param int $pointId
     * @param PointRemoverInterface $pointRemover
     * @return View
     */
    public function removePoint(int $pointId, PointRemoverInterface $pointRemover): View
    {
        $pointRemover->remove($pointId);

        return View::create([],Response::HTTP_NO_CONTENT);
    }

    /**
     * Add new Point to Point link
     *
     * @Rest\Post("/related-points/{pointId}")
     *
     * @param int $pointId
     * @param Request $request
     * @param PointLinkerInterface $pointLinker
     * @param PointToArrayConverter $pointConverter
     * @return View
     */
    public function addRelatedPoint(int $pointId, Request $request, PointLinkerInterface $pointLinker, PointToArrayConverter $pointConverter): View
    {
        $point = $pointLinker->link($pointId, $request->request->all());
        $convertedPoint = $pointConverter->convert($point);

        return View::create($convertedPoint, Response::HTTP_CREATED);
    }

}