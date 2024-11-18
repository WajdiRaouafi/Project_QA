<?php

namespace App\Tests\Entity;

use App\Entity\Voiture;
use App\Entity\Location;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

class VoitureUnitTest extends TestCase
{
    public function testInstanceOfVoiture(): void
    {
        $voiture = new Voiture();
        $this->assertInstanceOf(Voiture::class, $voiture);
    }

    public function testIsTrueVoiture(): void
    {
        $voiture = new Voiture();
        $voiture->setModele('Tesla Model S')
                ->setSerie('12345-ABCD')
                ->setDateMiseEnMarche('2020-01-01')
                ->setPrixJour(100.0);

        // Asserting the values
        $this->assertSame('Tesla Model S', $voiture->getModele());
        $this->assertSame('12345-ABCD', $voiture->getSerie());
        $this->assertSame('2020-01-01', $voiture->getDateMiseEnMarche());
        $this->assertSame(100.0, $voiture->getPrixJour());
    }

    public function testIsFalseVoiture(): void
    {
        $voiture = new Voiture();
        $voiture->setModele('Tesla Model S')
                ->setSerie('12345-ABCD')
                ->setDateMiseEnMarche('2020-01-01')
                ->setPrixJour(100.0);

        // Asserting incorrect values
        $this->assertNotSame('Tesla Model X', $voiture->getModele());
        $this->assertNotSame('67890-WXYZ', $voiture->getSerie());
        $this->assertNotSame('2021-01-01', $voiture->getDateMiseEnMarche());
        $this->assertNotSame(200.0, $voiture->getPrixJour());
    }

    public function testDefaultValues(): void
    {
        $voiture = new Voiture();

        // Ensuring default values
        $this->assertNull($voiture->getModele());
        $this->assertNull($voiture->getSerie());
        $this->assertNull($voiture->getDateMiseEnMarche());
        $this->assertNull($voiture->getPrixJour());
        $this->assertInstanceOf(ArrayCollection::class, $voiture->getLocations());
        $this->assertCount(0, $voiture->getLocations());
    }

    public function testAddAndRemoveLocation(): void
    {
        $voiture = new Voiture();
        $location1 = new Location();
        $location2 = new Location();

        // Adding locations
        $voiture->addLocation($location1);
        $voiture->addLocation($location2);

        $this->assertCount(2, $voiture->getLocations());
        $this->assertTrue($voiture->getLocations()->contains($location1));
        $this->assertTrue($voiture->getLocations()->contains($location2));

        // Removing a location
        $voiture->removeLocation($location1);

        $this->assertCount(1, $voiture->getLocations());
        $this->assertFalse($voiture->getLocations()->contains($location1));
        $this->assertTrue($voiture->getLocations()->contains($location2));
    }
}
