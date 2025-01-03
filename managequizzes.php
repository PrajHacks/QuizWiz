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
<title>QuizWiz - View and Manage Quizzes</title>
    <style>
        .separator{
            border: 2px solid #000000;
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
        }

        .quiz-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 700px;
            min-width: 700px;
            margin: 50px auto;
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

        #b3{
            color: #971a1a;
            background-color: #fff;
            border:3px solid #971a1a;
        }

        #b3:hover{
            color: #fff;
            background-color: #971a1a;
        }

        #b2{
            color: #fff;
            background-color: #4facde;
            /* border:3px solid #4facde; */
            padding: auto;
        }

        #b2:hover{
            color: #fff;
            background-color: #1f9add;
        }

        .edit{
            /* align-items: center; */
            display: inline-flex;
        }

        .name{
            align-content: left;
        }
    </style>
      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
        echo "<h1>All Quizzes</h1><hr class='separator'><br> ";
        while ($row = $result->fetch_row()) {
            foreach ($row as $value) {
                for ($i = 0; $i < strlen($value); $i++) {
                    if ($value[$i] == '_') {
                        break 2;
                    }
                }
                if($value == "users"){
                    continue;
                }
                echo"<div class='name'><h2>";
                echo $value;
                echo"</h2></div>";
                ?>
                
                <form action='startquiz_teacher.php' method='post' data-aos="fade-left">
                <button id="b1" class='quiz-button' type='submit' name='table_name' value='<?= $value; ?>'>View Quiz</button>
                </form>
                <!-- <div class="edit"> -->
                <form action="seeresults.php" method='post' data-aos="fade-left">
                    <button id="b2" class='quiz-button' type='submit' name='table_name' value='<?= $value; ?>'>View Results for <?= $value; ?></button>
                </form>
                <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                <form action="deletequiz.php" method='post' data-aos="fade-left">
                    <button id="b3"  class='quiz-button' type='submit' name='table_name' value='<?= $value; ?>'>Delete <?= $value; ?></button>
                </form>
                <!-- </div> -->
                <br>
                <hr class='separator'>
                <br><br>
                <?php
                // $deleteButton = "<button class='quiz-button' onclick=' deleteQuiz(\"$value\"); ' name='table_name' value='$value;'>Delete $value</button>";
                // echo "$deleteButton";
                // $deleteButton = "<button class='quiz-button' onclick=' deleteQuiz(\"$value\"); ' name='table_name' value='$value;'>Delete $value</button>";
                
            }
        }
        echo "</div>";
    } else {
        echo "0 results";
    }
    
    function deleteQuiz($quizName) {
        global $conn; // Assuming $conn is your database connection

        $quizTable = $quizName . "_result";
        $quizQuestionsTable = $quizName;

        // Dropping both result and questions tables
        $sqlDropResultTable = "DROP TABLE IF EXISTS $quizTable";
        $sqlDropQuestionsTable = "DROP TABLE IF EXISTS $quizQuestionsTable";

        // Execute the queries
        $resultDropResultTable = $conn->query($sqlDropResultTable);
        $resultDropQuestionsTable = $conn->query($sqlDropQuestionsTable);

        if ($resultDropResultTable && $resultDropQuestionsTable) { 
            ?>
            <script>alert("Quiz Deleted")</script>
            <?php
            header("Location: " . $_SERVER['REQUEST_URI']);
        } else {
            echo "Error deleting quiz: " . $conn->error;
        }
    }

    $conn->close();
    ?>
      <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>
