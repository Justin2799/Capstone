<?php
session_start();
include_once 'includes/functions.inc.php';
?>

<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="js/contrast.js"></script>
<div id="btn"><a href="javascript:void(0)" class="btn">Change Contrast</a>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="js/font.js"></script>
<div id="font-size-toggle" aria-hidden="true">
  <div class="font-size-toggle__label-wrap"><a href="javascript:void(0)" class="font-size-toggle__label">Change Font Size</a></div>
  <div class="font-size-toggle__control-panel"><a href="javascript:void(0)" class="font-size-toggle__increase"><i class="fas fa-arrow-up"></i></a>
    <div class="font-size-toggle__scale"><span class="font-size-toggle__value">100</span>%</div>
    <a href="javascript:void(0)" class="font-size-toggle__decrease"><i class="fas fa-arrow-down"></i></a></div>
</div>
<div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title>Simple Scheduling</title>
<link rel="stylesheet" href="css/style1.css">
</head>

<nav>
  <div class="wrapper">
	  
    <ul>
      <?php
      if ( isset( $_SESSION[ "useruid" ] ) ) {
        echo "<li><a href='logout.php'>Logout</a></li>";
        echo "<li><a href='3a-calendar.php'>My Calendar</a></li>";
      } else {
        echo "<li><a href='signup.php'>Sign up</a></li>";
        echo "<li><a href='login.php'>Log in</a></li>";
      }
      ?>
    </ul>
  </div>
</nav>
</div>

