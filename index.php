<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" type="image/png" href="images/logo1.jpg">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuizWiz - Registration</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles1.css">
  <!-- Custom CSS -->
</head>

<body>
  <div class="container">
    <center><h2>Sign-Up</h2></center>
    <form action="register.php" method="POST">

      <div class="form-group">
        <label for="userType">Select User Type:</label>
        <select class="form-control" id="userType" name="userType" required>
          <option value="student">Student</option>
          <option value="teacher">Teacher</option>
        </select>
      </div>

      <div class="form-group">
        <label for="email">Create Username</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Type a username" required>
      </div>

      <div class="form-group">
        <label for="password">Create a strong password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Type a password" required>
      </div>

      <div class="form-group">
        <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Sign-Up</button>
      </div>
      
      <center><p class="small-text">By continuing, you agree to QuizWiz's <a href="https://www.termsandconditionsgenerator.com/live.php?token=O16COJr7zrdVhymOrewgwx2NqNuyfYYM">Conditions of Use</a> and <a href="about.html">for any queries visit</a>.</p></center>
      <hr>
      <p class="small-text create-account-link">Already have an account? <a href="signin.php">Go back to sign-in</a></p>

    </form>
  </div>
</body>

</html>
