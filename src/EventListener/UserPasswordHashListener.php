<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Hashes the plain password entered in EasyAdmin before it ever reaches Doctrine,
 * so a User is never persisted with a clear-text password.
 */
final readonly class UserPasswordHashListener
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $entityManager,
    ) {}

    #[AsEventListener(event: BeforeEntityPersistedEvent::class)]
    public function onBeforeEntityPersisted(BeforeEntityPersistedEvent $event): void
    {
        $user = $event->getEntityInstance();

        if (!$user instanceof User) {
            return;
        }

        $plainPassword = $user->getPassword();

        if (null === $plainPassword || '' === $plainPassword) {
            return;
        }

        $user->setPassword($this->passwordHasher->hashPassword($user, $plainPassword));
    }

    #[AsEventListener(event: BeforeEntityUpdatedEvent::class)]
    public function onBeforeEntityUpdated(BeforeEntityUpdatedEvent $event): void
    {
        $user = $event->getEntityInstance();

        if (!$user instanceof User) {
            return;
        }

        $plainPassword = $user->getPassword();

        if (null === $plainPassword || '' === $plainPassword) {
            // Field left blank on the edit form: keep the hash already stored in the database.
            $originalPassword = $this->entityManager->getUnitOfWork()->getOriginalEntityData($user)['password'] ?? null;
            $user->setPassword($originalPassword ?? '');

            return;
        }

        $user->setPassword($this->passwordHasher->hashPassword($user, $plainPassword));
    }
}
