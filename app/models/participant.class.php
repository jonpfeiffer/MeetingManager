<?php

/**
 * Participant
 */
class Participant extends Model {

  /**
   * Save Participant
   */
  public static function save($person, $meeting) {

    // Note that Server Side validation is not being done here

 
        // Prepare SQL Values
        $sql_values = [
          'meeting_id' => $meeting,
          'person_id' => $person
        ];

        // Ensure values are encompased with quote marks
        $sql_values = db::array_in_quotes($sql_values);

        // Insert
        $results = db::insert('meeting_participant', $sql_values);
        
        // Get Recent Insert ID
        $meeting_participant_id = $results->insert_id;

        // Return a new instance of this user as an object
        return new Participant($meeting_participant_id);
        }    

  }

    public function update($input) {

        // Note that Server Side validation is not being done here
        // and should be implemented by you


        // Prepare SQL Values
        $sql_values = [
            'speaking_duration' => $input['speaking_duration'];
            'is_active' => $input['is_active'];
        ];

        // Ensure values are encompased with quote marks
        $sql_values = db::array_in_quotes($sql_values);

        // Insert
        $results = db::insert('meeting_participant', $sql_values, "WHERE meeting_participant_id = {$this->meeting_participant_id}");

        // Return a new instance of this participant as an object
        return new Participant($this->meeting_participant_id);

    }

}