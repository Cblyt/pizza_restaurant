<?php
 $servername = "localhost";
 $rootuser="root";
 $db="socnet";
 $rootpassword ="";
// Create connection
$conn = new mysqli($servername, $rootuser, $rootpassword, $db);
// Check connection
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}

//Values from form
$username= $_POST['txtUsername'];
$forname =$_POST['txtForename'];
$surname = $_POST['txtSurname']; 
$email = $_POST['txtEmail']; 
$password = $_POST['txtPassword'];
$hashed_password = crypt($password, '12345');


//  INSERT query   , check hash variable in the Values statement 
$userQuery = "INSERT INTO systemuser (Username, Password, Forename, Surname, Email) Values('$username', '$hashed_password', '$forname', '$surname', '$email')";

if ($conn->query($userQuery) == TRUE)
{
 echo "insert done";
}
else
{
	echo "not successfull";
}
?>

