<?php
include_once 'header.php';
?>
<!DOCTYPE html>
<section class="signup-form">
  <h2>Sign Up</h2>
  <div class="signup-form-form">
    <form action="includes/signup.inc.php" method="post">
      <input type="text" name="name" placeholder="Full name...">
      <input type="text" name="email" placeholder="Email...">
      <input type="text" name="uid" placeholder="Username...">
      <input type="password" name="pwd" placeholder="Password...">
      <input type="password" name="pwdrepeat" placeholder="Repeat password...">
		<div class="elem-group">
      <label for="captcha">Please Enter the Captcha Text</label>
      <img src='captcha.php' alt="CAPTCHA" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i> 
	  <br>
      <input type="text" id="captcha" name="captcha_challenge" pattern="[A-Z]{6}">
		</div>
      <script>var refreshButton = document.querySelector(".refresh-captcha");
		refreshButton.onclick = function() {document.querySelector(".captcha-image").src = 'captcha.php?' +Date.now();
		}</script>
      <button type="submit" name="submit">Sign up</button>
		  <a href="reset-password.php">Forgot your password?</a>
    </form>
  </div>

  <?php

  if ( isset( $_POST[ 'captcha_challenge' ] ) && $_POST[ 'captcha_challenge' ] == $_SESSION[ 'captcha_text' ] ) {
    if ( isset( $_GET[ "error" ] ) ) {
      if ( $_GET[ "error" ] == "emptyinput" ) {
        echo "<p>Fill in all fields!</p>";
      } else if ( $_GET[ "error" ] == "invaliduid" ) {
        echo "<p>Choose a proper username!</p>";
      } else if ( $_GET[ "error" ] == "invalidemail" ) {
        echo "<p>Choose a proper email!</p>";
      } else if ( $_GET[ "error" ] == "passwordsdontmatch" ) {
        echo "<p>Passwords doesn't match!</p>";
      } else if ( $_GET[ "error" ] == "stmtfailed" ) {
        echo "<p>Something went wrong!</p>";
      } else if ( $_GET[ "error" ] == "usernametaken" ) {
        echo "<p>Username already taken!</p>";
      } else if ( $_GET[ "error" ] == "none" ) {
        echo "<p>You have signed up!</p>";
      }
    }
  }
  ?>
</section>
