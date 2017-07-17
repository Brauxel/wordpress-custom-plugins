<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="robots" content="noindex,nofollow">
<title>Next Investors Subscriber Preference Centre</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="wrapper"> <img src="images/ni-logo.png" width="400" height="98" alt="" class="nilogo"/>
  <?php 

require_once 'csrest_subscribers.php';

$auth = array('api_key' => 'b633c230b48756436987413836a0c56d');

if(isset($_GET["email"])){
	
	$email = $_GET["email"];
	
	//Replace a space with a plus as the plus gets stripped out.
	$email = str_replace(" ", "+", $email);

	//Next Mining Boom
	$wrap = new CS_REST_Subscribers('75b792ccb079760a88aef2260fb398ce', $auth);
	$resultmining = $wrap->get($email);
	
	//Next Oil Rush
	$wrap = new CS_REST_Subscribers('3ae5127c1decbac8dec6b960623d5951', $auth);
	$resultoil = $wrap->get($email);
	
	//Next Small Cap
	$wrap = new CS_REST_Subscribers('bde71c4faabdceacb49dc9cc55e91907', $auth);
	$resultsmall = $wrap->get($email);
	
	//Next Tech Stock
	$wrap = new CS_REST_Subscribers('0425a44ed99284d3ab89d3dd97b81821', $auth);
	$resulttech = $wrap->get($email);
	
	//Next Biotech
	$wrap = new CS_REST_Subscribers('1e9dfc9ed2764b5a2275c4d1dfaabb0f', $auth);
	$resultbio = $wrap->get($email);

	//VIP Club
	$wrap = new CS_REST_Subscribers('71832425ac074c376412e1e39acbdac3', $auth);
	$resultvip = $wrap->get($email);
	
	 
	
	
	if($resultmining->was_successful() || $resultoil->was_successful() || $resultsmall->was_successful() || $resulttech->was_successful() || $resultbio->was_successful() || $resultvip->was_successful()) {
		
		
		

		
	$dates = array();
	
	//Chech the state and the dates for each list and add the dates to an array otherwise define empty variables.
	
	if($resultmining->was_successful()){
		$statemining = $resultmining->response->State;
		$datemining = $resultmining->response->Date;
		array_push($dates, $datemining);
	} else {
		$statemining = '';
		$datemining = '';
	}
		
	if($resultoil->was_successful()){
		$stateoil = $resultoil->response->State;
		$dateoil = $resultoil->response->Date;
		array_push($dates, $dateoil);
	} else {
		$stateoil = '';
		$dateoil = '';
	}
	
	if($resultsmall->was_successful()){
		$statesmall = $resultsmall->response->State;
		$datesmall = $resultsmall->response->Date;
		array_push($dates, $datesmall);
	} else {
		$statesmall = '';
		$datesmall = '';
	}
	
	if($resulttech->was_successful()){
		$statetech = $resulttech->response->State;
		$datetech = $resulttech->response->Date;
		array_push($dates, $datetech);
	} else {
		$statetech = '';
		$datetech = '';
	}
	
	if($resultbio->was_successful()){
		$statebio = $resultbio->response->State;
		$datebio = $resultbio->response->Date;
		array_push($dates, $datebio);
	} else {
		$statebio = '';
		$datebio = '';
	}

	if($resultvip->was_successful()){
		$statevip = $resultvip->response->State;
		$datevip = $resultvip->response->Date;
		array_push($dates, $datevip);
	} else {
		$statevip = '';
		$datevip = '';
	}
	
	//Find the most recent subscription / entry.
	$latestentry = max($dates);
	
	//Define results for the most recent entry.
	if($datemining == $latestentry){
		$result = $resultmining;
	} else if($dateoil == $latestentry){
		$result = $resultoil;
	} else if($datesmall == $latestentry){
		$result = $resultsmall;
	} else if($datetech == $latestentry){
		$result = $resulttech;
	} else if($datebio == $latestentry){
		$result = $resultbio;
	} else if($datevip == $latestentry){
		$result = $resultvip;
	}
	
		 ?>
  <p class="lessgap">Hi <?php echo $result->response->Name; ?>,</p>
  <p>Please use the form below to update your preferences for which emails you would like to receive from the Next Investors Group.</p>
  <div class="whitepanel">
    <div class="logos"> <img src="images/NI-logos.png" width="245" height="344" alt=""/> </div>
    <form id="subform" method="post" action="processform.php">
      <fieldset>
        <p>
          <label>Name:</label>
          <input name="name" type="text" value="<?php echo $result->response->Name; ?>"/>
        </p>
        <p>
          <input type="hidden" name="email" value="<?php echo $result->response->EmailAddress; ?>" />
        </p>
        <p>
          <label>Email:</label>
          <input name="newemail" type="text"  onfocus="if (this.value == 'Email') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Email';}" value="<?php echo $result->response->EmailAddress; ?>"  class="required email" />
        </p>
        <p class="lessgap">
          <label>Which emails would you like to receive:</label>
        </p>
        <p class="lessgap">
          <input type="checkbox" name="next-mining-boom" value="mining" <?php if($statemining == "Active"){ echo "checked";} ?>>
          The Next Mining Boom</p>
        <p class="lessgap">
          <input type="checkbox" name="next-oil-rush" value="oil" <?php if($stateoil == "Active"){ echo "checked";} ?>>
          The Next Oil Rush</p>
        <p class="lessgap">
          <input type="checkbox" name="next-small-cap" value="small" <?php if($statesmall == "Active"){ echo "checked";} ?>>
          The Next Small Cap</p>
        <p class="lessgap">
          <input type="checkbox" name="next-tech-stock" value="tech" <?php if($statetech == "Active"){ echo "checked";} ?>>
          The Next Tech Stock</p>
        <p class="lessgap">
          <input type="checkbox" name="next-biotech" value="bio" <?php if($statebio == "Active"){ echo "checked";} ?>>
          The Next Biotech</p>
        <p class="lessgap">
          <input type="checkbox" name="vip-club" value="bio" <?php if($statevip == "Active"){ echo "checked";} ?>>
          Yes! I qualify as a sophisticated investor under s708 of the Corporations Act and want to join the VIP Club. More information below. </p>
          <input class="sub_submit" type="submit" value="Save preferences"/>
        
      </fieldset>
    </form>
  </div>
  <p style="font-size: 10pt;">The Next Investors VIP Club will give you free access to opportunities not normally available to general retail investors – however you must qualify as a <a href="http://www.nextinvestors.com/vip-club/" target="_blank">sophisticated investor under Section 708 of the Corporations Act.</a></p>
<p  style="font-size: 10pt;">These opportunities are as diverse as stock placements, seed capital raisings, IPOs, options underwritings. Plus a whole host of other high risk, high reward investment opportunities not available to the general public (careful – this stuff is high risk!).</p>
<hr/>
  <p>Please use the button below if you wish to unsubscribe from all Next Investors communications.</p>
  <div class="clear"></div>
  <form id="unsubform" method="post" action="processunsubscribe.php">
  		<input type="hidden" name="email" value="<?php echo $result->response->EmailAddress; ?>" />
  		<input class="sub_submit" type="submit" value="Unsubscribe all"/>
  </form>
  <?php
	} else {
		//echo 'Failed with code '.$result->http_status_code."\n<br />";
		echo '<p>Sorry the email address '.$email.' was not found in any of the Next Investors Lists.</p>';
	}
} else {
	echo "<p>Sorry you have come here by mistake.</p>";
}

?>
</div>
<!-- end wrapper -->
</body>
</html>
