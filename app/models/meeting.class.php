<?php 

class Meeting extends Model {

  
  /**
   * Create Meeting
   */
  public static function create($id) {
    $sql_values = [
        person_id => $id
    ];

    $sql_values = db::array_in_quotes($sql_values);

    // Update
    $results = db::insert('meeting', $sql_values);
    
    // Get Recent Insert ID
    $meeting_id = $results->insert_id;

    // Return a new instance of this meeting as an object
    return new Meeting($meeting_id);
    
  }

  /**
   * Save Meeting
   */
  public static function save($input) {

    // Note that Server Side validation is not being done here


    // Prepare SQL Values DOUBLE CHECK AGAINST FORM
    $sql_values = [
      'title' => $input['title'],
      'location' => $input['location'],
      'datetime_sched' => $input['scheduled']
    ];

    // Ensure values are encompased with quote marks
    $sql_values = db::array_in_quotes($sql_values);

    //Update 
    $results = db::update('meeting', $sql_values, "WHERE meeting_id = {$meeting_id}");


  }
}