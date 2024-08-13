<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection details
$hostname = "localhost";
$username = "ditiss";
$password = "toor";
$database = "fitment";

// Create connection using MySQLi
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    // Validate form data
    if (empty($email) || empty($password)) {
        die("Email and password are required.");                   }

    // Prepare and execute a query to retrieve user data
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    if ($stmt === false) {
        die("Failed to prepare statement: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Successful login
            //echo "Login successful. Welcome, " . htmlspecialchars($username) . "!";
           header("Location: interior.html");
            // You might want to start a session and set session variables here
        } else {
            // Invalid password
            echo "Invalid password.";
        }
    } else {
        // User not found
  echo "No user found with that email address.";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
