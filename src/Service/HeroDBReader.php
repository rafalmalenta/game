<?php


namespace App\Service;



use App\Entity\Hero;
use App\Entity\HeroClass;
use App\Entity\Item;
use App\Entity\ItemLocation;
use App\Entity\Level;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Contracts\Cache\CacheInterface;

class HeroDBReader
{
    private EntityManagerInterface $entityManager;
    private TokenStorageInterface $tokenStorage;

    private ?Hero $hero;
    private array $info;
    private ?array $gear;
    private ?array $backpack;
    private array $stats;
    private CacheInterface $cache;

    public function __construct(CacheInterface $cache, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
        $this->cache = $cache;
    }
    public function readHeroInfo():void
    {
        /**
         * @var $user User
         * @var $hero Hero
         */
        $user = $this->tokenStorage->getToken()->getUser();
        $hero = $user->getHero();
        $this->hero = $hero;
        $info["sex"] = $hero->getSex();
        $info["name"] = $hero->getName();
        $info["class"] = $hero->getClass()->getName();
        $info["level"] = $this->hero->getLevel();
        $info["XP"] = $this->hero->getExperience();
        $info["XPToNext"] = $info["level"]->getXPtoNext();

        $this->info=$info;

    }
    public function readHeroStats():void
    {
        /**
         * @var $hero Hero
         */
        $hero=$this->hero;
        $stats['main']["strength"]['stored'] = $hero->getStrength();
        $stats['main']["dexterity"]['stored'] = $hero->getDexterity();
        $stats['main']["wisdom"]['stored'] = $hero->getWisdom();
        $stats['main']["constitution"]['stored'] = $hero->getConstitution();
        $stats['main']["willpower"]['stored'] = $hero->getWillpower();
        $stats["free"]['stored'] = $hero->getStatsPoints();
        $this->stats = $stats;
    }
    public function readHeroGear(): void
    {
        $hero = $this->hero;
        /**
         * @var $hero HeroClass
         */
        $heroItems = $this->entityManager->getRepository(Item::class)->getAllHeroItems($hero);
//        dump($heroItems);
        $this->gear['mainHand'] = [];//$this->entityManager->getRepository(Weapon::class)->findOneBy(['owner' => $hero, 'worn' => "mainHand"]);
//
        $this->gear['offHand'] = [];//$this->entityManager->getRepository(Weapon::class)->findOneBy(['owner' => $hero, 'worn' => "offHand"]);
//
        $this->gear['armors'] = [];//$this->entityManager->getRepository(Armor::class)->findBy(['owner' => $hero, 'is_worn' => true]);
    }
    public function readHeroBackpack(): void
    {
        $backpackLocationId = $this->entityManager->getRepository(ItemLocation::class)->findOneBy(['location' => "backpack"]);
        $this->backpack = [];
        $hero = $this->hero;
        $backpack = $this->entityManager->getRepository(Item::class)->findBy(['owner' => $hero, 'location' => $backpackLocationId]);
        $this->backpack = $backpack;

    }
    public function getAll(): void
    {
        $this->readHeroInfo();
        $this->readHeroGear();
//        $this->readHeroStats();
//        $this->readHeroBackpack();

    }
    public function readAndReturn(): array
    {
        $this->getAll();
        return [
            'info'=>$this->info,
            'stats'=>$this->stats,
            'gear'=>$this->gear,
            'backpack'=>$this->backpack,
        ];
    }

}