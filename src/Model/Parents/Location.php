<?php


namespace App\Model\Parents;


trait Location
{
    private array $cords;
    /**
     * @param array $cords
     */
    public  function setCords(array $cords): void
    {
    $this->cords = $cords;
    }
    public function getCords(): array
    {
        return $this->cords;
    }
    public function getDistance(Fighter $enemy): int
    {
        $myCords = $this->getCords();
        $enemyCords = $enemy->getCords();
        $xDiff = $enemyCords['x'] - $myCords['x'];
        $yDiff = $enemyCords['y'] - $myCords['y'];

        //formula for distance if can move diagonal
        return abs($xDiff)>abs($yDiff) ? abs($xDiff) : abs($yDiff);
    }
    public function moveTowardTarget(Fighter $enemy): array
    {
        $myCords = $this->getCords();
        $enemyCords = $enemy->getCords();
        $xDiff = $enemyCords['x'] - $myCords['x'];
        $yDiff = $enemyCords['y'] - $myCords['y'];

        if (abs($xDiff) > 1)
            $myCords['x'] = $myCords['x'] + (1 * $xDiff/abs($xDiff)) ;
        if (abs($yDiff) > 1)
            $myCords['y'] = $myCords['y'] + (1 * $yDiff/abs($yDiff)) ;
        $this->setCords($myCords);
        return $myCords;
    }
}