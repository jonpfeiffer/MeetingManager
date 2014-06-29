<?php
// Init
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');

include($_SERVER['DOCUMENT_ROOT'] . '/MVC/app/core/initialize.php');

// Controller
class Controller extends AppController {
	public function __construct() {
		parent::__construct();

        $sql = "SELECT *
                FROM meeting
                WHERE user_id = 1
                AND datetime_sched > NOW() - INTERVAL 1 DAY";

        $results = db::execute($sql);
        
        // Build a button for each meeting today or in the future
        while($row = $results->fetch_assoc()){
            $date = [];
            $date = preg_split( "/(-| )/", $row['datetime_sched'] );
            $dateout = $date[1] . "/" . $date[2];
            $this->view->meetings .= "<button class='btn btn-default btn-success meeting-button' id='{$row['meeting_id']}'>" . $dateout . "</button>";
        }
	}

}

$controller = new Controller();

// Extract Main Controler Vars
extract($controller->view->vars);

?>
    <button class="btn-primary btn-large meeting-create center-block">New Meeting</button>
    <h3 class="text-center">Your Upcoming Meetings</h3>
    <hr>
    <div class="lower-container container text-center">
        <?php echo $meetings ?>
    </div>
    <footer><button class="btn btn-default btn-lg btn-block">Past Meetings</button></footer>
  