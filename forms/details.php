<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <title>Admission Management</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container my-5">
            <h2>Details about the Student:</h2>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Phone Number</th>
                        <th>Language</th>
                        <th>Class</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if the 'id' parameter exists in the URL
                    if (isset($_GET["id"])) {
                        // Validate and sanitize the 'id'
                        $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
                        if ($id === false) {
                            echo "<tr><td colspan='9'>Invalid student ID.</td></tr>";
                        } else {
                            // Database credentials
                            $serverName = "localhost";
                            $username = "root";
                            $password = "";
                            $databaseName = "privateschool";

                            // Create the connection
                            $connection = new mysqli($serverName, $username, $password, $databaseName);

                            // Check the connection
                            if ($connection->connect_error) {
                                die("Connection failed: " . $connection->connect_error);
                            }

                            // Secure SQL query using a prepared statement
                            $stmt = $connection->prepare("SELECT * FROM admission WHERE id = ?");
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // Check if the query returned a result
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                                    <tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['firstName']}</td>
                                        <td>{$row['lastName']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['city']}</td>
                                        <td>{$row['state']}</td>
                                        <td>{$row['phoneNumber']}</td>
                                        <td>{$row['language']}</td>
                                        <td>{$row['class']}</td>
                                    </tr>
                                    ";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No student found with the provided ID.</td></tr>";
                            }

                            // Close the connection
                            $stmt->close();
                            $connection->close();
                        }
                    } else {
                        echo "<tr><td colspan='9'>No student ID provided.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
