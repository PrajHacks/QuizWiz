<?php

include("connection.php");


if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userType = $_POST["userType"];
    

    try {
        // Your database connection code here
    
        // Your SQL query execution code here
        $sql = "INSERT INTO users (username, password, usertype) VALUES ('$username', '$password', '$userType');";
        // $query = "INSERT INTO users (username, password, email) VALUES ('vedant', 'password123', 'vedant@example.com')";
        // $result = $conn->query($sql);

        // Check if the query was successful
        // if ($result) {
        //     echo "User registered successfully!";
        // } else {
        //     echo "Failed to register";
        // }

        if ($conn->query($sql) === TRUE) {
            echo "<script>";
            echo "var confirmed = confirm('User registered successfully! Proceeding to login...');";
            echo "if (confirmed) {";
            echo "window.location.href = 'signin.php';}";
            echo "</script>";
        } else {
            echo " <script> window.location.href = 'signup.php'; alert('Registration failed'); </script>";

        }
    
    } catch (mysqli_sql_exception $e) {
        echo "<script>";
        echo "var confirmed = confirm('Username already taken, create user with a unique username. Going back to registration page...');";
        echo "if (confirmed) {";
        echo "window.location.href = 'index.php';}";
        echo "</script>";
    }
}



?>