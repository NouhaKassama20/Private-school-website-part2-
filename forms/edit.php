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

if( $_SERVER['REQUEST_METHOD'] == 'GET')
{
   //show the data of the client:
   if( !isset($_GET["id"]) )
   {
      header("location: /El ameed/forms/admissionManagement.php");
      exit;
   }
   $id = $_GET["id"];
   //sql query allows us to read the data from the DB:
   $sql = "SELECT * FROM admission  WHERE id=$id";
   $result = $connection->query($sql);
   $row = $result->fetch_assoc();
   //if there is no student with the provided id so we can read the data:
   if(!$row)
   {
    header("location: /El ameed/forms/admissionManagement.php");
    exit;
   } 
   //display the data:
   $firstname= $row["firstName"];
   $lastname= $row["lastName"];
   $email= $row["email"];
   $city= $row["city"];
   $state= $row["state"];
   $phonenumber= $row["phoneNumber"];
   $language= $row["language"];
   $class= $row["class"];
}else{
    //update the data of the client using POST method:
    $id = $_POST["id"];
    $firstname= $_POST["firstName"];
    $lastname= $_POST["lastName"];
    $email= $_POST["email"];
    $city= $_POST["city"];
    $state= $_POST["state"];
    $phonenumber= $_POST["phoneNumber"];
    $language= $_POST["language"];
    $class= $_POST["class"];

    //the following do while loop provide proper validation(backend) for all form fields:
    do{
        if( empty($firstname) || empty($lastname) || empty($email) || empty($city) || empty($state) || empty($phonenumber) || empty($language) || empty($class))
        {
            $errorMessage= "All the fields are required.";
            break;
        }
        //sql query:
        $sql = "UPDATE admission 
                SET firstName = '$firstname', lastName = '$lastname', email = '$email', 
                city = '$city', state = '$state', phoneNumber = '$phonenumber', 
                language = '$language', class = '$class' 
                WHERE id = $id";
        $result = $connection->query($sql);
        if (!$result)
        {
            $errorMessage = "Invalid query: " . $connectiom->error;
            break;
        }       
        //if there is no problem we display a success message:
        $successMessage = "Student updated correctly.";
        //return to the index page:
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
        <h2>Update student</h2>

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

            <input type="hidden" name="id" value="<?php echo $id; ?>">    

            <!--First row-->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="firstName" value="<?php echo $firstname; ?>">
                </div>
            </div>
            <!--second row-->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lastName" value="<?php echo $lastname; ?>">
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
                    <input type="text" class="form-control" name="phoneNumber" value="<?php echo $phonenumber; ?>">
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