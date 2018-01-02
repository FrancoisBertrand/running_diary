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

        $manager->persist($peter);
        $manager->persist($justus);
        $manager->persist($bob);

        $manager->flush();
    }
}