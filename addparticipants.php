<?php 
  class Controller extends AjaxController {
  public function __construct() {
    parent::__construct();

    // Save Person
    $person = Person::save($_POST);
    //Ordering Nested Call? how to resolve need to add to both tables
    $join = MeetingParticipant::save($_POST);
    // Putting content in the output without using the view such as this
    // will cause an error with the AjaxController
    //echo 'unexpected';

    // In the case of the Ajax Controller, the view is an array
    // which can can be accessed as follows. This array will be
    // converted to JSON when this script ends
    $this->view['response'] = 'User ' . $person->email . ' was successfully created';

  }

}
$controller = new Controller();
 ?>