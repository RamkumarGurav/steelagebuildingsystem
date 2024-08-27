<?php
class Admin_Common_Model extends CI_Model
{
	public $session_uid = '';
	public $session_name = '';
	public $session_email = '';
	public $session_company_profile_id = '';

	function __construct()
	{
		$this->load->database();

		$this->model_data = array();

		$this->db->query("SET sql_mode = ''");

		$this->session_uid = $this->session->userdata('sess_psts_uid');
		$this->session_name = $this->session->userdata('sess_psts_name');
		$this->session_email = $this->session->userdata('sess_psts_email');
		$this->session_company_profile_id = $this->session->userdata('sess_company_profile_id');


	}



	/**
	 * The get_admin_user_data method retrieves data related to an admin user from the database. It first fetches basic information about the user from the admin_user table, including details like username, email, etc. Then, it fetches additional details such as the user's roles and associated company profile information by joining multiple tables (admin_user_role, users_role_master, and company_profile). Finally, it organizes this data and returns it, including the user's roles and associated company profile information.
	 */
	function get_admin_user_data($params = array())
	{
		$result = ''; // Initialize the result variable

		// Select fields from the admin_user table
		$this->db->select("au.* ");
		$this->db->from("admin_user as au");
		$this->db->where("au.admin_user_id", $this->session_uid); // Filter by session user ID
		$this->db->limit(1); // Limit to 1 result

		// Execute the query
		$query_get_list = $this->db->get();
		$result = $query_get_list->result(); // Get the query result as an array of objects

		// If result is not empty
		if (!empty($result)) {
			// Loop through each result
			foreach ($result as $r) {
				// Select fields from admin_user_role, users_role_master, and company_profile tables
				$this->db->select("aur.* , urm.user_role_name , cp.company_unique_name");
				$this->db->from("admin_user_role as aur");
				$this->db->join("users_role_master as urm", "urm.user_role_id = aur.user_role_id");
				$this->db->join("company_profile as  cp", "cp.company_profile_id = aur.company_profile_id");
				$this->db->where("aur.admin_user_id", $r->admin_user_id); // Filter by admin user ID
				$r->roles = $this->db->get()->result(); // Assign the query result to roles property of each result object
			}

			$result = $result[0]; // Get the first element of the result array

			// Loop through each role
			foreach ($result->roles as $r) {
				// If the session company profile ID matches the role's company profile ID
				if ($this->session_company_profile_id == $r->company_profile_id) {
					// Set user role name and ID
					$result->user_role_name = $r->user_role_name;
					$result->user_role_id = $r->user_role_id;
				}
			}
		}

		return $result; // Return the result
	}


	function get_left_menu($params = array())
	{
		$result = '';
		$this->db->select("mm.* , mp.*");
		$this->db->from("module_master as mm");
		$this->db->join("module_permissions as mp", "mm.module_id = mp.module_id");
		//$this->db->join("users_role_master as urm" , "urm.user_role_id = mp.user_role_id");
		//$this->db->join("admin_user as au" , "mp.user_role_id = au.user_role_id");
		$this->db->join("admin_user_role as au", "mp.user_role_id = au.user_role_id");
		$this->db->where("au.company_profile_id", $this->session_company_profile_id);
		$this->db->where("au.admin_user_id", $this->session_uid);
		$this->db->where("mm.is_display", 1);
		$this->db->where("mm.status", 1);
		$this->db->order_by("mm.position ASC");
		if (!empty($params['module_id'])) {
			$this->db->where("mm.module_id", $params['module_id']);
		}
		if (!empty($params['is_master'])) {
			if ($params['is_master'] == "zero") {
				$this->db->where("mm.is_master", 0);
			} else {
				$this->db->where("mm.is_master", $params['is_master']);
			}
		}

		if (!empty($params['module_id'])) {
			$this->db->where("mm.module_id", $params['module_id']);
		}

		if (!empty($params['parent_module_id'])) {
			$this->db->where("mm.parent_module_id", $params['parent_module_id']);
		}

		$query_get_list = $this->db->get();
		$result = $query_get_list->result();
		if (!empty($result)) {
			foreach ($result as $r) {
				if (!empty($r->direct_db_count) && !empty($r->table_name)) {
					$this->db->select('count(*) as row_count');
					$this->db->from("$r->table_name");
					if (!empty($r->count_function_name)) {
						$this->db->where("$r->count_function_name");
					}
					if ($r->is_company_profile_id == 1) {
						$this->db->where("company_profile_id", $this->session_company_profile_id);
					}
					$row_count_result = $this->db->get()->result();
					$r->data_count = $row_count_result[0]->row_count;
				}
				$r->submenu = $this->get_left_sub_menu(array("is_master" => "zero", "parent_module_id" => $r->module_id));
			}
		}
		//print_r($result);
		return $result;
	}

	function get_left_sub_menu($params = array())
	{
		$result = '';
		$this->db->select("mm.* , mp.*");
		$this->db->from("module_master as mm");
		$this->db->join("module_permissions as mp", "mm.module_id = mp.module_id");
		//$this->db->join("users_role_master as urm" , "urm.user_role_id = mp.user_role_id");
		//$this->db->join("admin_user as au" , "mp.user_role_id = au.user_role_id");
		$this->db->join("admin_user_role as au", "mp.user_role_id = au.user_role_id");
		$this->db->where("au.company_profile_id", $this->session_company_profile_id);
		$this->db->where("au.admin_user_id", $this->session_uid);
		$this->db->where("mm.is_display", 1);
		$this->db->where("mm.status", 1);

		if (!empty($params['is_master'])) {
			if ($params['is_master'] == "zero") {
				$this->db->where("mm.is_master = 0");
			} else {
				$this->db->where("mm.is_master", $params['is_master']);
			}

		}

		if (!empty($params['parent_module_id'])) {
			$this->db->where("mm.parent_module_id", $params['parent_module_id']);
		}

		$query_get_list = $this->db->get();
		$result = $query_get_list->result();
		if (!empty($result)) {
			foreach ($result as $r) {
				if (!empty($r->direct_db_count) && !empty($r->table_name)) {
					$this->db->select('count(*) as row_count');
					$this->db->from("$r->table_name");
					$row_count_result = $this->db->get()->result();
					$r->data_count = $row_count_result[0]->row_count;
				}
			}
		}

		return $result;
	}



	/**
	 * Checks user access rights based on provided parameters.
	 * @param array $params Parameters for checking access.
	 * @return mixed Access result.
	 */
	function check_user_access($params = array())
	{
		$result = ''; // Initialize the result variable.

		// Select fields from the 'module_master' and 'module_permissions' tables.
		$this->db->select("mm.* , mp.*");
		$this->db->from("module_master as mm");
		$this->db->join("module_permissions as mp", "mm.module_id = mp.module_id");
		$this->db->join("users_role_master as urm", "urm.user_role_id = mp.user_role_id");
		$this->db->join("admin_user_role as au", "mp.user_role_id = au.user_role_id");

		// Filter by company profile ID and admin user ID from the session.
		$this->db->where("au.company_profile_id", $this->session_company_profile_id);
		$this->db->where("au.admin_user_id", $this->session_uid);

		// Filter by status of module and user role master.
		$this->db->where("mm.status", 1);
		$this->db->where("urm.status", 1);

		// Additional filtering based on provided parameters.

		if (!empty($params['is_master'])) {
			if ($params['is_master'] == "zero") {
				$this->db->where("mm.is_master", 0);
			} else {
				$this->db->where("mm.is_master", $params['is_master']);
			}
		}

		if (!empty($params['parent_module_id'])) {
			$this->db->where("mm.parent_module_id", $params['parent_module_id']);
		}


		//we get this $params['module_id'] from the functions in  Module controllers 
		//eg country_list() method in controllers/secureRegions/Country_Module 
		if (!empty($params['module_id'])) {
			$this->db->where("mm.module_id", $params['module_id']);
		}

		// Execute the query and get the result.
		$query_get_list = $this->db->get();
		$result = $query_get_list->result();

		// If result is not empty, assign the first result to $result.
		if (!empty($result)) {
			$result = $result[0];
		}




		return $result; // Return the access result.
	}


	function getData($params = array())
	{
		$this->db->select($params['select']);
		$this->db->from($params['from']);
		if (!empty($params['where'])) {
			$this->db->where("($params[where])");
		}

		if (!empty($params['limit'])) {
			$this->db->limit($params['limit']);
		}
		if (!empty($params['order_by'])) {
			$this->db->order_by($params['order_by']);
		}
		$query_get_list = $this->db->get();
		return $query_get_list->result();
	}
}

?>