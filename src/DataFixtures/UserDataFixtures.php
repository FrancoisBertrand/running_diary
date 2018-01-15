<?php
/**
 * Created by IntelliJ IDEA.
 * User: francoisbertrand
 * Date: 02.01.18
 * Time: 19:22
 */

namespace App\DataFixtures;

use App\Entity\RunDiary;
use App\Entity\UserData;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserDataFixtures extends Fixture{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $peter = new UserData();
        $peter->setUsername('Peter');
        $peter->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $peter->setPassword($this->encoder->encodePassword($peter, 'nummerZwei'));

        $justus = new UserData();
        $justus->setUsername('Justus');
        $justus->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $justus->setPassword($this->encoder->encodePassword($justus, 'nummerEins'));

        $bob = new UserData();
        $bob->setUsername('Bob');
        $bob->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $bob->setPassword($this->encoder->encodePassword($bob, 'nummerdrei'));

        //  Aufgabe 7
        $user1 = new UserData();
        $user1->setUsername('Pascal');
        $user1->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user1->setPassword($this->encoder->encodePassword($user1, 'pascal'));

        $user2 = new UserData();
        $user2->setUsername('Petra');
        $user2->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user2->setPassword($this->encoder->encodePassword($user2, 'petra'));

        $user3 = new UserData();
        $user3->setUsername('Paul');
        $user3->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user3->setPassword($this->encoder->encodePassword($user3, 'paul'));

        $user4 = new UserData();
        $user4->setUsername('Maria');
        $user4->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user4->setPassword($this->encoder->encodePassword($user4, 'maria'));

        $user5 = new UserData();
        $user5->setUsername('Jakob');
        $user5->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user5->setPassword($this->encoder->encodePassword($user5, 'jakob'));

        $user6 = new UserData();
        $user6->setUsername('Claude');
        $user6->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user6->setPassword($this->encoder->encodePassword($user6, 'claude'));

        $user7 = new UserData();
        $user7->setUsername('Klaus');
        $user7->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user7->setPassword($this->encoder->encodePassword($user7, 'klaus'));

        $user8 = new UserData();
        $user8->setUsername('Marta');
        $user8->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user8->setPassword($this->encoder->encodePassword($user8, 'marta'));

        $user9 = new UserData();
        $user9->setUsername('Sebastian');
        $user9->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user9->setPassword($this->encoder->encodePassword($user9, 'sebastian'));

        $user10 = new UserData();
        $user10->setUsername('Skinny');
        $user10->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user10->setPassword($this->encoder->encodePassword($user10, 'skinny'));

        //

        $manager->persist($peter);
        $manager->persist($justus);
        $manager->persist($bob);

        // Aufgabe 7
        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->persist($user4);
        $manager->persist($user5);
        $manager->persist($user6);
        $manager->persist($user7);
        $manager->persist($user8);
        $manager->persist($user9);
        $manager->persist($user10);

        //

        $diary = new RunDiary();
        $diary->setDistance(34.4);
        $diary->setAvgSpeed(10);
        $diary->setDuration("02:02:02");
        $diary->setDate(new \DateTime());
        $diary->setOwner($bob);
        $manager->persist($diary);

        $manager->flush();
    }
}