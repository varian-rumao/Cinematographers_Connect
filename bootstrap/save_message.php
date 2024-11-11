<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $message = $_POST['message'];

    // Database connection details
    $servername = "127.0.0.1"; 
    $username = "root";        
    $password = "";            
    $dbname = "laravel"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use a prepared statement to insert data safely
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, title, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $title, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Message submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
