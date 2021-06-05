<?php

class ChainDriver
{
    public $qualifiedNumbers;
    private $maxNumber;
    private $testNum;

    /**
     * ChainDriver constructor.
     * @param $maxNumber
     * @param $testNum
     */
    public function __construct($maxNumber,$testNum){
        $this->maxNumber = $maxNumber;
        $this->testNum = $testNum;
        $this->qualifiedNumbers = [];
    }

    /**
     * @param int $number
     * @return float|int
     */
    public function createNewNumber(int $number)
    {
        $numArr = str_split($number);
        $newNum = 0;
        foreach($numArr as $num){
            $newNum += pow($num,2);
        }

        return $newNum;
    }

    /**
     * @param array $numArr
     * @param int $test
     * @return bool
     */
    public function testNumber(array $numArr, int $test)
    {
        $last = end($numArr);

        if($last == $test){
            return true;
        }

        return false;
    }

    /**
     * @param $num
     */
    public function runNumber($num)
    {
        $numArr = [];
        $newNum = $num;
        $repeated = false;

        while(!$repeated){
            $newNum = $this->createNewNumber($newNum);
            if(in_array($newNum,$numArr)){
                $repeated = true;
            }
            $numArr[] = $newNum;
        }

        if($this->testNumber($numArr,$this->testNum)){
            $this->qualifiedNumbers[] = $num;
        }

    }

    /**
     * function to start the Process.
     */
    public function runProgram()
    {
        for($i= 1; $i<$this->maxNumber; $i++){
            $this->runNumber($i);
        }
    }

    /**
     * Funtion to get the count of numbers that made the cut.
     * @return int
     */
    public function getNumbersQualifiedCount()
    {
        return count($this->qualifiedNumbers);
    }

}

$maxNum = 100000;
$testAgainst = 89;
$testRide = new ChainDriver($maxNum,$testAgainst);

$testRide->runProgram();
echo "There are ".$testRide->getNumbersQualifiedCount()." starting numbers below $maxNum that will arrive at $testAgainst.";


