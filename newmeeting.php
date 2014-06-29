<?php
// Init
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');

include($_SERVER['DOCUMENT_ROOT'] . '/MVC/app/core/initialize.php');

// Controller
class Controller extends AppController {
  public function __construct() {
    parent::__construct();
    Payload::js('/MVC/bower_components/moment/min/moment.min.js');
    Payload::js('/MVC/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js');
    Payload::js('/MVC/js/date.js');
    Payload::js('/MVC/js/addparticipants.js');
    Payload::css('eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.css');
    $meeting = Meeting::create(1);//$_SESSION['person_id']);

  }

}

$controller = new Controller();

// Extract Main Controler Vars
extract($controller->view->vars);

?>
<div class="container">
    <button class="btn btn-large col-xs-6 pull-left">Cancel</button>
    <button class="btn btn-large btn-default col-xs-6">Done</button>
</div>

<form role="form" action="createmeeting.php" method="POST">
    <div class="form-group">
        <label for="meeting-title">What:</label>
        <input id="meeting-title" class="form-control" type="text" name="title" placeholder="Meeting Title" required maxlength="100">
    </div>
    <div class="form-group">    
        <label for="meeting-location">Where:</label>
        <input id="meeting-location" class="form-control" type="text" name="location" placeholder="Meeting Location" required maxlength="100">
    </div>
    <label for="date">When:</label>
    <div class="form-group">
        <div class='input-group date' id='datetimepicker1'>
            <input id="date" type='text' class="form-control" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    
</form>
<form id="participants">
    <label for="attendee">Who:</label>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-btn"><button class="btn btn-default empty"><span class="glyphicon glyphicon-minus"></span></button></span>
            <input type="text" id="attendee" class="form-control" name="attendee" placeholder="someone@example.com" required maxlength="100">
            <span class="input-group-btn less"><button class="btn btn-default more"><span class="glyphicon glyphicon-plus"></span></button></span>
        </div>
    </div>
</form>
<div class="well">
    <ul class="participants">
        
        
    </ul>
</div>
   
