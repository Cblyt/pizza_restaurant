<?php
    echo "<form action='complexLoginCheck.php' method='POST'>";
    echo "Username ";
    echo "<input name='txtUsername' type='text' required />";
    echo "<br />Password ";
    echo "<input name='txtPassword' type='password' required />";
    echo "<br /> <input type='submit' value='login' />";
    echo "</form>";
?>