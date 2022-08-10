<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@example.com');
        $password = $this->hasher->hashPassword($user, 'admin');
        $user->setPassword($password);
        $user->setName('Fahri');
        $user->setSurname('Vardar');
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setCreatedAt(date_create_immutable());
        $user->setModifiedAt(date_create_immutable());

        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('customer@example.com');
        $password = $this->hasher->hashPassword($user, 'customer');
        $user2->setPassword($password);
        $user2->setName('Customer');
        $user2->setSurname('Customer');
        $user2->setCreatedAt(date_create_immutable());
        $user2->setModifiedAt(date_create_immutable());
        $manager->persist($user2);


        $manager->flush();
    }
}
