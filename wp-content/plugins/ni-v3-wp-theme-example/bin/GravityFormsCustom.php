<?php
class GravityFormsCustom {
	public $formID;
	public $disclaimer;
	
	public function __construct( $formId ) {
		$this->formID = $formId;
	}
	
	public function init() {
	}
	
	public function hide_labels() {
		add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
	}
	
	public function customise_button() {		
		add_filter( 'gform_submit_button', array( $this, 'make_button' ), 10, 2 );
	}
	
	public function make_button( $button, $form ) {
		return "<button class='btn btn-outline-primary disabled' id='gform_submit_button_{$this->formID}' disabled>Keep me informed</button>";
	}
	
	public function add_discalimer( $disclaimer ) {		
		$this->disclaimer = $disclaimer;
		add_filter( 'gform_submit_button_'. $this->formID, array( $this, 'generate_diclaimer' ), 10, 2 );
	}
	
	public function generate_diclaimer( $button, $form ) {
		return $button .= '<p class="mt-5 disclaimer-rb">'. $this->disclaimer .'</p>';
	}
	
	public function set_gtm_tracking() {
		add_action( 'gform_post_submission_'. $this->formID, array( $this, 'gf_gtm_tracking' ), 10, 2);
	}
	
	
	  /**
	  * GTM data layer push for gravity forms contact form
	  */
	 /**
	  * Pushes a submission variables to the GTM dataLayer
	  * Also pushes the event label for use in GTM tracking
	  * @param  Array $form  Form data
	  * @return null
	  */
	public function gf_gtm_tracking( $form ) {
		$eventLabel = 'form_'.$form['id'];
	?>
			<script type="text/javascript">
				 // var eventLabel = $('#event_label').val();
				 window.dataLayer = window.dataLayer || [];
				 window.dataLayer.push({
				   'event' : 'gravityFormSubmit',
				   'eventCategory' : 'Form',
					'eventAction': 'Submit',
					'eventLabel': '<?= $eventLabel; ?>'
				 });
			</script>	
	<?php              
	}
}
?>