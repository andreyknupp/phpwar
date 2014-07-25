<?php
namespace Iannsp\PhpWar\Game\Score;
use \Iannsp\PhpWar\Arena as Arena;
use Iannsp\PhpWar\Move as Move;

class Neibor
{
    private $arena;
    public function __construct($arena)
    {
        $this->arena = $arena;
    }
    public function analyze($playerName, Move $move)
    {
        $coordinates = $move->getCoordenates();
        $warPlace    = $this->arena->getArena();
        return $this->calculate($coordinates['x'],$coordinates['y'], $warPlace, $playerName);
    }
    private function calculate($x, $y, $warPlace, $playerName)
    {
        $result = array(
            $warPlace[$x-1][$y+1], // left top corner
            $warPlace[$x][$y+1], // center top 
            $warPlace[$x+1][$y+1], // right top 
            $warPlace[$x-1][$y], // left same line 
            $warPlace[$x+1][$y], // right same line 
            $warPlace[$x-1][$y-1], // left bottom corner
            $warPlace[$x][$y-1], // center bootom 
            $warPlace[$x+1][$y-1] // right bottom 
        );
        foreach ($result as $idx=>$r){
            if (is_null($r))
                $result[$idx] = '.';
        }
        $count = array_count_values($result);
        $dominanteId    = key($count);
        $dominanteCount = array_shift($count);
        if ($dominanteId==$playerName || $dominanteId=='.')
            return true;
        return false;
    }
}

/*
1,1 = 
. . .
. 0 .
. . .
*/
    