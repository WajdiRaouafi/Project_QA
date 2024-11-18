<?php

namespace App\Tests\Entity;

use App\Entity\Location;
use App\Entity\Voiture;
use App\Entity\Client;
use PHPUnit\Framework\TestCase;

class LocationUnitTest extends TestCase
{
    public function testInstanceOfLocation(): void
    {
        $location = new Location();
        $this->assertInstanceOf(Location::class, $location);
    }

    public function testIsTrueLocation(): void
    {
        $location = new Location();
        $client = new Client();
        $voiture = new Voiture();

        // Setting values
        $location->setDateDebut('2020-01-10')
                 ->setDateRetour('2020-01-20')
                 ->setPrix(75.5)
                 ->setClient($client)
                 ->setVoiture($voiture);

        // Asserting the values
        $this->assertSame('2020-01-10', $location->getDateDebut());
        $this->assertSame('2020-01-20', $location->getDateRetour());
        $this->assertSame(75.5, $location->getPrix());
        $this->assertSame($client, $location->getClient());
        $this->assertSame($voiture, $location->getVoiture());
    }

    public function testIsFalseLocation(): void
    {
        $location = new Location();
        $client = new Client();
        $voiture = new Voiture();

        // Setting values
        $location->setDateDebut('2020-01-10')
                 ->setDateRetour('2020-01-20')
                 ->setPrix(75.5)
                 ->setClient($client)
                 ->setVoiture($voiture);

        // Asserting incorrect values
        $this->assertNotSame('2020-12-10', $location->getDateDebut());
        $this->assertNotSame('2020-12-20', $location->getDateRetour());
        $this->assertNotSame(100.0, $location->getPrix());
        $this->assertNotSame(new Client(), $location->getClient()); // Comparing different instances
        $this->assertNotSame(new Voiture(), $location->getVoiture()); // Comparing different instances
    }

    public function testDefaultValues(): void
    {
        $location = new Location();

        // Ensure default values are null
        $this->assertNull($location->getDateDebut());
        $this->assertNull($location->getDateRetour());
        $this->assertNull($location->getPrix());
        $this->assertNull($location->getClient());
        $this->assertNull($location->getVoiture());
    }
}
