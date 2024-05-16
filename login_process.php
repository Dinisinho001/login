<?php
session_start(); // Start PHP session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection code
    include 'db_connection.php';

    // Get username/email and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials
    $sql = "SELECT * FROM utilizador WHERE (username = ? OR email = ?) AND pass = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, set session variables
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        // Redirect to dashboard or home page
        header("Location: index_admin.php");
        exit();
    } else {
        // Invalid credentials, redirect back to login page
        header("Location: login.php?error=1");
        exit();
    }
} else {
    // Redirect back to login page if accessed without form submission
    header("Location: login.php");
    exit();
}
?>
