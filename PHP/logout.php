<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    // Destroy the session
    session_destroy();
    echo json_encode(['success' => true]);
} else {
	
    echo json_encode(['success' => false]);
	
}


?>