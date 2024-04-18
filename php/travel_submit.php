<?php

$servername = "localhost";      // MySQL server address
$username = "root";             // MySQL username
$password = "";                 // MySQL password
$dbname = "dbaddy";             // Name of the database you want to create

// Create Mysql connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$result = $conn->query($sql);

if (!$result) {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Connect to the database without closing the connection
$conn->select_db($dbname);

$tableName = 'phptravel';
$sql = "CREATE TABLE IF NOT EXISTS $tableName (
        sno INT AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(50),
        lastname VARCHAR(50),
        email VARCHAR(100),
        mobile VARCHAR(15),
        departure_city VARCHAR(100),
        arrival_city VARCHAR(100),
        departure_date DATE,
        arrival_date DATE,
        passengers INT,
        travel_arrangement VARCHAR(255),
        preferred_service VARCHAR(50)
    )";

$result = $conn->query($sql);

if (!$result) {
    echo "Error creating table: " . $conn->error;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Travel Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <!-- Footer remains at the bottom -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="content">
        <!-- Creating navbar -->
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
            <div class="container-fluid">
                <ul class="nav nav-tabs ">
                    <li class="nav-item">
                        <a class="nav-link link-light" aria-current="page" href="../../Personal_Form/personal.html">Personal Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-dark active" href="../travel.html">Travel Details</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit"> Search </button>
                </form>
            </div>
        </nav>

        <!-- Creating Alert -->
        <?php
        // echo var_dump($_SERVER);                             //^ to print all the keys of associative array of $Server super global variable
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // echo var_dump($_POST);                           //! input name is stored as associative keys in the array.
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];

            $email = $_POST['email'];
            $mobile = $_POST['mobile'];

            $departure_city = $_POST['city_from'];
            $arrival_city = $_POST['city_to'];

            $departure_date = $_POST['depart_date'];
            $arrival_date = $_POST['arrival_date'];

            $passengers = isset($_POST['passengers']) ? intval($_POST['passengers']) : '';   //^ converting the string value into the integer.
            $travel = isset($_POST['travel']) ? $_POST['travel'] : '';
            $service = isset($_POST['service']) ? $_POST['service'] : '';

            $sql = "INSERT INTO $tableName (firstname, lastname, email, mobile, departure_city, arrival_city, departure_date, arrival_date, passengers, travel_arrangement, preferred_service) 
                    VALUES ('$fname', '$lname', '$email', '$mobile', '$departure_city', '$arrival_city', '$departure_date', '$arrival_date', $passengers, '$travel', '$service')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo '<div class="alert alert-success text-center" role="alert"> 
                        <strong>Pack yor bags !!</strong> 
                        <span>Don\'t worry, we will gonna make your trip memorable</span>
                    </div>';
            } else {
                echo '<div class="alert alert-danger text-center" role="alert"> 
                        <strong>Error !!</strong> 
                        <span>Due to technical glitch your details has not been submitted, Sorry for the inconvinience.<span>
                        <p>Please try again later</p>
                    </div>';
            }
        }

            // Closing the connection
            $conn->close();
        ?>
    </div>
    
    <!-- Creating Footer -->
    <footer class="container-fluid d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">© 2024 Company, Inc</p>

        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
        </ul>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>

</body>

</html>