<?php
     $con = mysqli_connect("localhost", "root", "", "privateschool");
     if($con == false)
     {
        die("Connection Error". mysqli_connect_error());
     }
     print "end connection";
     if (isset($_POST['submit']))
     {
         $firstName = $_POST['firstname'];
         $lastName = $_POST['lastname'];
         $email = $_POST['email'];
         $state = $_POST['state'];
         $city = $_POST['city'];
         $phone_number = $_POST['phonenumber'];
         $language = $_POST['language'];

         $query = mysqli_query($con, "Insert into  admission (firstName, lastName, email, state, city, phone_number, language) Values ('$firstName', '$lastName', '$email', '$state', '$city', '$phone_number', '$language')");
         if($query)
         {
            echo "<script>alert(The data inserted successfully)</script>";
         }else{
            echo "<script>alert(There is an error)</script>";
         }
     }
     print "end insertion";
?>


