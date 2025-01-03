<?php

include("connection.php")

?>


<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" type="image/png" href="images/logo1.jpg">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuizWiz - Login</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles1.css">
  <!-- Custom CSS -->
</head>

<body>
  <div class="container">
    <center><h2>Sign-In</h2></center>
    <form action="login.php" method="POST">
      <div class="form-group">
        <label for="email">Username</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
      </div>
      <div class="form-group">
        <button type="submit" name="submit1" id="submit1" class="btn btn-primary btn-block">Sign-In</button>
      </div>
      <center><p class="small-text">By continuing, you agree to QuizWiz's <a href="https://www.termsandconditionsgenerator.com/live.php?token=O16COJr7zrdVhymOrewgwx2NqNuyfYYM">Conditions of Use</a> and <a href="about.html">for any queries visit</a>.</p></center>

      <hr>
      <p class="small-text create-account-link">New to QuizWiz? <a href="index.php">Create your QuizWiz account</a></p>
    </form>
  </div>
</body>

</html>