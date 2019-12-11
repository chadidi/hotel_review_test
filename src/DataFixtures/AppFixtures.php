<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Hotel;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $hotel = new Hotel();
            $hotel->setName($faker->company);
            $hotel->setCreatedAt($created_at = $faker->dateTime('-1 month'));
            $manager->persist($hotel);
            for ($i = 0; $i < 7; $i++) {
                $review = new Review();
                // $review->setHotelId($hotel->getId());
                $review->setTitle($faker->sentence);
                $review->setBody($faker->text(500));
                $review->setRating($faker->randomFloat(2, 0, 5));
                $review->setCreatedAt($faker->dateTimeBetween($created_at, 'now'));
                $hotel->addReview($review);
                $manager->persist($review);
            }
        }

        $manager->flush();
    }
}
