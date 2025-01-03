<?php
session_start();
$_SESSION['test'] = 'false';
include("connection.php");


if(isset($_POST["submit1"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    // $_SESSION['username'] = $username;
    $user = "user";
    $cookie_value = $username;
    setcookie($user, $cookie_value);

    $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count >= 1){
        if($row['usertype']=="student"){
            $value = $row['usertype'];
            $cookieName = 'loginuser';
            setcookie($cookieName, $value);

            $_SESSION['test'] = 'true';
            header("Location:viewquiz.php");
        } else if($row['usertype']=="teacher"){
            $value = $row['usertype'];
            $cookieName = 'loginuser';
            setcookie($cookieName, $value);

            $_SESSION['test'] = 'true';
            header("Location:startpage.php");
        }
        echo "Success";
    }
    else{
        echo " <script> window.location.href = 'signin.php'; alert('Login failed'); </script>";
    }
}

?>