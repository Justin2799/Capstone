<?php
  session_start();
  include_once 'includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Simple Scheduling</title>
    <link rel="stylesheet" href="css/style1.css">
  </head>
  <body>

  
    <nav>
      <div class="wrapper">
        <a href="home.php"></a>
        <ul>
          <li><a href="home.php">Home</a></li>
          <?php
            if (isset($_SESSION["useruid"])) {
              echo "<li><a href='profile.php'>Profile Page</a></li>";
              echo "<li><a href='logout.php'>Logout</a></li>";
            }
            else {
              echo "<li><a href='signup.php'>Sign up</a></li>";
              echo "<li><a href='login.php'>Log in</a></li>";
            }
          ?>
        </ul>
      </div>
    </nav>


<div class="wrapper">
