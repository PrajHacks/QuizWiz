<?php 
if($_COOKIE['loginuser'] == "teacher"){
    include_once 'menu.php';
}
elseif($_COOKIE['loginuser'] == "student"){
    include_once 'menu_student.php';
}
session_start();
    $test = $_SESSION['test'];
    if($test!="true") {
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
<link rel="icon" type="image/png" href="images/logo1.jpg">
<title>QuizWiz - All Quizzes</title>
    <style>
        .separator{
            border: 3px solid #12a830;
            width: 0;
            /* -webkit-animation: separator-width 1s ease-out forwards; */
            animation: separator-width 1s ease-out forwards;
        }
        @keyframes separator-width
        {
            0%{
                width: 0%;
            }
            100%{
                width: 100%;
            }
        }
        body {
            
            font-family: Arial, sans-serif;
            margin: 10px;
            padding: 0;
            background-color: #F5DEB3; /* Sandy color */
            /* margin-bottom: 100px; */
        }

        .quiz-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 600px;
            margin: 80px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .quiz-container h2 {
            margin-bottom: 20px;
        }

        .quiz-button {
            margin-bottom: 10px;
        }

        button {
            min-width: 300px;
            display: block;
            width: 100%;
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.7vw;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php
    // Assuming you have established a connection to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myquiz";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch all table names from the database
    $sql = "SHOW TABLES";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<div class='quiz-container'>";
        echo "<h2>List of Quizzes</h2><hr class='separator'><br> ";
        while ($row = $result->fetch_row()) {
            foreach ($row as $value) {
                for ($i = 0; $i < strlen($value); $i++) {
                    if ($value[$i] == '_') {
                        break 2;
                    }
                    // Execute any other actions if needed here
                }
                if($value == "users"){
                    continue;
                }
                echo "<form action='startquiz.php' method='post'>";
                echo "<button class='quiz-button' type='submit' name='table_name' value='$value'>$value</button>";
                echo "</form>";
            }
        }
        echo "</div>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
</body>

</html>
