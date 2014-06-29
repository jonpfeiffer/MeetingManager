<?php

/**
 * Person
 */
class Person extends Model {

	/**
	 * Save Person
	 */
	public static function save($input) {

		// Note that Server Side validation is not being done here


		// Prepare SQL Values
		$sql_values = [
			'person_id' => $input['person_id'],
			'first_name' => $input['first_name'],
			'last_name' => $input['last_name'],
			'email' => $input['email'],
			'password' => $input['password'],
			'registered' => 0
		];

		// Ensure values are encompased with quote marks
		$sql_values = db::array_in_quotes($sql_values);

		// Insert
		$results = db::insert('person', $sql_values);
		
		// Get Recent Insert ID
		$person_id = $results->insert_id;

		// Return a new instance of this user as an object
		return new Person($person_id);

	}

}