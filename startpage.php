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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizWiz Teachers' Console</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="script.js"></script>
    <style>
        .separator{
            border: 3px solid #12a830;
            width: 100;
            /* -webkit-animation: separator-width 1s ease-out forwards; */
            /* animation: separator-width 1s ease-out forwards; */
        }
        /* @keyframes separator-width
        {
            0%{
                width: 0%;
            }
            100%{
                width: 100%;
            }
        } */

        h1 {
            padding: 20px;
            font-size: 4vw;
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
            /* border-radius: 8px; */
            /* background-image: linear-gradient(to left, #b7975b, #b7975b); */
            border: 1px solid #12a830; /* Adding a border with 1px width and color #ddd */
            padding: 30px; /*Adding padding for better spacing*/
            margin-bottom: 20px; /* Adding margin at the bottom to create space between questions */
            border-width: 5px;
            border-radius: 10px;
            /* margin-left: 20px; */
        }

        .form-group {
            padding: 10px; /* Adding padding for better spacing */
            margin-bottom: 20px; /* Adding margin at the bottom to create space between questions */
            border-width: 5px;
            border-radius: 10px;
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

        /* form {
            gap: 10px;
        } */
    </style>
</head>
<body>

    <div class="container mt-5">
        <center>
            <div class="card">
                <h1 class="text-center">Teachers' Console</h1>
                <div class="card-body">
        
                    <form action="addq.php" method="post">
                        <br>
                        <h3>To Add a Quiz</h3>
                        <br>
                        <input style=" width: 95%" type="text" class="form-control" id="qname" name="qname" placeholder="Enter quiz name here" required>
                        <br>
                        <button type="submit">Add Quiz</button>
                    </form>
                    <br>
        
                    <hr class="separator">
                    
                    <br>
                    <form action="managequizzes.php" method="post">
                        <h3>To View and Manage Quizzes</h3><br>
                        <button type="submit">Click Here</button>
                    </form>
                    <!-- <br> -->
                </div>
            </div>
        </center>
    </div>
<br>
</body>
</html>
