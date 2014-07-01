<?php
// Init
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');

include($_SERVER['DOCUMENT_ROOT'] . '/MVC/app/core/initialize.php');

// Controller
class sMainController extends AppController {
	public function __construct() {
		parent::__construct();

        
	}

    public function defaultAction(){

        $sql = "SELECT *
                FROM meeting
                WHERE person_id = 1
                AND datetime_sched > NOW() - INTERVAL 4 HOUR";

        $results = db::execute($sql);


        $meetings = [];
        while($row = $results->fetch_assoc()){

            $meeting = new Meeting();
            $meeting->setId($row['meeting_id']);
            $meeting->setSched($row['datetime_sched']);

            array_push($meetings, $meeting);

            
            //$this->view->meetings .= "<button class='btn btn-default btn-success meeting-button' id='{$row['meeting_id']}'>" . $dateout . "</button>";
        }

        // Prepare ViewData
        $this->view->meetings = $meetings;


       // extract($controller->view->vars);


        include('defaultView.php');

    }

}

$controller = new sMainController();
$controller->defaultAction();

// Extract Main Controler Vars


?>
