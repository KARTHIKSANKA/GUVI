<?php
session_start();

// Replace these with your database credentials
$hostname = "sql213.infinityfree.com";
$username = "if0_35559466";
$password = "zUyaFaAZhcFe";
$database = "if0_35559466_guvi";

try {
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $stmt = $conn->prepare("SELECT * FROM `login` WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Passwords match, login successful
            $_SESSION['email'] = $email;

            // Store session data in Redis
            require "predis/autoload.php";
            Predis\Autoloader::register();
            $redis = new Predis\Client();

            // Set session data in Redis with expiration time (e.g., 1 hour)
            $redis->setex('session:' . session_id(), 3600, json_encode($_SESSION));

            echo json_encode(['success' => true]);
        } else {
            // Invalid username or password
            echo json_encode(['success' => false, 'message' => '<span style="color: red;">Invalid email or password</span>']);
        }
    } else {
        // Username or password not provided
        echo json_encode(['success' => false, 'message' => 'Please provide email and password']);
    }
} catch (PDOException $e) {
    // Handle database connection errors here
    echo json_encode(['success' => false, 'message' => 'Database connection error']);
}
?>
