<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\History;
use App\DataFixtures\StatusFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class HistoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $yesterdayhistory = new History();
        $yesterdayhistory->setDate(new DateTime("yesterday"));
        $yesterdayhistory->setTotalanswer(45);
        $yesterdayhistory->setTotalgoodanswer(34);
        $yesterdayhistory->setStatus($this->getReference(200));
        $manager->persist($yesterdayhistory);

        $history = new History();
        $history->setDate(new DateTime("now"));
        $history->setTotalanswer(10);
        $history->setTotalgoodanswer(7);
        $history->setStatus($this->getReference(404));
        $manager->persist($history);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StatusFixtures::class,
        ];
    }
}
