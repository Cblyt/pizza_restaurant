<?php
/**
 * In this case, we want to increase the default cost for BCRYPT to 12.
 * Note that we also switched to BCRYPT, which will always be 60 characters.
 */

// => use associative array concept of PHP. Examples of it were provided in basic to PHP slides
$options = [
    'cost' => 9,
];
$hash = password_hash("IntroductionToComputerSecurity", PASSWORD_ARGON2I, $options);

if (password_verify('IntroductionToComputerSecurity', $hash)) 
{
    echo 'Password is valid!';
} 
else 
{
    echo 'Invalid password.';
}

?>