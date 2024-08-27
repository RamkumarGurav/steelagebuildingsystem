<?php
class User_Model extends CI_Model
{
  function __construct()
  {
    date_default_timezone_set("Asia/Kolkata");
    $this->load->library('session');
    $this->db->query("SET sql_mode = ''");

    //headers
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");
  }




  function get_project($params = array())
  {
    $result = '';



    $this->db->select("ft.*");

    // From admin_user table "ft" refers to "from table"
    $this->db->from("project as ft");
    $this->db->where("ft.status", 1);

    if (!empty($params['project_id'])) {
      $this->db->where("ft.project_id", $params['project_id']);
    }

    if (!empty($params['slug_url'])) {
      $this->db->where("ft.slug_url", $params['slug_url']);
    }

    if (!empty($params['project_variant'])) {
      $this->db->where("ft.project_variant", $params['project_variant']);
    }

    if (!empty($params['is_home_display'])) {
      if ($params['is_home_display'] == 'zero') {
        $this->db->where("ft.is_home_display = 0"); // Status zero condition
      } else {
        $this->db->where("ft.is_home_display", $params['is_home_display']); // Specific status condition
      }
    }


    if (!empty($params['sort_by_home_position'])) {
      $this->db->order_by("ft.home_position ASC");
    } else if (!empty($params['order_by'])) {
      $this->db->order_by($params['order_by']);
    } else {
      $this->db->order_by("ft.position ASC");
    }






    if (!empty($params['start_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['start_date']));
      $this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')"); // Start date condition
    }

    if (!empty($params['end_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['end_date']));
      $this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')"); // End date condition
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


        $this->db->select("gi.*");
        $this->db->from("project_gallery_image as gi");
        $this->db->where("gi.project_id", $utd->project_id);
        $this->db->where("gi.status", 1);
        $this->db->order_by("gi.position asc");
        $utd->project_gallery_image = $this->db->get()->result();





      }
    }

    return $result; // Return the final result
  }



}

?>