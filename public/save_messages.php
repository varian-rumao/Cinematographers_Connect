<?php

// Database connection settings
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "laravel";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $title = htmlspecialchars($_POST['title']);
    $message = htmlspecialchars($_POST['message']);

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, title, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $title, $message);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Message saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
