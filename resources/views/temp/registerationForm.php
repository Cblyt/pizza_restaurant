<?php
echo "<form action='registerationFormCheck.php' method='post'>";
echo "<pre>"; // check in Google what pre does
echo "Forename:";
echo "<input name='txtForename' type='text'/>";
echo "<br/>";

echo "Surname:";
echo " <input name='txtSurname' type='text'/>";
echo "<br/>";

echo "Email:";
echo "   <input name='txtEmail' type='text'/>";
echo "<br/>";

echo "UserName:";
echo "<input name='txtUsername' type='text'/>";
echo "<br/>";

echo "Password:";
echo "<input name='txtPassword' type='password'/>";

echo "<br/>";

echo "<br/>"; 
echo "<input type='submit' value='Login'>";

echo "</pre>";
echo "</form>";

?>

