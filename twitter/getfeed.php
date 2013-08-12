<?php

session_start();
require_once("twitteroauth.php");

if(isset($_POST["id"])) $formId = $_POST["id"];
if(isset($_POST["posts"])) $formPosts = $_POST["posts"];
           
if(isset($formId)) 	$twitteruser = $formId;	 
else $twitteruser = "html5";
if(isset($formPosts)) 	$notweets = $formPosts;	 
else $notweets = 100;

$consumerkey = "dLXDJ78sjI9fcnYlmJKHyw";
$consumersecret = "o2NGgtfdQQ5UlUH8joGLwz1zH6mozQZfJQ8cetY6lA0";
$accesstoken = "1661147275-G3dwZVVU5Bm01v4SAu3RfKIHxnyp6Q9EM9tfOmj";
$accesstokensecret = "zPCbsGyN5nz6UvP4WlYBOY4SpSEND7GTr0lxj6zSJNk";
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
$thetweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);

//echo json_encode($thetweets); echo "<br><br>";

$encodedTweets = json_encode($thetweets);
$tweets = array();
$tweetDates = array();
$profileImages = array();
$count = 0;
$json = json_decode($encodedTweets, true);

foreach ($json as $key => $val) {

	/*if(isset($val['retweeted_status'])) echo "image: " . $val['retweeted_status']['user']['profile_image_url'];
	else echo "image: " . $val['user']['profile_image_url'];
	echo '<br>';*/
		
	if(isset($val['retweeted_status'])) $profileImages[$count] = $val['retweeted_status']['user']['profile_image_url'];
	else $profileImages[$count] = $val['user']['profile_image_url'];
	
	$date = substr($val['created_at'], 0, 16);
	$text = $val['text'];
	$tweetDates[$count] = $date;
	$tweets[$count] = $text;	
	$count += 1; 
}

echo '<br>';
echo 'Dates: ' . '<br>';
var_dump($tweetDates);
echo '<br>';
echo 'Tweets: ' . '<br>';
var_dump($tweets);
echo '<br>';


?>

