<?php
session_start();
require_once 'conn.php';

// Enable detailed error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if form fields are filled
    if (!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        try {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            
            // Prepare the SQL statement
            $sql = "INSERT INTO users (name, phone, email, password) VALUES (:name, :phone, :email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            
            // Execute the prepared statement
            if ($stmt->execute()) {
                // Set session message
                $_SESSION['message'] = array("text" => "User successfully created.", "alert" => "info");
                
                // Redirect to index.html
                header('Location: ../index.html');
                exit();
            } else {
                throw new Exception("Failed to execute the query.");
            }
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Missing form data
        echo "<script>alert('Please fill up the required fields!');</script>";
        echo "<script>window.location = '../index.html';</script>";
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}
?>
