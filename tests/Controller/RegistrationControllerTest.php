<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegistrationCreatesUserWithHashedPassword(): void
    {
        $client = static::createClient();
        // The sqlite ":memory:" test database only survives for the lifetime of this
        // container, so the kernel must not reboot between the schema setup and the requests.
        $client->disableReboot();
        $container = static::getContainer();

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get('doctrine')->getManager();
        $schemaTool = new SchemaTool($entityManager);
        $metadata = $entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->createSchema($metadata);

        $crawler = $client->request('GET', '/inscription');
        self::assertResponseIsSuccessful();

        $form = $crawler->selectButton('Inscription')->form([
            'registration_form[nom]' => 'Dupont',
            'registration_form[prenom]' => 'Alice',
            'registration_form[email]' => 'alice.dupont@example.com',
            'registration_form[plainPassword][first]' => 'Password1',
            'registration_form[plainPassword][second]' => 'Password1',
            'registration_form[agreeTerms]' => true,
        ]);

        $client->submit($form);

        self::assertResponseRedirects();

        /** @var UserRepository $userRepository */
        $userRepository = $container->get(UserRepository::class);
        $user = $userRepository->findOneBy(['email' => 'alice.dupont@example.com']);

        self::assertInstanceOf(User::class, $user);
        self::assertNotSame('Password1', $user->getPassword());
    }
}
