<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once ("Main.php");
class Wam extends Main
{

	function __construct()
	{
		parent::__construct();

		//db
		$this->load->database();

		//libraries
		$this->load->library('session');
		$this->load->library('User_auth');


		//helpers
		$this->load->helper('url');

		//models
		$this->load->model('Common_Model');
		$this->load->model('administrator/Admin_Common_Model');
		$this->load->model('administrator/Admin_model');
		$this->load->model('administrator/catalog/Project_Model');

		//storing session data in ci data var
		$session_uid = $this->data['session_uid'] = $this->session->userdata('sess_psts_uid');
		$this->data['session_name'] = $this->session->userdata('sess_psts_name');
		$this->data['session_email'] = $this->session->userdata('sess_psts_email');
		$this->data['sess_fiscal_year_id'] = $this->session->userdata('sess_fiscal_year_id');
		$this->data['sess_company_profile_id'] = $this->session->userdata('sess_company_profile_id');

		// getting user data from User_auth
		$this->data['User_auth_obj'] = new User_auth();
		$this->data['user_data'] = $this->data['User_auth_obj']->check_user_status();

	}



	/****************************************************************
	 *HELPERS
	 ****************************************************************/

	function unset_only()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
	}

	/****************************************************************
	 ****************************************************************/



	/**
	 * LOADS DASHBOARD
	 */
	function index()
	{




		if (empty($this->data['session_uid']) && empty($this->data['session_name']) && empty($this->data['session_email'])) {
			// Redirect to the main admin page(default dashboard) if the user is already logged in and the screen is not locked
			REDIRECT(MAINSITE_Admin . "login");
		}



		$this->data['is_module_id_25'] = 0;
		$this->data['is_module_id_25_data'] = '';
		$this->data['is_module_id_22'] = 0;
		$this->data['is_module_id_22_data'] = '';
		$this->data['is_module_id_21'] = 0;
		$this->data['is_module_id_21_data'] = '';
		$this->data['is_module_id_26'] = 0;
		$this->data['is_module_id_26_data'] = '';
		$this->data['is_module_id_27'] = 0;
		$this->data['is_module_id_27_data'] = '';
		$this->data['is_module_id_39'] = 0;
		$this->data['is_module_id_39_data'] = '';
		$this->data['is_module_id_38'] = 0;
		$this->data['is_module_id_38_data'] = '';


		$search['project_variant'] = 1;
		$search['search_for'] = "count";
		$data_count = $this->Project_Model->get_project($search);
		$ongoing_project_count = $this->data['ongoing_project_count'] = $data_count[0]->counts;

		$search['project_variant'] = 2;
		$search['search_for'] = "count";
		$data_count = $this->Project_Model->get_project($search);
		$completed_project_count = $this->data['completed_project_count'] = $data_count[0]->counts;

		parent::get_header();

		parent::get_left_nav();

		$this->load->view('admin/dashboard', $this->data);
		parent::get_footer();
	}

	function dashboard()
	{
		parent::get_header();
		parent::get_left_nav();
		$this->load->view('welcome_message');
		parent::get_footer();
	}


	// ADMIN lOGOUT METHOD
	function logout()
	{
		// Call the unset_only method to clear specific session data (details of this method are not provided)
		$this->unset_only();
		$alert_message = '<div class="alert alert-success alert-dismissible"><div type="button" class="close" data-dismiss="alert" aria-hidden="true">×</div><i class="icon fas fa-check"></i> You Are Successfully Logout. </div>';
		// Set a flash data message indicating successful logout, INSED "secureRegions/Login.php"'s index() method we set this to 	$this->data['alert_message'] 
		$this->session->set_flashdata('alert_message', $alert_message);

		// Unset the session data for 'sess_psts_uid' to remove the user ID from the session
		$this->session->unset_userdata('sess_psts_uid');

		// Redirect to the login page
		REDIRECT(MAINSITE_Admin . 'login');
	}


	/**
	 * Loads the admin profile,
	 */
	function view_profile()
	{
		$this->load->model('administrator/Employee_Model');

		$this->data['tab_type'] = 'profile';

		if (!empty($_POST['update_password_button'])) {
			$this->data['tab_type'] = $_POST['tab_type'];
			$old_password = $_POST['old_password'];
			$new_password = $_POST['new_password'];
			$re_new_password = $_POST['re_new_password'];

			if ($new_password === $re_new_password) {
				if ($this->data['user_data']->password == md5($old_password)) {
					$enter_data['updated_on'] = date("Y-m-d H:i:s");
					$enter_data['updated_by'] = $this->data['session_uid'];
					$enter_data['show_password'] = $new_password;
					$enter_data['password'] = md5($new_password);
					$insertStatus = $this->Common_Model->update_operation(array('table' => 'admin_user', 'data' => $enter_data, 'condition' => "admin_user_id = " . $this->data['session_uid']));
					if (!empty($insertStatus)) {
						$alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Pasword Updated Successfully </div>';
						$this->session->set_flashdata('alert_message', $alert_message);
						REDIRECT(MAINSITE_Admin . "wam/view-profile");
					} else {
						$this->data['profile_alert_massage'] = '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<i class="icon fas fa-check"></i> Something Went Wrong Please Try Again.
						</div>';
					}
				} else {
					$this->data['profile_alert_massage'] = '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-check"></i> You Entered Wrong Password.
					</div>';
				}
			} else {
				$this->data['profile_alert_massage'] = '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<i class="icon fas fa-check"></i> Password And Re Enter Password Doesnot Match.
				</div>';

			}

		}

		if (!empty($_POST['update_username_button'])) {
			$this->data['tab_type'] = $_POST['tab_type'];
			$password = $_POST['password'];
			$username = $_POST['user_name'];

			if ($this->data['user_data']->password == md5($password)) {
				$is_exist = $this->Common_Model->getData(array('select' => '*', 'from' => 'admin_user', 'where' => "username = '$username' and admin_user_id != " . $this->data['session_uid']));

				if (empty($is_exist)) {
					$enter_data['updated_on'] = date("Y-m-d H:i:s");
					$enter_data['updated_by'] = $this->data['session_uid'];
					$enter_data['username'] = $username;
					$insertStatus = $this->Common_Model->update_operation(array('table' => 'admin_user', 'data' => $enter_data, 'condition' => "admin_user_id = " . $this->data['session_uid']));
					if (!empty($insertStatus)) {
						$alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> User Name Updated Successfully </div>';
						$this->session->set_flashdata('alert_message', $alert_message);
						REDIRECT(MAINSITE_Admin . "wam/view-profile");
					} else {
						$this->data['profile_alert_massage'] = '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<i class="icon fas fa-check"></i> Something Went Wrong Please Try Again.
						</div>';
					}
				} else {
					$this->data['profile_alert_massage'] = '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-check"></i> Username You Entered Is Not Available, Please Try Again.
					</div>';
				}

			} else {
				$this->data['profile_alert_massage'] = '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<i class="icon fas fa-check"></i> You Entered Wrong Password.
				</div>';
			}

		}

		$this->data['employee_data'] = $this->Employee_Model->get_employee(array("admin_user_id" => $this->data['session_uid'], 'details' => 1));
		$this->data['employee_data'] = $this->data['employee_data'][0];

		parent::get_header();
		parent::get_left_nav();
		$this->load->view('admin/view_profile', $this->data);
		parent::get_footer();
	}


	/**
	 * LOCK THE SCREEN button action
	 */
	function lock_screen()
	{
		$this->session->set_userdata('screen_lock', "lock_the_screen");
		REDIRECT(MAINSITE_Admin . 'Screen-Lock');
	}

	function set_company()
	{
		$this->session->set_userdata('sess_company_profile_id', $_POST['sess_company_profile_id']);
		REDIRECT(MAINSITE_Admin . 'wam');
	}

	function access_denied()
	{
		parent::get_header();
		parent::get_left_nav();
		$this->load->view('admin/access_denied', $this->data);
		parent::get_footer();
	}


	function page_not_found()
	{
		$this->load->view('admin/page_not_found', $this->data);
	}

	public function index1()
	{
		$this->load->view('welcome_message');
	}

	function mypdf()
	{


		$this->load->library('pdf');


		$this->pdf->load_view('mypdf');
		$this->pdf->render();


		$this->pdf->stream("welcome.pdf");
	}
}
