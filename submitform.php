<?php
// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Validate required fields
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Prepare SQL query to insert the form data into the database
        $sql = "INSERT INTO contact_submissions (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);
        
        // Execute the query
        if ($stmt->execute()) {
            // Success
            header("Location: success.html");
            exit();
        } else {
            // Failure
            echo "An error occurred. Please try again later.";
        }
    } else {
        // Required fields are missing
        echo "Please fill in all required fields.";
    }
}
?>
