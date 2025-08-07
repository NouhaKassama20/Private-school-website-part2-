<?php
if( isset($_GET["id"]) )
{
    $id = $_GET["id"];
    //connect to the database:
    $serverName= "localhost";
    $username= "root";
    $password= "";
    $databaseName= "privateschool";
    //create the connection:
    $connection = new mysqli($serverName, $username, $password, $databaseName);
    //check the connection:
    if ($connection->connect_error){
        die("Connection failed: " . $connection->connect_error);
    }
    //delete the student with the given id from the database:
    $sql = "DELETE FROM  admission  WHERE id=$id";
    $connection->query($sql);
}

header("location: /El ameed/forms/admissionManagement.php");
exit;

?>