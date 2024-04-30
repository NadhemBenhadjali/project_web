<?php
require_once "initialize_database.php"; // Include database configuration

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and perform basic validation
    $fullName = isset($_POST['fullName']) ? $_POST['fullName'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Basic validation (you should add more as needed)
    if (empty($fullName) || empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit;
    }
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Save to database
    try {
        // Connect to the database
        $conn = new PDO("mysql:host=localhost;dbname=dream_home_reality", "your_username", "your_password");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Hash password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute SQL statement
        $stmt = $conn->prepare("INSERT INTO users (full_name, username, email, password) VALUES (:full_name, :username, :email, :password)");
        $stmt->bindParam(':full_name', $fullName);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHash); // Saving hashed password
        $stmt->execute();

        echo "Registration successful!";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
