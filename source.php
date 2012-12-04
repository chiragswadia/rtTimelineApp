<?php // this acts as a source for auto-suggest feature when user types any letter in the search box
session_start();
$term = trim(strip_tags($_GET['term'])); // removing any special characters (if any)

$followers = array();
$followers = $_SESSION['followers'];

$returnArray = array();

foreach($followers as $value)
{
if(preg_match("/^$term.*$/i", $value)) {
            array_push($returnArray, $value);
}

}
$returnArray = json_encode($returnArray);
print_r($returnArray);


?>
