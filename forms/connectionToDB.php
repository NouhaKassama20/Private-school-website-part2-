<?php
     $con = mysqli_connect("localhost", "root", "", "privateschool");
     if($con == false)
     {
        die("Connection Error". mysqli_connect_error());
     }else
     {
        die("Connection successful". mysqli_connect_error());
     }
?>
