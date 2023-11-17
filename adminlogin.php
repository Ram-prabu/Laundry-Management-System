<?php
session_start();

// Hard-coded admin credentials
$adminUsername = "admin";
$adminPassword = "admin";

if (isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];

    if ($usernameemail == $adminUsername && $password == $adminPassword) {
        $_SESSION["login"] = true;
        $_SESSION["id"] = 1; // You can set any user ID here
        header("Location: admindashboard.php");
        exit(); // Terminate the script after redirecting
    } else {
        echo "<script> alert('Wrong Username or Password'); </script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>
    body {
      background-image: url('https://static.vecteezy.com/system/resources/previews/001/984/880/original/abstract-colorful-geometric-overlapping-background-and-texture-free-vector.jpg');
      background-size: cover;
    
      font-family: Arial, sans-serif;
      background-color: #F9F9F9;
    }
   

    form {
      border: 3px solid #f1f1f1;
      background-color: #ffffff;
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
    }
    h2 {
      text-align: center;
      margin-top: 0;
    }
    input[type=text], input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    button {
      background-color: purple;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }
    button:hover {
      opacity: 0.8;
    }
    .registerbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }
    .container {
      padding: 16px;
    }
    span.psw {
      float: right;
      padding-top: 16px;
    }
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }

  

    @media screen and (max-width: 300px) {
      span.psw {
        display: block;
        float: none;
      }
      .registerbtn {
        width: 100%;
      }
    }
  </style>
  </head>
  <body>
    <h2>Admin Login</h2>
    <form class="" action="" method="post" autocomplete="off">
      <label for="usernameemail">Email : </label>
      <input type="text" name="usernameemail" id = "usernameemail" required value=""> <br>
      <label for="password">Password : </label>
      <input type="password" name="password" id = "password" required value=""> <br>
      <button type="submit" name="submit">Login</button>
      <br>


      <div style="display: flex; justify-content: space-between; align-items: center;">
</div>


  </form>
  </body>
</html>

