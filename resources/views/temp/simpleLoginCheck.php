<?php
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

    $list_of_usernames = array('Connor'=>'connorpw', 'Imran'=>'imranpw', 'Ed'=>'edpw');

    if (isset($list_of_usernames[$username]) && $password == $list_of_usernames[$username])
    {
        echo "Hi ".$username."<br />";
        echo "Welcome back to your website!";
    }
    else
    {
        echo "Wrong username or password";
    }
?>