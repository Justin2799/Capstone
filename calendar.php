<?php
  session_start();
  include_once 'includes/functions.inc.php';
?>

<!DOCTYPE html>

 <html class="no-js"> 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>calendar</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="calendar.css">
    </head>
    <body>
		<h1>My Schedule</h1>
        <div class="calendar" id="calendar">
            <div class="calendar-btn month-btn" onclick="$('#months').toggle('fast')">
                <span id="curMonth"></span>
                <div id="months" class="months dropdown"></div>
            </div>
        
            <div class="calendar-btn year-btn" onclick="$('#years').toggle('fast')">
                <span id="curYear"></span>
                <div id="years" class="years dropdown"></div>
            </div>
        
            <div class="clear"></div>
        
            <div class="calendar-dates">
                <div class="days">
                    <div class="day label">SUN</div>
                    <div class="day label">MON</div>
                    <div class="day label">TUE</div>
                    <div class="day label">WED</div>
                    <div class="day label">THUR</div>
                    <div class="day label">FRI</div>
                    <div class="day label">SAT</div>
        
                    <div class="clear"></div>
                </div>
        
                <div id="calendarDays" class="days">
                </div>
            </div>
        </div>
          <form>
 			<button formaction="login.php">Logout</button></form>
        <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
        <script src="calendar.js" async defer></script>
    </body>
</html>
            