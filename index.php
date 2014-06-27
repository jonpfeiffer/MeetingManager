<?php
// Init
include($_SERVER['DOCUMENT_ROOT'] . '/MVC/app/core/initialize.php');

// Controller
class Controller extends AppController {
	public function __construct() {
		parent::__construct();

		// Create welcome variable in view
		$this->view->welcome = 'Welcome to MVC';

	}

}
$controller = new Controller();

// Extract Main Controler Vars
extract($controller->view->vars);

?>
    <body>
      <button class="btn-primary btn-large meeting-create center-block">New Meeting</button>
      <div class="lower-container container row well lg-well text-center">
          <div class="btn btn-default btn-success meeting-button">4/15</div>
          <div class="btn btn-default btn-success meeting-button">6/2</div>
          <div class="btn btn-default btn-success meeting-button">6/4</div>
          <div class="btn btn-default btn-success meeting-button">7/22</div>
          <div class="btn btn-default btn-success meeting-button">7/22</div>
          <div class="btn btn-default btn-success meeting-button">7/22</div>
          <div class="btn btn-default btn-success meeting-button">7/22</div>
          <div class="btn btn-default btn-success meeting-button">7/22</div>
          <div class="btn btn-default btn-success meeting-button">7/22</div>
      </div>
      <footer><button class="btn btn-default btn-lg btn-block">...More</button></footer>
  