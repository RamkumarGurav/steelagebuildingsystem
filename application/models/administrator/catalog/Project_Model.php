<?php
class Project_Model extends CI_Model
{
  public $session_uid = '';
  public $session_name = '';
  public $session_email = '';

  function __construct()
  {
    //db
    $this->load->database();


    $this->model_data = array();


    $this->db->query("SET sql_mode = ''");

    //session data
    $this->session_uid = $this->session->userdata('sess_psts_uid');
    $this->session_name = $this->session->userdata('sess_psts_name');
    $this->session_email = $this->session->userdata('sess_psts_email');


    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");
  }

  function get_project($params = array())
  {
    $result = '';

    // Check if search_for parameter is provided to decide the count query
    if (!empty($params['search_for'])) {

      $this->db->select("count(ft.project_id) as counts"); // Select count of records
    } else {

      // Select all required fields and additional information
      $this->db->select("ft.* ");
      $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = ft.added_by) as added_by_name "); // Select added_by user's name
      $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = ft.updated_by) as updated_by_name "); // Select updated_by user's name
      $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = ft.is_deleted_by) as is_deleted_by_name "); // Select updated_by user's name
    }

    // From admin_user table "ft" refers to "from table"
    $this->db->from("project as ft");

    // Joins with other tables
    // $this->db->join("project_plans as  tp", "tp.project_id = ft.project_id");
    // $this->db->join("things_to_carry as  ttc", "ttc.project_id = ft.project_id");
    // $this->db->join("gallery as  g", "g.project_id = ft.project_id");

    // Conditional logic for ordering results
    if (!empty($params['sortByPosition'])) {
      $this->db->order_by("ft.position ASC");
    } else if (!empty($params['sort_by_home_position'])) {
      $this->db->order_by("ft.home_position ASC");
    } else if (!empty($params['order_by'])) {
      $this->db->order_by($params['order_by']);
    } else {
      $this->db->order_by("ft.project_id desc");
    }




    // Conditions based on provided parameters
    if (!empty($params['project_id'])) {
      $this->db->where("ft.project_id", $params['project_id']);
    }

    if (!empty($params['project_variant'])) {
      $this->db->where("ft.project_variant", $params['project_variant']);
    }



    if (!empty($params['start_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['start_date']));
      $this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')"); // Start date condition
    }

    if (!empty($params['end_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['end_date']));
      $this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')"); // End date condition
    }

    if (!empty($params['record_status'])) {
      if ($params['record_status'] == 'zero') {
        $this->db->where("ft.status = 0"); // Status zero condition
      } else {
        $this->db->where("ft.status", $params['record_status']); // Specific status condition
      }
    }


    if (!empty($params['is_home_display'])) {
      if ($params['is_home_display'] == 'zero') {
        $this->db->where("ft.is_home_display = 0"); // Status zero condition
      } else {
        $this->db->where("ft.is_home_display", $params['is_home_display']); // Specific status condition
      }
    }


    if (!empty($params['field_value']) && !empty($params['field_name'])) {
      $this->db->where("$params[field_name] like ('%$params[field_value]%')"); // Field name and value condition
    }

    if (!empty($params['limit']) && !empty($params['offset'])) {
      $this->db->limit($params['limit'], $params['offset']); // Limit and offset for pagination
    } else if (!empty($params['limit'])) {
      $this->db->limit($params['limit']); // Limit for number of records
    }


    // Execute query and get results
    $query_get_list = $this->db->get();
    $result = $query_get_list->result();//RESULT CONTAINS ARRAY OF ADMIN_USERS


    // If details parameter is provided, fetch additional details
    if (!empty($result) && !empty($params['details'])) {
      foreach ($result as $utd) {


        $this->db->select("pgi.*");
        $this->db->from("project_gallery_image as pgi");
        $this->db->where("pgi.project_id", $utd->project_id);
        $this->db->order_by("pgi.position asc");
        $utd->project_gallery_image = $this->db->get()->result();




      }
    }

    return $result; // Return the final result
  }


  function get_project_gallery_image($params = array())
  {
    $result = '';

    // Check if search_for parameter is provided to decide the count query
    if (!empty($params['search_for'])) {

      $this->db->select("count(ft.project_gallery_image_id) as counts"); // Select count of records
    } else {

      // Select all required fields and additional information
      $this->db->select("ft.* ");
      $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = ft.added_by) as added_by_name "); // Select added_by user's name
      $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = ft.updated_by) as updated_by_name "); // Select updated_by user's name
      $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = ft.is_deleted_by) as is_deleted_by_name "); // Select updated_by user's name
    }

    // From admin_user table "ft" refers to "from table"
    $this->db->from("project_gallery_image as ft");

    // Joins with other tables
    // $this->db->join("project_plans as  tp", "tp.project_id = ft.project_id");
    // $this->db->join("things_to_carry as  ttc", "ttc.project_id = ft.project_id");
    // $this->db->join("gallery as  g", "g.project_id = ft.project_id");

    // Conditional logic for ordering results
    if (!empty($params['sortByPosition'])) {
      $this->db->order_by("ft.position ASC");
    } else if (!empty($params['order_by'])) {
      $this->db->order_by($params['order_by']);
    } else {
      $this->db->order_by("ft.project_gallery_image_id desc");
    }



    // Conditions based on provided parameters
    if (!empty($params['project_gallery_image_id'])) {
      $this->db->where("ft.project_gallery_image_id", $params['project_gallery_image_id']);
    }

    if (!empty($params['project_id'])) {
      $this->db->where("ft.project_id", $params['project_id']);
    }



    if (!empty($params['start_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['start_date']));
      $this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')"); // Start date condition
    }

    if (!empty($params['end_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['end_date']));
      $this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')"); // End date condition
    }

    if (!empty($params['record_status'])) {
      if ($params['record_status'] == 'zero') {
        $this->db->where("ft.status = 0"); // Status zero condition
      } else {
        $this->db->where("ft.status", $params['record_status']); // Specific status condition
      }
    }

    if (!empty($params['field_value']) && !empty($params['field_name'])) {
      $this->db->where("$params[field_name] like ('%$params[field_value]%')"); // Field name and value condition
    }

    if (!empty($params['limit']) && !empty($params['offset'])) {
      $this->db->limit($params['limit'], $params['offset']); // Limit and offset for pagination
    } else if (!empty($params['limit'])) {
      $this->db->limit($params['limit']); // Limit for number of records
    }


    // Execute query and get results
    $query_get_list = $this->db->get();
    $result = $query_get_list->result();//RESULT CONTAINS ARRAY OF ADMIN_USERS




    return $result; // Return the final result
  }
}

?>