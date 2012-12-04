<?php // this acts as a home page of the application after the user is authenticated and it also shows the tweets in the jquery slider along with a list of 10 random follower of the authenticated user.
require("twitteroauth/twitteroauth.php"); // including the twitteroauth library
session_start();
set_time_limit(0);


if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){

// TwitterOAuth instance, with two new parameters we got in twitter_login.php
$twitteroauth = new TwitterOAuth('AP0YK30bs4pSnISKZHcfMA', 'NHsgPDkHF9eeA8wvCOk9R8uiiknGYV3Ao3SYZscgk', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

// requesting the access token
$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);

// Save it in a session var
$_SESSION['access_token'] = $access_token;

// getting the user's info
$user_info = $twitteroauth->get('account/verify_credentials');

// fetching tweets of logged in user from user_timeline.json
$tweets = $twitteroauth->get('https://api.twitter.com/1/statuses/user_timeline.json?include_rts=1&count=10&screen_name='.$user_info->screen_name);

// performing json functions and storing it in a variable
$tweets = json_encode($tweets);
$twt = json_decode($tweets);


} else {
    // Something's missing, go back to square 1
    header('location:twitter_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>rtTimelineApp | User Home</title>

	<link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>

    <!-- jquery slider -->
    <script src="js/slides.min.jquery.js"></script>
	<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				play: 2000,
				pause: 1000,
				hoverPause: true
			});
		});
	</script>
</head>

<body>
	<div id="container">
            <div style="position:absolute; right:5%; top:2%;"><a href="logout.php">Logout</a></div> <br><br>
		<div id="example">
                    
                        <!-- jquery slider tweets -->
			<div id="slides">
				<div class="slides_container" style="font-size:25pt">
					<a href="http://www.twitter.com/<?php echo $user_info->screen_name ?>"target="_blank"><h2><div id="twt0"><?php echo $twt[0]->text; ?></div></h2></a>
					<a href="http://www.twitter.com/<?php echo $user_info->screen_name ?>"target="_blank"><h2><div id="twt1"><?php echo $twt[1]->text; ?></div></h2></a>
                                        <a href="http://www.twitter.com/<?php echo $user_info->screen_name ?>"target="_blank"><h2><div id="twt2"><?php echo $twt[2]->text; ?></div></h2></a>
                                        <a href="http://www.twitter.com/<?php echo $user_info->screen_name ?>"target="_blank"><h2><div id="twt3"><?php echo $twt[3]->text; ?></div></h2></a>
                                        <a href="http://www.twitter.com/<?php echo $user_info->screen_name ?>"target="_blank"><h2><div id="twt4"><?php echo $twt[4]->text; ?></div></h2></a>
                                        <a href="http://www.twitter.com/<?php echo $user_info->screen_name ?>"target="_blank"><h2><div id="twt5"><?php echo $twt[5]->text; ?></div></h2></a>
                                        <a href="http://www.twitter.com/<?php echo $user_info->screen_name ?>"target="_blank"><h2><div id="twt6"><?php echo $twt[6]->text; ?></div></h2></a>
                                        <a href="http://www.twitter.com/<?php echo $user_info->screen_name ?>"target="_blank"><h2><div id="twt7"><?php echo $twt[7]->text; ?></div></h2></a>
                                        <a href="http://www.twitter.com/<?php echo $user_info->screen_name ?>"target="_blank"><h2><div id="twt8"><?php echo $twt[8]->text; ?></div></h2></a>
                                        <a href="http://www.twitter.com/<?php echo $user_info->screen_name ?>"target="_blank"><h2><div id="twt9"><?php echo $twt[9]->text; ?></div></h2></a>
				</div>
				<a href="#" class="prev"><img src="img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src="img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
			</div>
                    <br>
                    
			<img src="img/example-frame.png" width="839" height="341" alt="Example Frame" id="frame">
                        <br>
                        
		</div>

            <!-- ---------------------------------------------------------------------------------------------- -->
            <!-- generate pdf form -->
            <?php
            $tweet10 = $twt[0]->text."\n".$twt[1]->text."\n".$twt[2]->text."\n".$twt[3]->text."\n".$twt[4]->text."\n".$twt[5]->text."\n".$twt[6]->text."\n".$twt[7]->text."\n".$twt[8]->text."\n".$twt[9]->text;
           
            ?>
            <form action="pdf/genpdf.php" method="POST">
                <div style="display:none">
                <input type="text" name ="tweets" value="<?php echo $tweet10 ?>"/> </div>
                <input type="submit" value="Generate PDF" target="_blank"/>
            </form>

            <!-- ---------------------------------------------------------------------------------------------- -->
            
		</div>
</body>

<br>
            
<!-- displaying 10 random follower of the authenticated user -->
<?php
$follower_list = $twitteroauth->get('https://api.twitter.com/1/followers/ids.json?cursor=-1&screen_name='.$user_info->screen_name);

$followers = array();
$count = 10;

//traversing through all the followers to fetch username and profile pics of any 10 followers
foreach($follower_list as $key => $value)
{
    if($value != 0000)
    {
    foreach ($value as $key1 => $value1)
        {
            if($count == 0)
                {break;}
        
                $get_url = "https://api.twitter.com/1/users/lookup.json?include_entities=true&user_id=".$value1;
                $follower_info = $twitteroauth->get($get_url);
        

                foreach($follower_info as $key2 => $value2)
                {
                    foreach($value2 as $key3 => $value3)
                    {
                            if($key3 == "screen_name")
                                {
                                    echo "<b>".$value3."</b>";
                                    $followers[] = $value3;
                                }
                            if($key3 == "profile_image_url" )
                                { ?>
                                    <img src="<?php echo $value3; ?>"/>
                      <?php }

                 }
            }
                    $count = $count  - 1; // decrementing counter so as to stop when we get 10 followers
        }
    }
}

$_SESSION['followers'] = $followers; // store the followers list we get in an session variable
?>
            <!-- ---------------------------------------------------------------------------------------------- -->
     <br><br>

     <!-- form to search for a follower  -->
     Search Followers &nbsp;
     <input type="text" name="search" id="search"/>

     </html>

     <!-- jquery ajax for auto-complete and loading tweets of the selected follower and display in the jquery slider -->
<script type="text/javascript">
	$(function() {
         $( "#search" ).autocomplete({
            source:'source.php',
            select: function( event, ui ) {
            $.ajax({
            url: "load_follower_tweets.php",
            async: false,
            type: "GET",
            data: "follower_name="+ui.item.value,
            dataType: "json",

            success: function(result) {
               $("#twt0").html(result[0]);
               $("#twt1").html(result[1]);
               $("#twt2").html(result[2]);
               $("#twt3").html(result[3]);
               $("#twt4").html(result[4]);
               $("#twt5").html(result[5]);
               $("#twt6").html(result[6]);
               $("#twt7").html(result[7]);
               $("#twt8").html(result[8]);
               $("#twt9").html(result[9]);

            }
            });
    
            }
            
        });
    });
</script>
