<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		//$this->load->library('session');
		$this->load->model('Common_Model');
		$this->load->model('administrator/catalog/Project_Model');


		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');


		// $this->session->set_userdata('application_sess_store_id', 1);
		// $this->data['temp_name'] = $this->session->userdata('application_sess_temp_name');
		// $this->data['temp_id'] = $this->session->userdata('application_sess_temp_id');
		// $this->data['store_id'] = $this->session->userdata('application_sess_store_id');
		// $this->data['store_id'] = 1;
		// $this->data['cart_count'] = $this->session->userdata('application_sess_cart_count');
		$this->data['active_left_menu'] = '';

		$this->data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->session->set_userdata('application_sess_currency_id', 1);
		$this->session->set_userdata('application_sess_country_id', __const_country_id__);
		$app_sess_currency_id = $this->session->userdata('application_sess_currency_id');
		// if (empty($app_sess_currency_id) && false) {
		// 	$user_ip = getenv('REMOTE_ADDR');
		// 	$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
		// 	if (!empty($geo["geoplugin_countryName"])) {
		// 		if ($geo["geoplugin_countryName"] == 'India') {

		// 			$this->session->set_userdata('application_sess_currency_id', 1);
		// 			$this->session->set_userdata('application_sess_country_id', __const_country_id__);
		// 		} else {
		// 			$country_name = $geo["geoplugin_countryName"];
		// 			$getCountry_data = $this->Common_Model->getName(array('select' => '*', 'from' => 'country', 'where' => "(country_name like '$country_name' and status=1)"));
		// 			if (!empty($getCountry_data)) {
		// 				$getCountry_data = $getCountry_data[0];
		// 				$this->session->set_userdata('application_sess_currency_id', 2);
		// 				$this->session->set_userdata('application_sess_country_id', $getCountry_data->country_id);
		// 			} else {
		// 				$this->session->set_userdata('application_sess_currency_id', 1);
		// 				$this->session->set_userdata('application_sess_country_id', __const_country_id__);
		// 			}

		// 		}
		// 	} else {
		// 		$this->session->set_userdata('application_sess_currency_id', 1);
		// 		$this->session->set_userdata('application_sess_country_id', __const_country_id__);
		// 	}
		// }

		// $this->Common_Model->getWishlistItemCount();
		// $this->data['wishlist_count'] = $this->session->userdata('application_sess_wishlist_count');

		// if (empty($this->data['temp_id'])) {
		// 	$sess_temp_id = date("dmYhis");
		// 	if (empty($_COOKIE["application_user"])) {
		// 		setcookie("application_user", $sess_temp_id, time() + (86400 * 365), "/");
		// 		$this->session->set_userdata('application_sess_temp_id', $sess_temp_id);
		// 	} else {
		// 		$this->session->set_userdata('application_sess_temp_id', $_COOKIE["application_user"]);
		// 	}
		// }

		// $this->Common_Model->getCartItemCount();

		// $this->data['cart_coupon_code'] = $this->session->userdata('application_sess_coupon_code');
		// $this->data['cart_coupon_discount'] = $this->session->userdata('application_sess_discount');
		// $this->data['cart_discount_in'] = $this->session->userdata('application_sess_discount_in');
		// $this->data['cart_discount_variable'] = $this->session->userdata('application_sess_discount_variable');
		// $this->data['cart_discount_on_cart_value'] = $this->session->userdata('application_sess_discount_on_cart_value');
		// $this->data['cart_discount_cart_value_message'] = $this->session->userdata('application_sess_discount_cart_value_message');
	}


	public function getHeader($pageName, $data)
	{
		$this->data = $data;
		if (empty($this->data['js'])) {
			$this->data['js'] = array();
		}




		$completed_project_home_data_count = $this->Project_Model->get_project([
			"project_variant" => 2,
			"is_home_display" => 1,
			"search_for" => "count"
		]);
		$this->data['completed_project_home_data_count'] = $completed_project_home_data_count[0]->counts;

		$ongoing_project_home_data_count = $this->Project_Model->get_project([
			"project_variant" => 1,
			"is_home_display" => 1,
			"search_for" => "count"
		]);
		$this->data['ongoing_project_home_data_count'] = $ongoing_project_home_data_count[0]->counts;




		// //$this->data['js'] = array_merge(array( 'js/product.js'), $this->data['js']);
		// $this->data['check_screen'] = $this->Common_Model->checkScreen();
		// $this->data['runningLines'] = $this->Common_Model->getRunningLines();
		// $this->data['menu'] = $this->Common_Model->getMenu();
		$this->load->view("inc/$pageName", $this->data);
	}

	public function getFooter($pageName, $data)
	{
		$this->data = $data;
		// $this->data['js'] = array_merge(array('js/product.js'), $this->data['js']);
		$this->load->view("inc/$pageName", $this->data);
	}

	public function setCurrency($params = array())
	{
		if (empty($this->data['setCurency'])) {
			$this->data['setCurency'] = $this->Common_Model->setCurency();
		}
		return $this->data['setCurency'];
	}

	public function getCurrencyPrice($params = array())
	{
		//return $params['obj']['setCurency']->currency_rate*$params['amount'];
		return round($params['amount']);
		//echo $params['obj']['setCurency']->currency_rate;
		//echo $params['amount'];
	}



}
