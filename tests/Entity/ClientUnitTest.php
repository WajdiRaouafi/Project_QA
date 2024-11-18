<?php

namespace App\Tests\Entity;

use App\Entity\Client;
use App\Entity\Location;
use PHPUnit\Framework\TestCase;

class ClientUnitTest extends TestCase
{
    public function testInstanceOfClient(): void
    {
        $client = new Client();
        $this->assertInstanceOf(Client::class, $client);
    }

    public function testValidData(): void
    {
        $client = new Client();
        $client->setCin(123456)
            ->setNom('John')
            ->setPrenom('Doe')
            ->setAdresse('123 Main St.');

        $this->assertSame(123456, $client->getCin());
        $this->assertSame('John', $client->getNom());
        $this->assertSame('Doe', $client->getPrenom());
        $this->assertSame('123 Main St.', $client->getAdresse());
    }

    public function testInvalidData(): void
    {
        $client = new Client();
        $client->setCin(123456)
            ->setNom('John')
            ->setPrenom('Doe')
            ->setAdresse('123 Main St.');

        $this->assertNotSame(654321, $client->getCin());
        $this->assertNotSame('Jane', $client->getNom());
        $this->assertNotSame('Smith', $client->getPrenom());
        $this->assertNotSame('456 Another St.', $client->getAdresse());
    }

    public function testAddAndRemoveLocation(): void
    {
        $client = new Client();
        $location = new Location();

        // Test adding a location
        $client->addLocation($location);
        $this->assertCount(1, $client->getLocations());
        $this->assertTrue($client->getLocations()->contains($location));
        $this->assertSame($client, $location->getClient());

        // Test removing a location
        $client->removeLocation($location);
        $this->assertCount(0, $client->getLocations());
        $this->assertFalse($client->getLocations()->contains($location));
        $this->assertNull($location->getClient());
    }

    public function testInitialValues(): void
    {
        $client = new Client();

        $this->assertNull($client->getId());
        $this->assertNull($client->getNom());
        $this->assertNull($client->getPrenom());
        $this->assertNull($client->getCin());
        $this->assertNull($client->getAdresse());
        $this->assertCount(0, $client->getLocations());
    }
}


// class ClientUnitCaseTest extends TestCase
// {
//     public function testSomething(): void
//     {
//         $this->assertTrue(true);
//     }
//      public function testEntityClient(): void
//     {
//         $client=new Client();
//         $this->assertInstanceOf(Client::class, $client);
//     }

//     public function testIsTrue()
//     {
//         $client = new Client();
//         $client->setCin(123456) 
//                 ->setNom ('nom')
//                 ->setPrenom('prenom')
//                 ->setAdresse('adresse');

//         $this->assertTrue($client ->getCin() === 123456); 
//         $this->assertTrue($client ->getNom() === 'nom'); 
//         $this->assertTrue($client->getPrenom() === 'prenom');
//         $this->assertTrue($client->getAdresse() === 'adresse');
//     }

//     public function testIsFalse()
//     {
//         $client = new Client();
//         $client->setCin(123456) 
//                 ->setNom ('nom')
//                 ->setPrenom('prenom')
//                 ->setAdresse('adresse');

//         $this->assertFalse($client ->getCin() === 00000); 
//         $this->assertFalse($client ->getNom() === 'falsex'); 
//         $this->assertFalse($client->getPrenom() === 'falsex');
//         $this->assertFalse($client->getAdresse() === 'falseX');
//     }
// }
