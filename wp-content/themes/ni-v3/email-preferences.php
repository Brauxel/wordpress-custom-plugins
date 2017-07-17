<?php
/*
Template Name: Email Preferences
*/

get_header(); ?>
    		
<?php
$auth = array('api_key' => 'b633c230b48756436987413836a0c56d');

if( isset($_GET["email"]) ) {
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
	
	if( $resultmining->was_successful() || $resultoil->was_successful() || $resultsmall->was_successful() || $resulttech->was_successful() || $resultbio->was_successful() || $resultvip->was_successful() ) {
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

    		<div class="container">
    			<div class="row">
    				<div class="col-sm-12 mx-auto pt-5">
    					<div class="holder">
							<a href="#"><img class="img-fluid mb-5" src="<?php bloginfo('template_url'); ?>/assets/images/ni-black.svg" alt="Next Investors" title="Next Investors" width="220" /></a>
							<p>Hello <?php echo $result->response->Name; ?></p>
							<p>Please use the form below to update your preferences for which emails you would like to receive from the Next Investors Group.</p>
						</div>
    				</div>
    				
    				<div class="col-sm-12">
    					<div class="dark get-updates pl-5 pr-5 mt-3">
    						<div class="gform_wrapper">
    							<form id="subform" method="post" action="<?php bloginfo('template_url') ?>/subscribe-controllers/processform.php">
    								<div class="gform_body">
    									<ul class="gform_fields">
											<li class="gfield">
												<input name="name" value="<?php echo $result->response->Name; ?>" placeholder="Full name" type="text" required>
											</li>
											
											<li class="gfield">
												<input type="hidden" name="email" value="<?php echo $result->response->EmailAddress; ?>" />
												<input name="newemail" type="text"  onfocus="if (this.value == 'Email') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Email';}" value="<?php echo $result->response->EmailAddress; ?>" required />
											</li>
											
											<li class="gfield options">
												<label class="gfield_label">Which emails would you like to receive:<span>*</span></label>
												
												<div class="ginput_container ginput_container_checkbox">
													<ul class="gfield_checkbox">
														<li>
															<input id="next-mining-boom" type="checkbox" name="next-mining-boom" value="mining" <?php if($statemining == "Active"){ echo "checked";} ?>>
															
															<label for="next-mining-boom">
																<img class="img-fluid mr-5" src="<?php bloginfo( 'template_url' );  ?>/assets/images/nmb.svg" alt="Next Mining Boom" title="Next Mining Boom" width="250">
															</label>
														</li>
														
														<li>
															<input id="next-oil-rush" type="checkbox" name="next-oil-rush" value="oil" <?php if($stateoil == "Active"){ echo "checked";} ?>>
															
															<label for="next-oil-rush">
																<img class="img-fluid mr-5" src="<?php bloginfo( 'template_url' );  ?>/assets/images/nor.svg" alt="Next Oil Rush" title="Next Oil Rush" width="185">
															</label>
														</li>

														<li>
															<input id="next-small-cap" type="checkbox" name="next-small-cap" value="small" <?php if($statesmall == "Active"){ echo "checked";} ?>>
															
															<label for="next-small-cap">
																<img class="img-fluid mr-5" src="<?php bloginfo( 'template_url' );  ?>/assets/images/nts.svg" alt="Next Tech Stock" title="Next Tech Stock" width="250">
															</label>
														</li>

														<li>
															<input id="next-tech-stock" type="checkbox" name="next-tech-stock" value="tech" <?php if($statetech == "Active"){ echo "checked";} ?>>
															
															<label for="next-tech-stock">
																<img class="img-fluid mr-5" src="<?php bloginfo( 'template_url' );  ?>/assets/images/nsc.svg" alt="Next Small Cap" title="Next Small Cap" width="250">
															</label>
														</li>
														
														<li>
															<input id="next-biotech" type="checkbox" name="next-biotech" value="bio" <?php if($statebio == "Active"){ echo "checked";} ?>>
															
															<label for="next-biotech">
																<img class="img-fluid mr-5" src="<?php bloginfo( 'template_url' );  ?>/assets/images/nbt.svg" alt="Next Biotech" title="Next Biotech" width="190">
															</label>
														</li>
														
														<li class="rb-logo">
															<label>
																<img class="img-fluid mr-5" src="<?php bloginfo( 'template_url' );  ?>/assets/images/raisebook-black.svg" alt="Raisebook" title="Raisebook" width="250">
															</label>
														</li>
														
														<li id="rb-block">
															<input id="vip-club" type="checkbox" name="vip-club" value="bio" <?php if($statevip == "Active"){ echo "checked";} ?>>
															<label for="vip-club">I qualify as a sophisticated investor under s708 of the Corporations Act and want to join Raisebook. More information below.</label>
														</li>
													</ul>
												</div>
											</li>
										</ul>
									</div>
									
									<div class="gform_footer">
										<button class="btn btn-outline-primary pl-5 pr-5">Save Preferences</button>
										<p class="mt-5 disclaimer-rb">Joining Raisebook will give you free access to opportunities not normally available to general retail investors – however you must qualify as a sophisticated investor under Section 708 of the Corporations Act. These opportunities are as diverse as stock placements, seed capital raisings, IPOs, options underwritings. Plus a whole host of other high risk, high reward investment opportunities not available to the general public (careful – this stuff is high risk!).</p>
									</div>
								</form>
							</div>
						</div>
					</div>
   			
   					<div class="col-sm-12 mx-auto pt-5">
   						<div class="holder">
							<p>Please use the button below if you wish to unsubscribe from all Next Investors communications.</p>

							<form id="unsubform" method="post" action="processunsubscribe.php">
								<input type="hidden" name="email" value="<?php echo $result->response->EmailAddress; ?>">
								<button type="submit" class="btn">Unsubscribe all</button>
							</form>
   						</div>
					</div>
    			</div>
			</div>
			
	<?php 
	} else {
	?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 mb-5 mt-5">
					<p>Sorry the email address <?= $email; ?> was not found in any of the Next Investors Lists.</p>
				</div>
			</div>
		</div>
<?php	
	}
} else {
?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 mb-5 mt-5">
					<p>Sorry, it seems you've taken a wrong turn somewhere. Please click <a href="<?php bloginfo('url'); ?>">here</a> to go home</p>
				</div>
			</div>
		</div>
<?php } ?>	


<?php get_footer(); ?>