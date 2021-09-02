<?php


namespace App\Service\HeroCreation;


use App\Entity\HeroClass;
use App\Entity\Item;
use App\Entity\ItemLocation;
use App\Entity\Level;
use App\Entity\User;
use App\Entity\Hero;
use App\Entity\Weapon;
use App\Entity\WeaponBase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CreateHeroService
{
    private string $name;
    private string $sex;
    private string $class;
    private Hero $hero;
    private EntityManagerInterface $entityManager;
    private FlashBagInterface $flashBag;
    private TokenStorageInterface $tokenStorage;

    public function __construct(EntityManagerInterface $entityManager, FlashBagInterface $flashBag, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->flashBag = $flashBag;
        $this->tokenStorage = $tokenStorage;
    }
    public function passRequest(Request $request){
        $this->name = (string)$request->request->get('name');
        $this->sex = (string)$request->request->get('sex');
        $this->class = (string)$request->request->get('class');
    }

    public function createHero()
    {
        /**
         * @var $user User
         */
        $user = $this->tokenStorage->getToken()->getUser();
        $hero = new Hero();
        $this->hero =$hero;
        $class = $this->entityManager->getRepository(HeroClass::class)->findOneBy(["name"=>$this->class]);
        $level1 = $this->entityManager->getRepository(Level::class)->findOneBy(['level'=>1]);

        $hero->setName($this->name)
            ->setSex($this->sex)
            ->setUser($user)
            ->setStrength(5)
            ->setDexterity(5)
            ->setWisdom(5)
            ->setConstitution(5)
            ->setWillpower(5)
            ->setStatsPoints(10)
            ->setLevel($level1)
            ->setExperience(0)
            ->setClass($class);

        $this->entityManager->persist($hero);
        try {
            $this->entityManager->flush();
//            $this->addHeroStartingGear();
        }
        catch (\Exception $e) {
            $this->flashBag->add("error", "Internal server error, try again later");
        }
    }
//    public function addHeroStartingGear(){
//        $startingWeaponBase = [];
//        $user = $this->tokenStorage->getToken()->getUser();
//        $hero = $user->getHero();
//        if($this->class == "Knight") {
//            $startingWeaponBase[] = $this->entityManager->getRepository(WeaponBase::class)->findOneBy(['name' => 'Training Sword']);
//            $startingWeaponBase[] = $this->entityManager->getRepository(WeaponBase::class)->findOneBy(['name' => 'Training Shield']);
//        }
//        else if($this->class == "Rogue") {
//            $startingWeaponBase[] = $this->entityManager->getRepository(WeaponBase::class)->findOneBy(['name' => 'Training Dagger']);
//            $startingWeaponBase[] = $this->entityManager->getRepository(WeaponBase::class)->findOneBy(['name' => 'Training Dagger']);
//        }
//        else if($this->class == "Alchemist") {
//            $startingWeaponBase[] = $this->entityManager->getRepository(WeaponBase::class)->findOneBy(['name' => 'Training Potions Pouchh']);
//            $startingWeaponBase[] = $this->entityManager->getRepository(WeaponBase::class)->findOneBy(['name' => 'Training Handwraps']);
//        }
//        $backpackId = $this->entityManager->getRepository(ItemLocation::class)->findOneBy(['location'=>'backpack']);
//        foreach ($startingWeaponBase as $startingBase) {
//            $startingWeapon = new Item();
//            $startingWeapon->setOwner($this->hero)
//                ->addWeaponBase($startingBase)
//                ->setLocation($backpackId);
//
//
//            $this->entityManager->persist($startingWeapon);
//        }
//        try {
//            $this->entityManager->flush();
//        }
//        catch (\Exception $e){
//
//        }
//    }
}