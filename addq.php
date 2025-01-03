<?php include_once 'menu.php';

session_start();
    $test = $_SESSION['test'];
    if($test!="true") {
        header("Location:index.php");
    }
?>
<?php
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script>alert("Question uploaded successfully.");</script>';
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myquiz";

$conn = new mysqli($servername, $username, $password, $dbname);

// Get form data
if(isset($_POST['qname'])) {
    $qname = $_POST['qname'];

    // Create the SQL query with a placeholder for the table name
    $sql_create_table = "CREATE TABLE IF NOT EXISTS $qname (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        question TEXT NOT NULL,
        a VARCHAR(255) NOT NULL,
        b VARCHAR(255) NOT NULL,
        c VARCHAR(255) NOT NULL,
        d VARCHAR(255) NOT NULL,
        ans VARCHAR(1) NOT NULL
    )";


if ($conn->query($sql_create_table) === TRUE) {
    // Table created successfully or already exists
} else {
    echo "Error creating table: " . $conn->error;
}
// session_start();
$_SESSION['qname'] = $qname;

$restable = $qname . "_result";
$_SESSION['result'] = $restable;

$sql_create_table1 = "CREATE TABLE IF NOT EXISTS $restable (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name TEXT NOT NULL,
        attempt VARCHAR(255) NOT NULL,
        score VARCHAR(255) NOT NULL,
        total VARCHAR(255) NOT NULL
    )";

if ($conn->query($sql_create_table1) === TRUE) {
    // Table created successfully or already exists
} else {
    // echo "Error creating table: " . $conn->error;
}

$_SESSION['qname'] = $qname;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="images/logo1.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizWiz - Teachers' Console</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="script.js"></script>
    <style>
        h1 {
            font-size: 6vw;
            text-align: center;
            background-image: url("images/color.gif");
            background-size: cover;
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        body {
            background-color: #F5DEB3;
        }

        .card{
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-body{
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            padding: 10px; /* Adding padding for better spacing */
            margin-bottom: 20px; /* Adding margin at the bottom to create space between questions */
            border-width: 5px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Add Questions</h1>

                <form action="upload_questions.php" method="post" id="question-form">
                    <div class="form-group">
                        <label for="question">Question:</label>
                        <textarea class="form-control" id="question" name="question" rows="3" placeholder="Enter the question here" tabindex="1" required></textarea>
                    </div>

                    <div class="form-group">
                        <input type="radio" id="option1" name="options" value="a" required>  <label for="option1">Option 1:</label>
                        <input type="text" class="form-control" id="option1" name="option1" placeholder="Enter the first option" tabindex="2" required>
                    </div>

                    <div class="form-group">
                        <input type="radio" id="option2" name="options" value="b">  <label for="option2">Option 2:</label>
                        <input type="text" class="form-control" id="option2" name="option2" placeholder="Enter the second option" tabindex="3" required>
                    </div>

                    <div class="form-group">
                        <input type="radio" id="option3" name="options" value="c">  <label for="option3">Option 3:</label>
                        <input type="text" class="form-control" id="option3" name="option3" placeholder="Enter the third option" tabindex="4" required>
                    </div>

                    <div class="form-group">
                        <input type="radio" id="option4" name="options" value="d">  <label for="option4">Option 4:</label>
                        <input type="text" class="form-control" id="option4" name="option4" placeholder="Enter the fourth option" tabindex="5" required>
                    </div>

                    <!-- <div class="form-group">
                        <label for="difficulty">Difficulty:</label>
                        <select class="form-control" id="difficulty" name="difficulty" tabindex="6" required>
                            <option value="" disabled selected>Select Difficulty</option>
                            <option value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                        </select>
                    </div> -->
                    

                    <center><button type="submit" class="btn btn-success">Upload Question</button></center>
                </form>
                <form action="startpage.php" method="post">
                <button>Save and Exit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
    <!-- <a href="startquiz.php" class="btn btn-primary">Start Quiz</a> -->
</div>
<br>
</body>
</html>
