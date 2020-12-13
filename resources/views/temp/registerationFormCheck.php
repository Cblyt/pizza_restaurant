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
$base64password = base64_encode($password);


//  INSERT query   , check hash variable in the Values statement 
$userQuery = "INSERT INTO systemuser (Username, Password, Forename, Surname, Email) Values('$username', '$base64password', '$forname', '$surname', '$email')";

if ($conn->query($userQuery) == TRUE)
{
 echo "insert done";
}
else
{
	echo "not successfull";
}
?>

