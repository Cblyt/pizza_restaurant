<?php

$new = [
    'options' => ['cost' => 11],
    'algo' => PASSWORD_DEFAULT,
    'hash' => null
];

$password = 'rasmuslerdorf';

//stored hash of password
$oldHash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

//verify stored hash against plain-text password
if (true === password_verify($password, $oldHash)) 
 {
    //verify legacy password to new password_hash options
 
  if (true === password_needs_rehash($oldHash, $new['algo'], $new['options'])) 
    {
        //rehash/store plain-text password using new hash
        $newHash = password_hash($password, $new['algo'], $new['options']);
        echo 'Hash changed from ' . $oldHash . ' to ' . $newHash;
    }
}
?>
