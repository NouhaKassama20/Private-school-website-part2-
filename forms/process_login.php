<?php
try
{
$mysqlClient = new PDO('mysql:host=localhost;dbname=privateschool;charset=utf8', 'root', '');
echo "connection successful";
}
catch (PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM authentication WHERE username = '$username' AND password = '$password'";
$result = $mysqlClient->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify password (use password_verify() for secure password comparison)
    if (password_verify($password, $row['password'])) {
        // Successful login - start session and redirect
        echo "<script>alert(successful authentication)</script>";
    }else {
        // Invalid password
        echo "Invalid password.";
    }
}else {
    // User not found
    echo "User not found.";
}
?>