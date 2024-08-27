<?php
class Database_Tables extends CI_Model
{
	var $customers_table_name = 'customers';

	var $ks_login_detail_fields = array('user_id', 'login_id', 'password', 'user_status', 'user_type');
	var $ks_login_detail_table_name = 'ks_login_detail';


	var $files_upload_table_name = 'files_upload';


	var $country_fields = array('country_id', 'country_name', 'country_short_name', 'country_code', 'status', 'added_on', 'added_by', 'updated_on', 'updated_by');
	var $country_table_name = 'country';

	var $state_fields = array('state_id', 'country_id', 'state_name', 'status', 'added_on', 'added_by', 'updated_on', 'updated_by', 'state_gst_code');
	var $state_table_name = 'state';

	var $city_fields = array('city_id', 'state_id', 'country_id', 'city_name', 'status', 'added_on', 'added_by', 'updated_on', 'updated_by');
	var $city_table_name = 'city';


	var $currency_fields = array('currency_id', 'country_id', 'currency_name', 'currency_code', 'currency_rate', 'symbol', 'added_on', 'updated_on', 'added_by', 'updated_by', 'status', 'defaults');
	var $currency_table_name = 'currency';



	function __construct()
	{
		//parent::__construct();

		date_default_timezone_set("Asia/Kolkata");

		$this->load->database();

		$this->db->query("SET sql_mode = ''");
	}
}
