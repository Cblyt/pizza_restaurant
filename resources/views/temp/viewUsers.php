<?php
    //Server and DB connection values
    $servername = "localhost";
    $dbusername = "root";
    $db  = "socnet";
    $dbpassword = "";

    //Create connection
    $conn = new mysqli ($servername, $dbusername, $dbpassword, $db);

    //Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $userQuery = "SELECT * FROM SystemUser";
    $userResult = $conn->query($userQuery);

    echo "<h1> Registered Users d etails, stored in text form </h1>";
    echo "<h2> RockYou incident in 2009 tells us that is extermely dangerous </h2>";
    echo "<h3> Hanging car keys outside of your house door </h3>";

    echo "<table border='1'>";

    if ($userResult->num_rows > 0)
    {
        echo "<tr>";
        echo "<td> ID</td>";
        echo "<td> Username </td>";
        echo "<td> Password </td>";
        echo "<td> Forname </td>";
        echo "<td> Surname</td>";
        echo "<td> Email </td>";
        echo "</tr>";
        while($userRow = $userResult->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>" .$userRow['ID'] . "</td>";
            echo "<td>" .$userRow['Username'] . "</td>";
            echo "<td>" .$userRow['Password'] . "</td>";
            echo "<td>" .$userRow['Forename'] . "</td>";
            echo "<td>" .$userRow['Surname'] . "</td>";
            echo "<td>" .$userRow['Email'] . "</td>";
            echo "</tr>";  
        }
    }
    echo "</table";


?>