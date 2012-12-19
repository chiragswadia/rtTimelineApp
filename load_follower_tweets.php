<?php
// this page is for fetching 10 latest tweets from the follower`s timeline when user selects it from the search folower textbox.
$tweets = file_get_contents('https://api.twitter.com/1/statuses/user_timeline.json?include_rts=1&count=10&screen_name='.$_GET['follower_name']);

$follower_tweets = array();
$tweets_permalink = array();


$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($tweets, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $val) {

    if (!is_array($val)) {

    if($key == "profile_image_url" && !isset($profile_image))
    {
        $profile_image = $val;
        

    }
    if($key == "id_str" && strlen($val) >= 10)
    {
        $tweets_permalink[] = $val;
    }

    }

}

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
$follower_tweets[] = $_GET['follower_name'];

$follower_tweets[] = $profile_image;

foreach($tweets_permalink as $c)
{
    $follower_tweets[] = $c;
}
echo json_encode($follower_tweets);
?>
