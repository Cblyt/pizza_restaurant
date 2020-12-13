<?php
    // Server and DB connection values
    $servername = "localhost";
    $dbusername = "root";
    $db  = "socnet";
    $dbpassword = "";

    // Create connection
    $conn = new mysqli ($servername, $dbusername, $dbpassword, $db);

    //Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query
    $userQuery = "SELECT * FROM SystemUser";
    $userResult = $conn->query($userQuery);

    // Flag type variable
    $userFound = 0;

    // Values come from user entry in web form
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

    if ($userResult->num_rows > 0)
    {
        while ($userRow = $userResult->fetch_assoc())
        {
            if($userRow['Username'] == $username)
            {
                $userFound = 1;
                
                $decodedPassword = base64_decode($userRow['Password']);
                if($decodedPassword == $password)
                {                    
                    echo "Hi ".$username."<br />";
                    echo "Welcome back to your website!";
                }
                else 
                { 
                    echo "Wrong password"; 
                }
            }
        }

    }
    
    if ($userFound == 0)
    {
        echo "User was not found in our database";
    }
?>