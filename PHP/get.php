<?php 
session_start();

// Database connection
$hst = "sql213.infinityfree.com";
$name = "if0_35559466";
$psw = "zUyaFaAZhcFe";
$dbname = "if0_35559466_guvi";
$str = "mysql:host=" . $hst . ";dbname=" . $dbname;
$con = new PDO($str, $name, $psw);

// User data from POST
$username = $_POST["username"];
$dob = $_POST["dob"];
$age = $_POST["age"];
$contact = $_POST["contact"];
$email = $_POST["email"];
$password = $_POST["password"];

// Initialize Redis connection
require "predis/autoload.php";
Predis\Autoloader::register();
$redis = new Predis\Client();

// Check if the email already exists in the Redis cache
$emailExists = $redis->get('emailExists_' . $email);

if ($emailExists !== false && $emailExists == 1) {
    echo "Email '$email' already exists.";
} else {
    // Check if the email exists in the database
    $emailExistsQuery = "SELECT COUNT(*) FROM login WHERE email = :email";
    $stmt = $con->prepare($emailExistsQuery);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $emailCount = $stmt->fetchColumn();

    if ($emailCount > 0) {
        // Email exists in the database
        echo "Email '$email' already exists.";
        // Store the email existence status in Redis with an expiration time of 1 hour
        $redis->setex('emailExists_' . $email, 3600, 1);
    } else {
        // Email doesn't exist, proceed with insertion into the database
        $sql = "INSERT INTO login (username, dob, age, contact, email, password) VALUES (:username, :dob, :age, :contact, :email, :password)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            // Data saved successfully
            echo "Data saved";
            // Set email existence status in Redis
            $redis->setex('emailExists_' . $email, 3600, 1);
        } else {
            // Error in insertion
            echo "Error";
        }
    }
}
?>
