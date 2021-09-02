<?php


namespace App\Service\Battle;


use App\Model\Parents\Fighter;
use App\Service\LevelUper;
use App\Service\LootGenerator;
use Doctrine\ORM\EntityManagerInterface;

class BattleHandler
{
    private array $sides;

    private array $size;
    
    public array $report;

    private bool $finished;

    private EntityManagerInterface $manager;
    private array $attackersList;
    private array $defendersList;

    public function __construct(array $attackers, array $defenders, EntityManagerInterface $manager)
    {
        $this->sides['attackers'] = $attackers;
        $this->sides['defenders'] = $defenders;
        $this->defendersList = $defenders;
        $this->attackersList = $attackers;
        $this->finished = false;
        $this->size = [30,30];
        $this->manager = $manager;
    }
    //In order to keep things simple
    //dont care for collisions yet
    public function setStartingPosition()
    {
        foreach ($this->sides['attackers'] as $attacker){
            $attacker->setCords(['x'=>0, "y"=>0]);
        }
        foreach ($this->sides['defenders'] as $defender){
            $defender->setCords(['x'=>0, "y"=>3]);
        }
    }
    public function startBattle(): array
    {
        $this->setStartingPosition();
        $i = 0;
        while (!$this->finished and $i <= 1000) {
            $i++;
            foreach ($this->sides['attackers'] as $index=>$fighter){
                $this->report[$i][] = $this->handleFighterAction($fighter, 'attackers');
                $this->endCheck('defenders');
            }
            foreach ($this->sides['defenders'] as $index=>$fighter){
                $this->report[$i][] = $this->handleFighterAction($fighter, 'defenders');
                $this->endCheck('attackers');
            }
        }
        return $this->report;
    }
    public function endCheck(string $enemySide)
    {
        if($enemySide === "defenders" and count($this->sides["defenders"]) === 0) {
            $this->finished = true;
            $this->report['summary'] = [
                'action' => 'finished',
                'msg' => "U won"
            ];
            $xp = 0;
            $loot = [];
            foreach ($this->defendersList as $enemy){
                $xp = $xp +($enemy->info['level'] * $enemy->info['rewardsRank']);
                $generator = new LootGenerator($this->manager);
                $loot[] = $generator->generate($enemy, $this->attackersList[0]);
            }
            $lvluper = new LevelUper($this->manager);
            $lvluper->addXp($this->attackersList[0], $xp);
        }
        elseif($enemySide === "attackers" and count($this->sides["attackers"]) === 0) {
            $this->finished = true;
            $this->report['summary'] = [
                'action' => 'finished',
                'msg' => "U lost"
            ];
        }
    }
    public function removeCorpse(string $side, int $index)
    {
        if ($side === "defenders")
            unset($this->sides['defenders'][$index]);
        else{
            unset($this->sides['attackers'][$index]);
        }
    }

    private function handleFighterAction(Fighter $fighter, string $sideName): ?array
    {
        if($sideName == 'attackers'){
            $enemies = 'defenders';
            $allies = 'attackers';
        }
        else{
            $enemies = 'attackers';
            $allies = 'defenders';
        }
        $report = $fighter->doAction($this->sides[$enemies], $this->sides[$allies]);
        if ($report['action'] === "hit" and $report['kills']) {
            $this->removeCorpse($enemies, $report['whom']['index']);
        }
        return $report;
    }

}