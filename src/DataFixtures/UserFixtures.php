<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
   
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

   
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setemail('journaliste1@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $password = $this->encoder->encodePassword($user, '123456');
        $user->setPassword($password);
        $manager->persist($user);

       
        $user = new User();
        $user->setemail('journaliste2@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $password = $this->encoder->encodePassword($user, '789456');
        $user->setPassword($password);
        $manager->persist($user);

        // creation user pour test fonctionnel
        $user = new User();
        $user->setemail('journaliste_test@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $password = $this->encoder->encodePassword($user, 'test123');
        $user->setPassword($password);
        $manager->persist($user);


        $manager->flush();
    

    }
}
