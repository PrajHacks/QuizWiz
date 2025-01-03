<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizWiz - Result</title>
    <style>
        body {
            line-height: 1.5;
            background-color: #F5DEB3; /* Sandy color */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background-color: #F5DEB3; Replace 'book.jpg' with the path to your image */
            /* background-color: #f4f4f4; Fallback color if the image is unavailable */
            background-size: cover;
            background-position: center;

            
        }

        @keyframes fade {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .result-container {
            background-color: #F5DEB3;
            display: flex;
            flex-direction: column;
            /* justify-content: center; */
            /* padding-top: 20%; */
            align-items: center;
            height: 35vh;
        }

        .result-message {
            /* font-size: 24px; */
            text-align: center;
            opacity: 0;
            transition: opacity 3s;
            font-size: 6vw;
            font-weight: bold;
            /* animation: animate 6s linear infinite; */
        }

        .question {
            min-width: 520px;
            max-width: 520px;
            border: 1px solid #ddd; /* Adding a border with 1px width and color #ddd */
            padding: 10px; /* Adding padding for better spacing */
            margin-bottom: 20px; /* Adding margin at the bottom to create space between questions */
            border-width: 5px;
            border-radius: 10px;
            animation: fade linear both;
            animation-timeline: view();
            animation-range: entry 15% cover 50%;
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

        .form-check {
            display: flex;
            align-items: center;
            border: 1px solid #ddd; /* Adding a border with 1px width and color #ddd */
            padding: 10px; /* Adding padding for better spacing */
            margin-bottom: 20px; /* Adding margin at the bottom to create space between questions */
            border-radius: 100px;
            border-color: black;
        }

        #b1 {
        background-color: #6b4e16;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-bottom: 10px;
        }   

        #b1:hover {
        background-color: #523b0f;
        }   

    </style>
    <script>
        // JavaScript to apply the fade-in effect when the page loads
        window.onload = function() {
            const resultMessage = document.querySelector('.result-message');
            resultMessage.style.opacity = 1;
        }
    </script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" type="image/png" href="images/logo1.jpg">
</head>
<body>
    <div class="result-container">
        <div class="result-message">
            <?php
            session_start();
            $qname = $_SESSION['qname'];
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(!isset($_POST['answers'])){
                    echo "You Should not be here!";
                    exit(1);
                }
                $userAnswers = $_POST['answers'];

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "myquiz";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT ans FROM $qname"; 
                $result = $conn->query($sql);
                $correctAnswers = [];

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $correctAnswers[] = $row['ans'];
                    }
                }

                $totalQuestions = count($correctAnswers);
                $score = 0;

                for ($i = 0; $i < $totalQuestions; $i++) {
                    if (isset($userAnswers[$i]) && $userAnswers[$i] === $correctAnswers[$i]) {
                        $score++;
                    }
                }
                // $user = $_SESSION['username'];
                $user = $_COOKIE['user'];
                $restable = $qname . "_result";

                $sql_get_attempt = "SELECT attempt FROM $restable WHERE name='$user'";
                $result_get_attempt = $conn->query($sql_get_attempt);

                if ($result_get_attempt !== false && $result_get_attempt->num_rows > 0) {
                    // The SQL operation was successful and there is at least one row with a value, accessing the value in the last record retrieved
                    $result_get_attempt->data_seek($result_get_attempt->num_rows - 1);
                    $row = $result_get_attempt->fetch_assoc();
                    $attempt_value = $row['attempt'];
                    $incattempt = strval(intval($attempt_value) + 1);
                    
                } else {
                    // There was an issue with the SQL operation or no rows were returned
                    $incattempt = '1';
                }

                $sql_insert = "INSERT INTO $restable (name, attempt, score, total) VALUES ('$user', '$incattempt', '$score', '$totalQuestions')";

                if ($conn->query($sql_insert) === TRUE) {
                    echo "Quiz Submitted <br>";
                } else {
                    echo "Error: " . $sql_insert . "<br>" . $conn->error;
                }

                echo "Your score: " . $score . " out of " . $totalQuestions;

                $conn->close();
            }
            ?>
        </div>
    </div>
    
    <div class="quiz-container">
    <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myquiz";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$qname = $_SESSION['qname'];
// Fetch all questions from the database
$sql = "SELECT * FROM $qname";
$result = $conn->query($sql);
$questions = [];

if ($result === false) {
    echo "Error fetching data from the database: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row;
        }
    }

    
    if (is_array($questions) && count($questions) > 0) {
        foreach ($questions as $index => $question) {
            ?>
            <div class="question">
            <?= $question['id'].")"; ?>
                <?= $question['question']; ?>
                <br><br>
                <div class="form-check" data-aos="fade-left">a].&nbsp;&nbsp; 
                    <label class="form-check-label" for="option<?= $index ?>_a"><?= $question['a']; ?></label>
                </div>
                <div class="form-check" data-aos="fade-left">b].&nbsp;&nbsp;
                    <label class="form-check-label" for="option<?= $index ?>_b"><?= $question['b']; ?></label>
                </div>
                <div class="form-check" data-aos="fade-left">c].&nbsp;&nbsp;
                    <label class="form-check-label" for="option<?= $index ?>_c"><?= $question['c']; ?></label>
                </div>
                <div class="form-check" data-aos="fade-left">d].&nbsp;&nbsp;
                    <label class="form-check-label" for="option<?= $index ?>_d"><?= $question['d']; ?></label>
                </div>
                <!-- <div class="form-check">
                    Answer - 
                    <label class="form-check-label" for="option<?= $index ?>_d"><?= $question['ans']; ?></label>
                </div> -->
                <div class="form-check" data-aos="fade-left" style="border: 3px solid lightgreen;">
                    Answer -&nbsp;<label class="form-check-label" for="option<?= $index ?>_d"><?= $question['ans']; ?>].&nbsp;</label>
                    <?php
                    switch ($question['ans']) {
                        case 'a':
                            echo $question['a'];
                            break;
                        case 'b':
                            echo $question['b'];
                            break;
                        case 'c':
                            echo $question['c'];
                            break;
                        case 'd':
                            echo $question['d'];
                            break;
                        default:
                            echo '<script>alert("Something\'s wrong, neither of the answers match");</>';
                            break;
                    }
                    
                    ?>
                </div>

            </div>
            <?php
        }
    } else {
        echo "<p>No Answers found.</p>";
    }
}

$conn->close();
?>
</div>
<center><h1>THANK YOU!</h1></center>
<center><a href="viewquiz.php"><button id="b1">Go Back</button></a></center>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>
