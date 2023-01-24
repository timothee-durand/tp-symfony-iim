<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ){}

    public function load(ObjectManager $manager): void
    {

        $superAdmin = new User();
        $superAdmin->setEmail('admin@disney.com');
        $superAdmin->setPassword($this->passwordHasher->hashPassword($superAdmin, 'root'));
        $superAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($superAdmin);

        for($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail('user-' . $i . '@disney.com');
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
