<?php
session_start();

if (isset($_SESSION['email'])) {
    // Replace with your database credentials
    $hostname = "sql213.infinityfree.com";
    $username = "if0_35559466";
    $password = "zUyaFaAZhcFe";
    $database = "if0_35559466_guvi";

    try {
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_SESSION['email'];
        $stmt = $conn->prepare("SELECT * FROM `login` WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Return user-specific information as JSON response
             $dob = new DateTime($user['dob']);
            $currentDate = new DateTime();
            $age = $currentDate->diff($dob)->y;

            // Return user-specific information as JSON response with age
           echo json_encode([
                'success' => true,
                 // Add email to the response
                'username' => $user['username'],
                'dob' => $user['dob'],
                'age' => $age,
				'contact' => $user['contact'],
				'email' => $user['email']
				
				
				]);
        } else {
            // User not found or unauthorized access
            echo json_encode(['success' => false]);
        }
    } catch (PDOException $e) {
        // Handle database connection errors here
        echo json_encode(['success' => false, 'message' => 'Database connection error']);
    }
} else {
    // User not logged in or unauthorized access
    echo json_encode(['success' => false]);
}
?>