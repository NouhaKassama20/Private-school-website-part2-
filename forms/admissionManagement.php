<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <title>Admission management</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container my-5">
            <h2>List of students: </h2>
            <a class="btn btn-primary" href="/El ameed/forms/create.php" role="button">New student</a>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Class</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

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
                    //read all rows from the database table:
                    $sql = "SELECT * FROM admission";
                    $result = $connection->query($sql);
                    //check the execution of query:
                    if(!$result)
                    {
                        die("Invalid query: " . $connection->error);
                    }
                    //read the data :
                    while($row = $result->fetch_assoc())
                    {
                        echo "
                        <tr>
                            <td>$row[firstName]</td>
                            <td>$row[lastName]</td>
                            <td>$row[class]</td>
                            <td>
                                <a class='btn btn-primary btn-sn' href='/El ameed/forms/details.php?id=$row[id]'>Details</a> 
                                <a class='btn btn-primary btn-sn' href='/El ameed/forms/edit.php?id=$row[id]'>Edit</a>
                               <a class='btn btn-danger btn-sm' href='/El ameed/forms/delete.php?id=$row[id]' onclick='return confirm(Are you sure you want to delete this record?);'>Delete</a>
                            </td>
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>