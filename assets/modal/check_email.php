<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    
    // Replace these credentials with your database connection details
   
        $requestData = json_decode(file_get_contents('php://input'), true);
        $email = $requestData['email'];

        // Prepare and execute a SQL query to check if the email exists
        $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM student_acc WHERE email = '$email'");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the result as JSON
        header('Content-Type: application/json');

        if ($result['count'] > 0) {
            echo json_encode(['emailExists' => true]);
        } else {
            echo json_encode(['emailExists' => false]);
        }

}
?>
<!-- <?php
if($_SERVER["REQUEST_METHOD"] == "POST")if(isset($_POST["email"])){
    
    include_once "../../database/conn.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST["email"];
      
     $query = "SELECT email FROM student_acc WHERE email = ?";
     $stmt = $conn->prepare($query);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $result = $stmt->get_result();
     
     if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         $existing_email = $row['email'];
         
         if ($existing_email != $email) {
            echo json_encode(['emailExists' => true]);
        } else {
            echo json_encode(['emailExists' => false]);
        }
     }
    }
?> -->
