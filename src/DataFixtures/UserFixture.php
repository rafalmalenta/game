<?php

namespace App\DataFixtures;

use App\Entity\Hero;
use App\Entity\HeroClass;
use App\Entity\Level;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordEncoder;
    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder=$passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $USER = new User();
        $USER->setEmail("test@a.a")
            ->setUsername("test")
            ->setPassword($this->passwordEncoder->hashPassword($USER, "1234"));
        $hero = new Hero();
        $knight= $manager->getRepository(HeroClass::class)->findOneBy(["name"=>"knight"]);
        $level = $manager->getRepository(Level::class)->findOneBy(['level'=>1]);
        $hero->setName("Abraxas")
            ->setSex("Male")
            ->setUser($USER)
            ->setExperience(0)
            ->setStrength(5)
            ->setDexterity(5)
            ->setWisdom(5)
            ->setConstitution(5)
            ->setWillpower(5)
            ->setStatsPoints(10)
            ->setLevel($level)
            ->setClass($knight);
        $manager->persist($hero);
        $manager->persist($USER);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ClassFixtures::class];
    }
}
