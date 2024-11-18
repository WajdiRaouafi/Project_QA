<?php

namespace App\Test\Controller;

use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VoitureControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private VoitureRepository $repository;
    private string $path = '/voiture/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Voiture::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Voiture index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'voiture[modele]' => 'Testing',
            'voiture[serie]' => 'Testing',
            'voiture[date_mise_en_marche]' => 'Testing',
            'voiture[prix_jour]' => 'Testing',
        ]);

        self::assertResponseRedirects('/voiture/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Voiture();
        $fixture->setModele('My Title');
        $fixture->setSerie('My Title');
        $fixture->setDate_mise_en_marche('My Title');
        $fixture->setPrix_jour('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Voiture');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Voiture();
        $fixture->setModele('My Title');
        $fixture->setSerie('My Title');
        $fixture->setDate_mise_en_marche('My Title');
        $fixture->setPrix_jour('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'voiture[modele]' => 'Something New',
            'voiture[serie]' => 'Something New',
            'voiture[date_mise_en_marche]' => 'Something New',
            'voiture[prix_jour]' => 'Something New',
        ]);

        self::assertResponseRedirects('/voiture/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getModele());
        self::assertSame('Something New', $fixture[0]->getSerie());
        self::assertSame('Something New', $fixture[0]->getDate_mise_en_marche());
        self::assertSame('Something New', $fixture[0]->getPrix_jour());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Voiture();
        $fixture->setModele('My Title');
        $fixture->setSerie('My Title');
        $fixture->setDate_mise_en_marche('My Title');
        $fixture->setPrix_jour('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/voiture/');
    }
}
