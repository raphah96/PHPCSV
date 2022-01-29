<?php

class phpCSV {

    private static $csv;
    private static $delimiter;
    private static $groupBy;
    private static $orderBy;
    private static $sort;
    private static $array;
    
    public function __construct($delimiter = ',', $groupBy = null, $orderBy = null, $sort = null){

        self::$delimiter = $delimiter;
        self::$groupBy = $groupBy;
        self::$orderBy = $orderBy;
        self::$sort = $sort;

    }

    public function parse(){

        $lines = explode(PHP_EOL, self::$csv);
        $columns = explode(self::$delimiter, $lines[0]);
        unset($lines[0]);

        $array = Array();

        $i = 0; // LINES INDEX

        foreach ($lines as $line){
            $items = explode(self::$delimiter, $line);
            
            $x = 0; // COLUMNS INDEX
            foreach ($items as $item){
                 
                $array[$i][$columns[$x]] = $item;
                $x++;
            }
            $i++;

        }

        // SORTING

        if (self::$sort){



        }

        if (self::$groupBy){

            $newArray = Array();

            foreach ($array as $item){
                foreach ($item as $key => $value){
                    foreach (self::$groupBy as $column){
                        if ($key == $column){
                            $newArray[$value][] = $item;
                            $i ++;
                        }

                    
                    }

                }

            }

            $array = $newArray;
            
        }

        self::$array = $array;

    }
    
    // PRINT

    public function printArray(){
        print_r(self::$array);
    }

    public function printCSV(){
        print_r(self::$csv);
    }

    // SETS

    public function setString($string){
        self::$csv = $string;
    }

    public function setFile($path){
        self::$csv = file_get_contents($path);
    }

    // GETS

    public function getArray(){
        return $array;
    }

    // METHODS

    public function groupBy($groupBy){
        self::$groupBy = $groupBy;
    }

}

$test = new phpCSV();
$test->setFile('data.csv');
$test->groupBy(['Brand']);
$test->parse();
$test->printArray();

?>
