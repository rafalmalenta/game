<?php


namespace App\Service;


use App\Entity\Level;
use App\Model\Hero;
use Doctrine\ORM\EntityManagerInterface;

class LevelUper
{
    private Hero $hero;
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    public function addXp(Hero $hero, float $xp)
    {
        /**
         * @var $entity \App\Entity\Hero
         */
        $this->hero = $hero;
        $entity = $this->manager->getRepository(\App\Entity\Hero::class)->findOneBy(['name'=>$this->hero->info['name']]);
        $currentXP = $entity->getCurrentExperience();
        $lvl = $entity->getLevel();
        $missingXp = $this->manager->getRepository(Level::class)->findOneBy(['level'=>$lvl])->getXPtoNext() - $currentXP;
        if($missingXp <= $xp)
            $this->levelUp($xp);
        else{
            $entity->setCurrentExperience($xp + $currentXP );
            $this->manager->flush();
        }
    }
    public function levelUp(float $xp): void
    {
        /**
         * @var $entity \App\Entity\Hero
         */
        $entity = $this->manager->getRepository(\App\Entity\Hero::class)->findOneBy(['name'=>$this->hero->info['name']]);
        $currentXP = $entity->getCurrentExperience();
        $lvl = $entity->getLevel();
        $missingXp = $this->manager->getRepository(Level::class)->findOneBy(['level'=>$lvl])->getXPtoNext() - $currentXP;

        $freeStats = $entity->getAvailableStatsPoints();
        $entity->setCurrentExperience(0);
        $entity->setLevel($lvl+1);
        $entity->setAvailableStatsPoints($freeStats + 5);
        $this->manager->flush();
        $this->addXp($this->hero,$xp-$missingXp);
    }
}