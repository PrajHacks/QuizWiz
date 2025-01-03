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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizWiz - View Results</title>
    <!-- Include your CSS stylesheets here -->
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="images/logo1.jpg">
    <style>
      body{
        background-color: #F5DEB3;
      }
         .card{
            padding: 40px;
            max-width: 700px;
            margin: 100px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            align-items: center;
        }

        .card-body{
            width: 90%;
            background-color: #fff;
            border: 1px solid #12a830; 
            padding: 30px; 
            margin-bottom: 20px; 
            border-width: 5px;
            border-radius: 10px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
<div class="card">
    <div class="quiz-container">
     <div class="card-body">

        <h1>Quiz Results</h1>
        <?php
        // Include your connection.php file
        include("connection.php");

        // session_start();

        // Assuming you have already selected a quiz name (replace 'your_quiz_name' with the actual quiz name)
        $qname = $_POST['table_name'];

        // Fetch all results for the selected quiz
        $result_table_name = $qname . "_result";
        $sql_results = "SELECT * FROM $result_table_name";
        $result_results = $conn->query($sql_results);

        if ($result_results->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Score</th><th>Total Questions</th><th>Attempt number</th></tr>";

            while ($row_result = $result_results->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_result['id'] . "</td>";
                echo "<td>" . $row_result['name'] . "</td>";
                echo "<td>" . $row_result['score'] . "</td>";
                echo "<td>" . $row_result['total'] . "</td>";
                echo "<td>" . $row_result['attempt'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No results found for this quiz.</p>";
        }

        $conn->close();
        ?> 
     </div>
    </div>
</div>
   
</body>

</html>
