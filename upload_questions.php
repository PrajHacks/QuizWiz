<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myquiz";

$conn = new mysqli($servername, $username, $password, $dbname);



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if it doesn't exist
// $sql_create_table = "CREATE TABLE IF NOT EXISTS quiz (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     question TEXT NOT NULL,
//     a VARCHAR(255) NOT NULL,
//     b VARCHAR(255) NOT NULL,
//     c VARCHAR(255) NOT NULL,
//     d VARCHAR(255) NOT NULL,
//     ans VARCHAR(1) NOT NULL
// )";

// if ($conn->query($sql_create_table) === TRUE) {
//     // Table created successfully or already exists
// } else {
//     echo "Error creating table: " . $conn->error;
// }

// Get form data
session_start();
$qname = $_SESSION['qname'];

$question = $_POST['question'];
$optionA = $_POST['option1'];
$optionB = $_POST['option2'];
$optionC = $_POST['option3'];
$optionD = $_POST['option4'];
$answer = $_POST['options'];

// Insert data into the database
$sql = "INSERT INTO $qname(question, a, b, c, d, ans) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $question, $optionA, $optionB, $optionC, $optionD, $answer);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    
    // Redirect to the index page and display a success message
    header("Location: addq.php?success=1");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
// session_destroy();

?>
