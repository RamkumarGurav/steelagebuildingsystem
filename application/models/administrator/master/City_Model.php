<?php
class City_Model extends CI_Model
{
	public $session_uid = '';
	public $session_name = '';
	public $session_email = '';

	function __construct()
	{
		$this->load->database();
		$this->model_data = array();
		$this->db->query("SET sql_mode = ''");
		$this->session_uid = $this->session->userdata('sess_psts_uid');
		$this->session_name = $this->session->userdata('sess_psts_name');
		$this->session_email = $this->session->userdata('sess_psts_email');

	}


	/**
	 * getting cities with search ,pagination  and sorting using params ,if your using this method to find single city data with its city_id then it will be present int the 0th index of the resultant array
	 */
	function get_city($params = array())
	{
		$result = '';

		// Check if the 'search_for' parameter is present in the $params array
		if (!empty($params['search_for'])) {
			// If 'search_for' is set, only select the count of cities
			$this->db->select("count(urm.city_id) as counts");
		} else {
			// Otherwise, select detailed information about the city including state and country details
			$this->db->select("urm.*, s.state_name, c.country_name, c.country_short_name, c.dial_code");
			// Select the name of the user who added the city
			$this->db->select("(select au.name from admin_user as au where au.admin_user_id = urm.added_by) as added_by_name");
			// Select the name of the user who updated the city
			$this->db->select("(select au.name from admin_user as au where au.admin_user_id = urm.updated_by) as updated_by_name");
		}

		// From the city table (aliased as urm)
		$this->db->from("city as urm");
		// Join with the country table on the country_id
		$this->db->join("country as c", "c.country_id = urm.country_id");
		// Join with the state table on the state_id
		$this->db->join("state as s", "s.state_id = urm.state_id");
		// Order the results by city_id in descending order
		$this->db->order_by("city_id desc");

		// If 'city_id' is set in the $params array, filter results by city_id
		if (!empty($params['city_id'])) {
			$this->db->where("urm.city_id", $params['city_id']);
		}
		// If 'country_id' is set in the $params array, filter results by country_id
		if (!empty($params['country_id'])) {
			$this->db->where("urm.country_id", $params['country_id']);
		}
		// If 'state_id' is set in the $params array, filter results by state_id
		if (!empty($params['state_id'])) {
			$this->db->where("urm.state_id", $params['state_id']);
		}

		// If 'start_date' is set in the $params array, filter results to include only cities added on or after the start date
		if (!empty($params['start_date'])) {
			$temp_date = date('Y-m-d', strtotime($params['start_date']));
			$this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		// If 'end_date' is set in the $params array, filter results to include only cities added on or before the end date
		if (!empty($params['end_date'])) {
			$temp_date = date('Y-m-d', strtotime($params['end_date']));
			$this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		// If 'record_status' is set in the $params array, filter results by status
		if (!empty($params['record_status'])) {
			if ($params['record_status'] == 'zero') {
				// If record_status is 'zero', filter by status = 0
				$this->db->where("urm.status = 0");
			} else {
				// Otherwise, filter by city_id equal to record_status
				$this->db->where("urm.city_id", $params['record_status']);
			}
		}

		// If both 'field_value' and 'field_name' are set in the $params array, filter results where the field contains the value
		if (!empty($params['field_value']) && !empty($params['field_name'])) {
			$this->db->where("$params[field_name] like ('%$params[field_value]%')");
		}

		// If 'limit' and 'offset' are set in the $params array, limit the number of results and set the offset
		if (!empty($params['limit']) && !empty($params['offset'])) {
			$this->db->limit($params['limit'], $params['offset']);
		}
		// If only 'limit' is set, just limit the number of results
		else if (!empty($params['limit'])) {
			$this->db->limit($params['limit']);
		}

		// Execute the query and get the results
		$query_get_list = $this->db->get();
		// Store the results in the $result variable
		$result = $query_get_list->result();

		// Return the result
		return $result;
	}
}

?>