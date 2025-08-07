<?php
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

//we will these variables to fill the form if there are any error:
$firstname="";
$lastname="";
$email="";
$city="";
$state="";
$phonenumber="";
$language="";
$class= "";

$errorMessage= "";
$successMessage= "";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $firstname= $_POST["firstname"];
    $lastname= $_POST["lastname"];
    $email= $_POST["email"];
    $city= $_POST["city"];
    $state= $_POST["state"];
    $phonenumber= $_POST["phonenumber"];
    $language= $_POST["language"];
    $class= $_POST["class"];

    //the following do while loop provide proper validation(backend) for all form fields:
    do{
        if( empty($firstname) || empty($lastname) || empty($email) || empty($city) || empty($state) || empty($phonenumber) || empty($language) || empty($class))
        {
            $errorMessage= "All the fields are required.";
            break;
        }

        //if we don't any problem we can create a new student now:
        $sql = "INSERT INTO admission (firstName, lastName, email, city, state, phonenumber, language, class)"."VALUES ('$firstname', '$lastname', '$email', '$city', '$state', '$phonenumber', '$language', '$class')";
        $result = $connection->query($sql);
        //if there is a problem it will display the errorMessage:
        if(!$result)
        {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }    


        $firstname="";
        $lastname="";
        $email="";
        $city="";
        $state="";
        $phonenumber="";
        $language="";
        $class= "";

        $succesMessage= "Client added correctly";

        header("location: /El ameed/forms/admissionManagement.php");
        exit;
    }while(false);    
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New student</h2>

        <?php
            if( !empty($errorMessage))
            {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></button>
                </div>
                "; 
            }
        ?>
        <!--create the form -->
        <form method="post">
            <!--First row-->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
                </div>
            </div>
            <!--second row-->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
                </div>
            </div>
            <!--third row-->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <!--fourth row-->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">City</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="city" value="<?php echo $city; ?>">
                </div>
            </div>
            <!--fifth row-->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">State</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="state" value="<?php echo $state; ?>">
                </div>
            </div>
            <!--sixth row-->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phonenumber" value="<?php echo $phonenumber; ?>">
                </div>
            </div>
            <!--seventh row-->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Language</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="language" value="<?php echo $language; ?>">
                </div>
            </div>
            <!--eigth row-->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Class</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="class" value="<?php echo $class; ?>">
                </div>
            </div>
            
            <?php
            if( !empty($succesMessage))
            {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$succesMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                "; 
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/El ameed/forms/admissionManagement.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>