<?php

namespace App\Controller;

use App\Repository\HotelRepository;
use App\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HotelController extends AbstractController
{
    private $hotelRepository;
    private $reviewRepository;

    public function __construct(HotelRepository $hotelRepository, ReviewRepository $reviewRepository)
    {
        $this->hotelRepository = $hotelRepository;
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * @Route("/{hotelId}/today/review", name="hotel_today_review", methods={"GET"})
     */
    public function todayReview($hotelId): JsonResponse
    {
        $hotel = $this->hotelRepository->findOneBy(['id' => $hotelId]);

        if (!$hotel) {
            return new JsonResponse([
                'error' => [
                    'message' => 'The hotel id was not found.',
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        $count = $hotel->getReviews()->count();
        // dd($count);
        $today_review = $this->reviewRepository->getRandomEntity($hotelId)->toArray();

        return new JsonResponse([
            'today_review' => $today_review,
        ], Response::HTTP_OK);
    }
}
