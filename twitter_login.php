<?php
require("twitteroauth/twitteroauth.php"); //include the twitteroauth library
session_start();
set_time_limit(0);

// The TwitterOAuth instance
$twitteroauth = new TwitterOAuth('AP0YK30bs4pSnISKZHcfMA', 'NHsgPDkHF9eeA8wvCOk9R8uiiknGYV3Ao3SYZscgk');

// Requesting authentication tokens, the parameter is the URL we will be redirected to
$request_token = $twitteroauth->getRequestToken('http://localhost.com/rtTimeLineApp/twitter_oauth.php');

// Saving them into the session
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];


if($twitteroauth->http_code==200){
    // generate the URL and redirect
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
    header('Location: '. $url);
} else {
    
    die('Something wrong happened.');
}  
?>
