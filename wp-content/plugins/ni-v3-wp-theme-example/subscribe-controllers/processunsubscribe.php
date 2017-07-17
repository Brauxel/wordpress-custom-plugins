<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="robots" content="noindex,nofollow">
<title>Next Investors Subscriber Preference Centre</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="wrapper">
<img src="images/ni-logo.png" width="400" height="98" alt="" class="nilogo"/>
<div class="whitepanel morepad">
<strong>We're sorry to see you go!</strong>
<ul>
<?php
require_once 'csrest_subscribers.php';

function changelists($thelist, $listid){
	
	$auth = array('api_key' => 'b633c230b48756436987413836a0c56d');
	
	$unsubscriberdetails = array(
		'EmailAddress' => $_POST["email"],
		'Resubscribe' => false,
		'CustomFields' => array(
				array(
					'Key' => 'SubscribedAll',
					'Value' => ''
				)
			)
	);
	
	$thelistclean = ucwords(str_replace('-', ' ', $thelist));
	
	$wrap = new CS_REST_Subscribers($listid, $auth);

	//if they exist in this list unsubscribe them
	$result = $wrap->unsubscribe($_POST["email"]);
	if($result->was_successful()) {
		echo "<li>You have been unsubscribed from The " .$thelistclean." list.</li>";
	}
	//then update them
	$result = $wrap->get($_POST["email"]);
	if($result->was_successful()) {
		$result = $wrap->update($_POST["email"], $unsubscriberdetails);
	}
}

//MINING BOOM
changelists('next-mining-boom', '75b792ccb079760a88aef2260fb398ce');

//OIL RUSH
changelists('next-oil-rush', '3ae5127c1decbac8dec6b960623d5951');

//SMALL CAP
changelists('next-small-cap', 'bde71c4faabdceacb49dc9cc55e91907');

//TECH STOCKS
changelists('next-tech-stock', '0425a44ed99284d3ab89d3dd97b81821');

//BIOTECH
changelists('next-biotech', '1e9dfc9ed2764b5a2275c4d1dfaabb0f');

//VIP Club
changelists('vip-club', '71832425ac074c376412e1e39acbdac3');

?>
</ul>
<br />
Oops! Didn't mean to unsubscribe from all lists? <a href="/email-preferences/?email=<?php echo $_POST["email"]; ?>">Go back to edit your preferences</a>
</div>
</div>
<!-- end wrapper -->
</body>
</html>