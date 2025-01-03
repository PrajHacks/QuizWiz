<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "myquiz";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
    // echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
$conn->select_db($database);

$tableName = "users";
$sql = "CREATE TABLE IF NOT EXISTS $tableName (
    id INT(4) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(30) UNIQUE,
    password VARCHAR(30),
    usertype VARCHAR(7)
)";
if ($conn->query($sql) === TRUE) {
    // echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>