<?php
// this page is for fetching 10 latest tweets from the follower`s timeline when user selects it from the search folower textbox.
$tweets = file_get_contents('https://api.twitter.com/1/statuses/user_timeline.json?include_rts=1&count=10&screen_name='.$_GET['follower_name']);

$follower_tweets = array();

$tweets = json_decode($tweets);


$follower_tweets[] = $tweets[0]->text;
$follower_tweets[] = $tweets[1]->text;
$follower_tweets[] = $tweets[2]->text;
$follower_tweets[] = $tweets[3]->text;
$follower_tweets[] = $tweets[4]->text;
$follower_tweets[] = $tweets[5]->text;
$follower_tweets[] = $tweets[6]->text;
$follower_tweets[] = $tweets[7]->text;
$follower_tweets[] = $tweets[8]->text;
$follower_tweets[] = $tweets[9]->text;

echo json_encode($follower_tweets);
?>
