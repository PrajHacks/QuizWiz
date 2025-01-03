<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
  }

  ul li {
    display: inline-block;
  }

  ul li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
    transition: background-color 0.3s;
  }

  ul li a:hover {
    background-color: #111;
    color: WHITE;
    text-decoration: none;
  }

  #menuBar {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    /* background-color: #333; */
    /* border-radius: 10px; */
  }

  body {
    padding-top: 50px;
  }

  .logout{
    float: right;
    background-color: #565555;
  }

</style>
</head>
<body>
<nav id="menuBar">
  <ul>
    <li><a href="startpage.php">Home</a></li>
    <li><a href="managequizzes.php">Manage Quizzes</a></li>
    <li><a href="about.html">About</a></li>
    <!-- <li><a href="contact.php">Contact</a></li> -->
    <div class="logout">
    <li><a href="logout.php">Logout</a></li></div>
  </ul>
</nav>
</body>
</html>
