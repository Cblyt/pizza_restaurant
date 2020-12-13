<?php 
    $str = " Introduction To Computer Security ";
    echo bin2hex($str) . "<br>";
    echo pack("H*",bin2hex($str)) . "<br>";



    echo pack("H*", "658484656775") . "<br>"; // Task 3

    $str = " Introduction To Computer Security "; // Task 4
    echo bin2hex($str) . "<br>";
    $hexstr = bin2hex($str);
    echo hex2bin($hexstr) . "<br>";
?>