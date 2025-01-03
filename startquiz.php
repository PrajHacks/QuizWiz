<?php 
// if($_COOKIE['loginuser'] == "teacher"){
//     include_once 'menu.php';
// }
// elseif($_COOKIE['loginuser'] == "student"){
//     include_once 'menu_student.php';
// }
session_start();
    $test = $_SESSION['test'];
    if($test!="true") {
        header("Location:index.php");
    }
?>
<?php
// session_start();
// $qname = $_SESSION['qname'];
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myquiz";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$qname = $_POST['table_name'];
// Fetch all questions from the database
$_SESSION['qname'] = $qname;


$sql = "SELECT * FROM $qname";
$result = $conn->query($sql);
$questions = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

$conn->close();
// session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizWiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            padding: 0;
            background-color: #F5DEB3; /* Sandy color */
            line-height: 1.5;
        }
    
        .quiz-container {
            min-width: 600px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    
        h1 {
            font-size: 6vw;
            text-align: center;
            background-image: url("images/color.gif");
            background-size: cover;
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }
    
        .question {
            min-width: 520px;
            max-width: 520px;
            border: 1px solid #ddd; /* Adding a border with 1px width and color #ddd */
            padding: 10px; /* Adding padding for better spacing */
            margin-bottom: 20px; /* Adding margin at the bottom to create space between questions */
            border-width: 5px;
            border-radius: 10px;
        }
    
        .form-check {
            display: flex;
            align-items: center;
            border: 1px solid #ddd; /* Adding a border with 1px width and color #ddd */
            padding: 10px; /* Adding padding for better spacing */
            margin-bottom: 20px; /* Adding margin at the bottom to create space between questions */
            border-radius: 100px;
            border-color: black;
        }
    
        .form-check label {
            width: 85%; /* Adjust the width as needed */
            word-wrap: break-word;
        }
    
        input[type="radio"] {
            order: -1; /* Keeps the radio button circle symbol to the leftmost part of the button */
        }
    
        textarea,
        input,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    
        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    
        button:hover {
            background-color: #45a049;
        }
    </style>
    
        <link rel="icon" type="image/png" href="images/logo1.jpg">
</head>
<body>
    <div class="quiz-container">
        <h1>Quiz</h1>
        <form action="calculate_result.php" method="post" id="quiz-form">
            <?php
            if (is_array($questions) && count($questions) > 0) {
                foreach ($questions as $index => $question) {
                    ?>
                    <div class="question">
                        <p><?= $question['question']; ?></p>
                        <div class="form-check">
                            <label class="form-check-label" for="option<?= $index ?>_a"><?= $question['a']; ?></label>
                            <input type="radio" class="form-check-input" id="option<?= $index ?>_a" name="answers[<?= $index ?>]" value="a" required>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="option<?= $index ?>_b"><?= $question['b']; ?></label>
                            <input type="radio" class="form-check-input" id="option<?= $index ?>_b" name="answers[<?= $index ?>]" value="b" required>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="option<?= $index ?>_c"><?= $question['c']; ?></label>
                            <input type="radio" class="form-check-input" id="option<?= $index ?>_c" name="answers[<?= $index ?>]" value="c" required>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="option<?= $index ?>_d"><?= $question['d']; ?></label>
                            <input type="radio" class="form-check-input" id="option<?= $index ?>_d" name="answers[<?= $index ?>]" value="d" required>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No questions found.</p>";
            }
            ?>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
