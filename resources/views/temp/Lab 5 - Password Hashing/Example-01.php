<?php
// Set the password
     $password = 'mypassword';
     $salt = '';
// Get the hash, letting the salt be automatically generated
    $hash = crypt($password);
    echo($hash); //$1$W.g0x8qU$iZJKy3y6hzJLan9jezwf3/
?>