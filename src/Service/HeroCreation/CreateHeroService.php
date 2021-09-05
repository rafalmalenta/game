<?php


namespace App\Service\HeroCreation;


use App\Entity\Currency;
use App\Entity\Gear;
use App\Entity\HeroClass;
use App\Entity\HeroCurrency;
use App\Entity\HeroItems;
use App\Entity\Level;
use App\Entity\User;
use App\Entity\Hero;
use App\Entity\WearingPlace;
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
        $this->hero = $hero;
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
        $allCurrencies = $this->entityManager->getRepository(Currency::class)->findAll();
        foreach ($allCurrencies as $currency){
            $currentCurrency = new HeroCurrency();
            $currentCurrency->setAmount(10)
                ->setHero($hero)
                ->setCurrency($currency);
            $this->entityManager->persist($currentCurrency);
        }


        $this->entityManager->persist($hero);
        try {
            $this->entityManager->flush();
            $this->addHeroStartingGear();
        }
        catch (\Exception $e) {
            $this->flashBag->add("error", "Internal server error, try again later");
        }
    }
    public function addHeroStartingGear(){
        $startingWeaponBase = [];
        $user = $this->tokenStorage->getToken()->getUser();
        $hero = $user->getHero();

        if($this->class == "Knight") {
            $startingWeaponBase[] = $this->entityManager->getRepository(Gear::class)->findOneBy(['name' => 'Training Sword'])->getItems()[0];
            $startingWeaponBase[] = $this->entityManager->getRepository(Gear::class)->findOneBy(['name' => 'Training Shield'])->getItems()[0];
        }
        else if($this->class == "Rogue") {
            $startingWeaponBase[] = $this->entityManager->getRepository(Gear::class)->findOneBy(['name' => 'training dual daggers'])->getItems()[0];
        }
        else if($this->class == "Alchemist") {
            $startingWeaponBase[] = $this->entityManager->getRepository(Gear::class)->findOneBy(['name' => 'Training Alchemical Pouch'])->getItems()[0];
            $startingWeaponBase[] = $this->entityManager->getRepository(Gear::class)->findOneBy(['name' => 'training hand-to-hand'])->getItems()[0];
        }
        $backpackId = $this->entityManager->getRepository(WearingPlace::class)->findOneBy(['location'=>'backpack']);

        foreach ($startingWeaponBase as $startingBase) {
            $startingWeapon = new HeroItems();
            $startingWeapon->setHero($this->hero)
                ->setItem($startingBase)
                ->setLocation($backpackId);
            $this->entityManager->persist($startingWeapon);
        }

        try {
            $this->entityManager->flush();
        }
        catch (\Exception $e){

        }
    }
}