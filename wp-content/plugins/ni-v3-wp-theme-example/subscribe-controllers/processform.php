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
<strong>Thank you!</strong>
<ul>
<?php
require_once 'csrest_subscribers.php';

function changelists($thelist, $listid){
	
	$auth = array('api_key' => 'b633c230b48756436987413836a0c56d');

	//if all are set need to check the subscribed all box
	if(isset($_POST['next-mining-boom'], $_POST['next-oil-rush'], $_POST['next-small-cap'], $_POST['next-tech-stock'], $_POST['next-biotech'])){
		$subscriberdetails = array(
			'EmailAddress' => $_POST["newemail"],
			'Name' => $_POST["name"],
			'Resubscribe' => true,
			'RestartSubscriptionBasedAutoresponders' => true,
			'CustomFields' => array(
				array(
					'Key' => 'SubscribedAll',
					'Value' => 'Yes'
				)
			)
		);
	} else {
		$subscriberdetails = array(
			'EmailAddress' => $_POST["newemail"],
			'Name' => $_POST["name"],
			'Resubscribe' => true,
			'RestartSubscriptionBasedAutoresponders' => true,
			'CustomFields' => array(
				array(
					'Key' => 'SubscribedAll',
					'Value' => ''
				)
			)
		);
	}
	
	$unsubscriberdetails = array(
		'EmailAddress' => $_POST["newemail"],
		'Name' => $_POST["name"],
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
	if(isset($_POST[$thelist])){
		//if they exist in this list update them
		$result = $wrap->get($_POST["email"]);
		if($result->was_successful()) {
			$result = $wrap->update($_POST["email"], $subscriberdetails);
		} else {  // if they are not in the list subscribe them
			$result = $wrap->add($subscriberdetails);
		}
		//Same message for both as they have either been added or are staying on the list with updated details.
		echo "<li>Your preferences have been saved for The " .$thelistclean." list.</li>";
		
	} else {
		//if they exist in this list unsubscribe them
		$result = $wrap->get($_POST["email"]);
		if($result->was_successful()) {
			$result = $wrap->unsubscribe($_POST["email"]);
			if($result->was_successful()) {
				echo "<li>You have been unsubscribed from The " .$thelistclean." list.</li>";
			} else {
				echo '<li>Your preferences remain unchanged for The '.$thelistclean.' list: '.$result->response->Message.'</li>';
			}
			//then update them
			$result = $wrap->get($_POST["email"]);
			if($result->was_successful()) {
				$result = $wrap->update($_POST["email"], $unsubscriberdetails);
			}
		} else {
			echo '<li>Your preferences remain unchanged for The '.$thelistclean.' list: '.$result->response->Message.'</li>';
		}
		
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
Need to make further changes? <a href="/email-preferences/?email=<?php echo $_POST["newemail"]; ?>">Go back to the form</a>
</div>
</div>
<!-- end wrapper -->
</body>
</html>