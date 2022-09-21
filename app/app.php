<?php
namespace App;
require_once 'CommissionCalculator.php';

$path=$argv[1];
$file = fopen($path, "r");
$commission=new CommissionCalculator();

while(!feof($file)) {

    $line = fgets($file);
    print $commission->calculator($line)."\n";
    //$commission->calculator($line);

}

fclose($file);


?>