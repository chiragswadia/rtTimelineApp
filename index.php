<?php
session_start();

if(isset($_SESSION['user_info']))
{
    header("location:twitter_oauth.php");
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>rtTimelineApp | Login with Twitter</title>

        <link rel="stylesheet" href="css/global.css">
        
        </head>

    <body>
        <div id="container" style="font-size:25pt;">
            <h2>rtTimelineApp</h2>
            <hr>
            <br><br>
            <a href="twitter_login.php"><img src="images/twitter-connect-button.png" alt="Login with Twitter"/></a>
            <br><br>
            <div id="footer" style="font-size:10pt;">
                <hr>
                Developed by Chirag Swadia for rtCamp Assignment. All rights reserved &copy; 2012 
            </div>

            
        </div>
    </body>

</html>
