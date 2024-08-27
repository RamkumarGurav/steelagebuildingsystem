<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "controllers/secureRegions/Main.php");
class Project_Module extends Main
{

  function __construct()
  {
    parent::__construct();

    //db
    $this->load->database();

    //libraries
    $this->load->library('session');
    $this->load->library('pagination');
    $this->load->library('User_auth');

    //helpers
    $this->load->helper('url');

    //models
    $this->load->model('Common_Model');
    $this->load->model('administrator/Admin_Common_Model');
    $this->load->model('administrator/Admin_model');
    $this->load->model('administrator/catalog/Project_Model');

    //session data
    $session_uid = $this->data['session_uid'] = $this->session->userdata('sess_psts_uid');
    $this->data['session_name'] = $this->session->userdata('sess_psts_name');
    $this->data['session_email'] = $this->session->userdata('sess_psts_email');


    //admin status
    $this->data['User_auth_obj'] = new User_auth();
    $this->data['user_data'] = $this->data['User_auth_obj']->check_user_status();

    //headers
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");

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


  function index()
  {


    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/catalog/Project_Module/list', $this->data);
    parent::get_footer();
  }

  function project_list()
  {


    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 195;
    $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));


    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }


    $search = array();
    $project_variant = $this->input->get("project_variant") ? $this->input->get("project_variant") : "";
    $field_name = '';
    $field_value = '';
    $end_date = '';
    $start_date = '';
    $record_status = "";

    if (!empty($_POST['project_variant']))
      $project_variant = $_POST['project_variant'];


    if (!empty($_REQUEST['field_name']))
      $field_name = $_POST['field_name'];
    else if (!empty($field_name))
      $field_name = $field_name;

    if (!empty($_REQUEST['field_value']))
      $field_value = $_POST['field_value'];
    else if (!empty($field_value))
      $field_value = $field_value;

    if (!empty($_POST['end_date']))
      $end_date = $_POST['end_date'];

    if (!empty($_POST['start_date']))
      $start_date = $_POST['start_date'];

    if (!empty($_POST['record_status']))
      $record_status = $_POST['record_status'];


    //this is useful to retian values inside search panel after selecting country or any other options
    $this->data['project_variant'] = $project_variant;
    $this->data['field_name'] = $field_name;
    $this->data['field_value'] = $field_value;
    $this->data['end_date'] = $end_date;
    $this->data['start_date'] = $start_date;
    $this->data['record_status'] = $record_status;


    $search['project_variant'] = $project_variant;
    $search['end_date'] = $end_date;
    $search['start_date'] = $start_date;
    $search['field_value'] = $field_value;
    $search['field_name'] = $field_name;
    $search['record_status'] = $record_status;
    $search['search_for'] = "count";


    //getting count
    $data_count = $this->Project_Model->get_project($search);
    $r_count = $this->data['row_count'] = $data_count[0]->counts;


    //deleting count parameter
    unset($search['search_for']);

    $offset = (int) $this->uri->segment(5); //echo $offset;
    if ($offset == "") {
      $offset = '0';
    }

    $per_page = _all_pagination_;

    $this->load->library('pagination');
    $config['base_url'] = MAINSITE_Admin . $this->data['user_access']->class_name . '/' . $this->data['user_access']->function_name . '/';
    $config['total_rows'] = $r_count;
    $config['uri_segment'] = '5';
    $config['per_page'] = $per_page;
    $config['num_links'] = 4;
    $config['first_link'] = '&lsaquo; First';
    $config['last_link'] = 'Last &rsaquo;';
    $config['prev_link'] = 'Prev';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
    $config['attributes'] = array('class' => 'paginationClass');


    $this->pagination->initialize($config);

    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

    $search['details'] = 1;

    $search['limit'] = $per_page;
    $search['offset'] = $offset;


    $this->data['project_data'] = $this->Project_Model->get_project($search);




    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/catalog/Project_Module/project_list', $this->data);
    parent::get_footer();
  }

  function project_doUpdateStatus()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 195;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    //print_r($this->data['user_access']);
    $task = $_POST['task'];
    $id_arr = $_POST['sel_recds'];
    if (empty($user_access)) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }
    if ($user_access->update_module == 1) {
      $this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-ban"></i> Something Went Wrong Please Try Again. 
				  </div>');
      $update_data = array();
      if (!empty($id_arr)) {
        $action_taken = "";
        $ids = implode(',', $id_arr);
        if ($task == "active") {
          $update_data['status'] = 1;
          $action_taken = "Activate";
        }
        if ($task == "block") {
          $update_data['status'] = 0;
          $action_taken = "Blocked";
        }
        $update_data['updated_on'] = date("Y-m-d H:i:s");
        $update_data['updated_by'] = $this->data['session_uid'];
        $response = $this->Common_Model->update_operation(array('table' => "project", 'data' => $update_data, 'condition' => "project_id in ($ids)"));
        if ($response) {
          $this->session->set_flashdata('alert_message', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<i class="icon fas fa-check"></i> Records Successfully ' . $action_taken . ' 
						</div>');
        }
      }
      REDIRECT(MAINSITE_Admin . $user_access->class_name . '/' . $user_access->function_name);
    } else {
      $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Update " . $user_access->module_name);
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }
  }

  function project_view($project_id = "")
  {


    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 195;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));


    if (empty($project_id)) {
      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close"
			 data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong. Please Try Again. </div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
      exit;
    }


    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }


    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;



    $this->data['project_data'] = $this->Project_Model->get_project(array("project_id" => $project_id, "details" => 1));



    //if there is no data for given project_id show page not found page
    if (empty($this->data['project_data'])) {
      REDIRECT(MAINSITE_Admin . "wam/page_not_found");
      exit;
    }


    if (empty($project_id)) {
      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" 
			aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong. Please Try Again. </div>';
      $this->session->set_flashdata('alert_message', $alert_message);

      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
      exit;
    }

    $this->data['project_data'] = $this->data['project_data'][0];



    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/catalog/Project_Module/project_view', $this->data);
    parent::get_footer();
  }





  function project_edit($project_id = "")
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 195;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));


    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    if (empty($project_id)) {
      if ($user_access->add_module != 1) {
        $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Add " . $user_access->module_name);
        REDIRECT(MAINSITE_Admin . "wam/access-denied");
      }
    }

    if (!empty($project_id)) {
      if ($user_access->update_module != 1) {
        $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Update " . $user_access->module_name);
        REDIRECT(MAINSITE_Admin . "wam/access-denied");
      }
    }

    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;


    if (!empty($project_id)) {
      $this->data['project_data'] = $this->Project_Model->get_project(array("project_id" => $project_id, "details" => 1));

      if (empty($this->data['project_data'])) {

        $this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-ban"></i> Record Not Found. 
				  </div>');
        REDIRECT(MAINSITE_Admin . $user_access->class_name . '/' . $user_access->function_name);
      }
      $this->data['project_data'] = $this->data['project_data'][0];
    }



    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/catalog/Project_Module/project_edit', $this->data);
    parent::get_footer();
  }


  function projectDoEdit()
  {


    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 195;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));




    if (empty($_POST['name']) && empty($_POST['description']) && empty($_POST['project_variant']) && empty($_POST['slug_url'])) {
      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
			class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i>
			Something Went Wrong. Please Try Again.</div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
      exit;
    }

    $project_id = $_POST['project_id'];

    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    if (empty($project_id)) {
      if ($user_access->add_module != 1) {
        $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Add " . $user_access->module_name);
        REDIRECT(MAINSITE_Admin . "wam/access-denied");
      }
    }


    if (!empty($project_id)) {
      if ($user_access->update_module != 1) {
        $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Update " . $user_access->module_name);
        REDIRECT(MAINSITE_Admin . "wam/access-denied");
      }


    }

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $project_variant = trim($_POST['project_variant']);
    $slug_url = trim($_POST['slug_url']);
    $status = trim($_POST['status']);


    $isValidSlug = $this->isValidSlug($slug_url);


    if (empty($isValidSlug)) {

      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" 
        aria-hidden="true">×</button><i class="icon fas fa-ban"></i>Invalid Slug URL.</div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      if (!empty($project_id)) {
        REDIRECT(MAINSITE_Admin . $user_access->class_name . "/project-edit/" . $project_id);
      } else {
        REDIRECT(MAINSITE_Admin . $user_access->class_name . "/project-edit/");
      }
      exit;

    }





    $is_exist = $this->Common_Model->getData(
      array(
        'select' => '*',
        'from' => 'project',
        'where' => "slug_url = '$slug_url' and project_id != $project_id"
      )
    );





    if (!empty($is_exist)) {

      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" 
			aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Upcoming Project already exist in database.</div>';

      $this->session->set_flashdata('alert_message', $alert_message);

      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/project-edit/" . $project_id);
      exit;
    }

    $enter_data['name'] = $name;
    $enter_data['description'] = $description;
    $enter_data['project_variant'] = $project_variant;
    $enter_data['slug_url'] = $slug_url;
    $enter_data['status'] = $status;



    $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"
     aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong Please Try Again. </div>';
    if (!empty($project_id)) {
      $enter_data['updated_on'] = date("Y-m-d H:i:s");
      $enter_data['updated_by'] = $this->data['session_uid'];

      $insertStatus = $this->Common_Model->update_operation(array('table' => 'project', 'data' => $enter_data, 'condition' => "project_id = $project_id"));
      if (!empty($insertStatus)) {
        $this->upload_any_image("project", "project_id", $project_id, "project_cover_image", "project_cover_image", "project_cover_image_", "project_cover_image");
        $alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" 
				aria-hidden="true">×</button><i class="icon fas fa-check"></i> Record Updated Successfully </div>';
      }

    } else {
      $enter_data['added_on'] = date("Y-m-d H:i:s");
      $enter_data['added_by'] = $this->data['session_uid'];

      $project_id = $insertStatus = $this->Common_Model->add_operation(array('table' => 'project', 'data' => $enter_data));
      if (!empty($insertStatus)) {
        $this->upload_any_image("project", "project_id", $project_id, "project_cover_image", "project_cover_image", "project_cover_image_", "project_cover_image");
        $alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> New Record Added Successfully </div>';
      }
    }


    if ($insertStatus >= 1) {
      $this->upload_multi_files_normal_pgi($project_id);
    }



    $this->session->set_flashdata('alert_message', $alert_message);

    if (!empty($_POST['redirect_type'])) {
      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/project-edit");
    }

    REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);

  }

  function project_on_home_edit()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 195;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));


    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }



    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;




    $this->data['ongoing_project_data'] = $this->Project_Model->get_project(
      array(
        "project_variant" => 1,
        "is_home_display" => "zero",
      )
    );
    $this->data['completed_project_data'] = $this->Project_Model->get_project(
      array(
        "project_variant" => 2,
        "is_home_display" => "zero",
      )
    );
    $this->data['ongoing_project_on_display_data'] = $this->Project_Model->get_project(
      array(
        "project_variant" => 1,
        "is_home_display" => 1,
        "sort_by_home_position" => 1,
      )
    );
    $this->data['completed_project_on_display_data'] = $this->Project_Model->get_project(
      array(
        "project_variant" => 2,
        "is_home_display" => 1,
        "sort_by_home_position" => 1,
      )
    );







    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/catalog/Project_Module/project_on_home_edit', $this->data);
    parent::get_footer();
  }

  function project_on_home_do_edit()
  {

    $max_project_id_arr_oph = 5;
    $max_project_id_arr_cph = 5;

    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 195;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }


    $input_project_id_arr_oph = $_POST['project_id_arr_oph'];

    $input_project_id_arr_oph = array_filter($input_project_id_arr_oph, function ($value) {
      if (!empty($value)) {
        return $value;
      }

    });

    $input_project_id_arr_cph = $_POST['project_id_arr_cph'];
    $input_project_id_arr_cph = array_filter($input_project_id_arr_cph, function ($value) {
      if (!empty($value)) {
        return $value;
      }

    });








    if (empty($input_project_id_arr_oph) && empty($input_project_id_arr_cph)) {
      $alert_message = '<div class="alert alert-warning alert-dismissible"><button type="button" 
			class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-info"></i>
		You are submitting empty form!</div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/project_on_home_edit");
      exit;
    } else {
      $ongoing_project_on_home_data = $this->Project_Model->get_project(
        array(
          "search_for" => "count",
          "project_variant" => 1,
          "is_home_display" => 1,
          "sort_by_home_position" => 1,
        )
      );
      $ongoing_project_on_home_data_count = $ongoing_project_on_home_data[0]->counts;



      if (!empty($input_project_id_arr_oph)) {

        if (count($input_project_id_arr_oph) > ($max_project_id_arr_oph - $ongoing_project_on_home_data_count)) {
          $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
          class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i>
        Maximum ' . $max_project_id_arr_oph . ' Ongoing projects are allowed on Home Page!</div>';
          $this->session->set_flashdata('alert_message', $alert_message);
          REDIRECT(MAINSITE_Admin . $user_access->class_name . "/project_on_home_edit");
          exit;
        }


      }



      $completed_project_on_home_data = $this->Project_Model->get_project(
        array(
          "search_for" => "count",
          "project_variant" => 2,
          "is_home_display" => 1,
          "sort_by_home_position" => 1,
        )
      );
      $completed_project_on_home_data_count = $completed_project_on_home_data[0]->counts;


      if (!empty($input_project_id_arr_cph)) {

        if (count($input_project_id_arr_cph) > ($max_project_id_arr_cph - $completed_project_on_home_data_count)) {
          $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
          class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i>
        Maximum ' . $max_project_id_arr_cph . ' Completed projects are allowed on Home Page!</div>';
          $this->session->set_flashdata('alert_message', $alert_message);
          REDIRECT(MAINSITE_Admin . $user_access->class_name . "/project_on_home_edit");
          exit;
        }



      }

    }

    $ids_arr = array_merge($input_project_id_arr_oph, $input_project_id_arr_cph);
    $ids = implode(',', $ids_arr);








    $update_data['is_home_display'] = 1;
    $update_data['updated_on'] = date("Y-m-d H:i:s");
    $update_data['updated_by'] = $this->data['session_uid'];
    $response = $this->Common_Model->update_operation(array('table' => "project", 'data' => $update_data, 'condition' => "project_id in ($ids)"));
    if ($response) {
      $this->session->set_flashdata('alert_message', '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fas fa-check"></i> Records Successfully added to Home page. 
        </div>');
    } else {
      $this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <i class="icon fas fa-ban"></i>Something went wrong!. 
      </div>');
    }






    REDIRECT(MAINSITE_Admin . $user_access->class_name . "/project_on_home_edit");
  }

  public function addNewLine_oph()
  {
    if (!empty($_POST['append_id_oph'])) {
      $this->data['append_id_oph'] = $_POST['append_id_oph'];
    }



    $this->data['ongoing_project_data'] = $this->Project_Model->get_project(
      array(
        "project_variant" => 1,
        "is_home_display" => "zero",
      )
    );





    $template = $this->load->view('admin/catalog/Project_Module/template/project_add_more_oph', $this->data, true);
    echo json_encode(array("template" => $template));
  }


  public function addNewLine_cph()
  {
    if (!empty($_POST['append_id_cph'])) {
      $this->data['append_id_cph'] = $_POST['append_id_cph'];
    }



    $this->data['completed_project_data'] = $this->Project_Model->get_project(
      array(
        "project_variant" => 2,
        "is_home_display" => "zero",
      )
    );


    $template = $this->load->view('admin/catalog/Project_Module/template/project_add_more_cph', $this->data, true);
    echo json_encode(array("template" => $template));
  }

  function setPositions()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 195;
    $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    //print_r($this->data['user_access']);
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }
    $this->data['page_is_master'] = $this->data['user_access']->is_master;
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

    $this->data['project_data'] = $this->Project_Model->get_project();

    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/catalog/Project_Module/project_position', $this->data);
    parent::get_footer();
  }

  function setPositionsOngoingProject()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 195;
    $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    //print_r($this->data['user_access']);
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }
    $this->data['page_is_master'] = $this->data['user_access']->is_master;
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

    $search["project_variant"] = 1;

    $this->data['project_data'] = $this->Project_Model->get_project($search);

    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/catalog/Project_Module/ongoing_project_position', $this->data);
    parent::get_footer();
  }
  function setPositionsCompletedProject()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 195;
    $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    //print_r($this->data['user_access']);
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }
    $this->data['page_is_master'] = $this->data['user_access']->is_master;
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

    $search["project_variant"] = 2;

    $this->data['project_data'] = $this->Project_Model->get_project($search);

    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/catalog/Project_Module/completed_project_position', $this->data);
    parent::get_footer();
  }




  function GetCompleteProjectList($project_id = '', $withPosition = '', $sortByPosition = '')
  {
    $project_variant = "";
    $search = array();
    if (!empty($_POST['project_id'])) {
      $project_id = $_POST['project_id'];
    }
    if (!empty($_POST['withPosition'])) {
      $withPosition = $_POST['withPosition'];
    }
    if (!empty($_POST['sortByPosition'])) {
      $sortByPosition = $_POST['sortByPosition'];
    }
    if (!empty($_POST['project_variant'])) {
      $project_variant = $_POST['project_variant'];
    }
    $search['project_id'] = $project_id;
    $search['withPosition'] = $withPosition;
    $search['sortByPosition'] = $sortByPosition;
    $search['project_variant'] = $project_variant;
    $data['project_list'] = $this->Project_Model->get_project($search);
    //print_r($data['project_list']);
    $show = '';
    $count = 0;
    foreach ($data['project_list'] as $row) {
      $project_variant_name = "";
      if ($row->project_variant == 1) {
        $project_variant_name = "Ongoing Project";
      } elseif ($row->project_variant == 2) {
        $project_variant_name = "Completed Project";
      } else {
        $project_variant_name = "-";
      }

      $row = (array) $row;
      $count++;
      $link = MAINSITE_Admin . "catalog/Project-Module/project_view/" . $row['project_id'];
      $link1 = MAINSITE_Admin . "catalog/Project-Module/project_edit/" . $row['project_id'];
      if ($row['updated_on'] != '0000-00-00 00:00:00') {
        $updated_on = date('d-m-Y', strtotime($row['updated_on']));
      } else {
        $updated_on = 'N/A';
      }
      if ($row['name'] == '') {
        $row['name'];
      }
      $show .= "<tr id='$row[project_id]'>";
      $show .= "<td>$count</td>";
      $show .= "<td>$row[name]</td>";
      $show .= "<td>$project_variant_name</td>";
      if ($withPosition == 1) {
        $show .= '<td><span style="cursor: move;" class="fa fa-arrows-alt" ></span> ' . $row['position'] . '</td>';
      }
      if ($row['status']) {
        $show .= "<td class='nodrag' align='center'><i class='fa fa-check true-icon'></i><span style='display:none'>Publish</span></td>";
      } else {
        $show .= "<td align='center'><i class='fa fa-close false-icon'></i><span style='display:none'>Un Publish</span></td>";
      }
      $show .= "<td>" . date('d-m-Y', strtotime($row['added_on'])) . "</td>";
      $show .= "<td><a class='btn btn-primary' href='$link' style='padding:1px 5px;'><i class='fa fa-eye'></i></a>
			<a class='btn btn-info' href='$link1' style='padding:1px 5px;'><i class='fa fa-edit'></i></a></td>";
      $show .= '</tr>';
    }
    echo $show;
  }

  function GetCompleteProjectListNewPos()
  {
    $search = array();
    $project_id = '';
    $project_variant = '';
    $podId = '';
    $podIdArr = '';
    if (!empty($_POST['project_id']))
      $project_id = $_POST['project_id'];
    if (!empty($_POST['project_variant']))
      $project_variant = $_POST['project_variant'];
    if (!empty($_POST['podId'])) {
      $podId = trim($_POST['podId'], ',');
      $podIdArr = explode(',', $podId);
    }
    $this->data['project_id'] = $project_id;
    $this->data['podId'] = $podIdArr;
    $search['project_id'] = $project_id;
    $search['podId'] = $podIdArr;
    $search['search_for'] = "count";
    $show = "No Record To Display";
    $project_list = $this->Project_Model->get_project($search);
    $count = 0;
    $countPos = 0;
    foreach ($podIdArr as $row) {
      $countPos++;
      $update_data['position'] = $countPos;//$podIdArr[$count];	
      $condition = "(project_id in ($podIdArr[$count]))";
      //$insertStatus = $this->Admin_Model->update($update_data,'category','' , $condition); //echo $insertStatus;
      $insertStatus = $this->Common_Model->update_operation(array('table' => 'project', 'data' => $update_data, 'condition' => $condition));
      //echo $this->db->last_query().'<br><br><br><br><br>';
      $count++;
    }
    $this->GetCompleteProjectList($project_id, 1, 1);
  }


  function get_project_list_for_home($project_id = '', $with_position = '', $sort_by_home_position = '')
  {
    $project_variant = "";
    $is_home_display = 1;
    $search = array();

    if (!empty($_POST['with_position'])) {
      $with_position = $_POST['with_position'];
    }
    if (!empty($_POST['is_home_display'])) {
      $is_home_display = $_POST['is_home_display'];
    }

    if (!empty($_POST['sort_by_home_position'])) {
      $sort_by_home_position = $_POST['sort_by_home_position'];
    }
    if (!empty($_POST['project_variant'])) {
      $project_variant = $_POST['project_variant'];
    }

    $search['sort_by_home_position'] = $sort_by_home_position;
    $search['is_home_display'] = $is_home_display;
    $search['project_variant'] = $project_variant;
    $data['project_list'] = $this->Project_Model->get_project($search);

    $show = '';
    $count = 0;
    foreach ($data['project_list'] as $row) {
      $project_variant_name = "";
      if ($row->project_variant == 1) {
        $project_variant_name = "Ongoing Project";
      } elseif ($row->project_variant == 2) {
        $project_variant_name = "Completed Project";
      } else {
        $project_variant_name = "-";
      }

      $row = (array) $row;
      $count++;
      $link = MAINSITE_Admin . "catalog/Project-Module/project_view/" . $row['project_id'];
      $link1 = MAINSITE_Admin . "catalog/Project-Module/project_edit/" . $row['project_id'];
      if ($row['updated_on'] != '0000-00-00 00:00:00') {
        $updated_on = date('d-m-Y', strtotime($row['updated_on']));
      } else {
        $updated_on = 'N/A';
      }
      if ($row['name'] == '') {
        $row['name'];
      }
      $show .= "<tr id='$row[project_id]'>";
      $show .= "<td>$count</td>";
      $show .= "<td>$row[name]</td>";
      $show .= "<td>$project_variant_name</td>";
      if ($with_position == 1) {
        $show .= '<td><span style="cursor: move;padding-left:30px;" class="fa fa-arrows-alt" ></span> ' . $row['home_position'] . '</td>';
      }
      if ($row['status']) {
        $show .= "<td class='nodrag' align='center'><i class='fa fa-check true-icon'></i><span >Active</span></td>";
      } else {
        $show .= "<td align='center'><i class='fa fa-close false-icon'></i><span >Blocked</span></td>";
      }
      $show .= "<td style='padding-left:50px'><button class='btn btn-outline-danger btn-xs'
      onclick='return remove_from_home(`$row[project_id]`)' title='remove'><i
        class='fas fa-trash'></i></button></td>";
      $show .= '</tr>';
    }
    echo $show;
  }

  function get_project_list_for_home_new_pos()
  {
    $search = array();
    $project_id = '';
    $project_variant = '';
    $podId = '';
    $podIdArr = '';
    if (!empty($_POST['project_id']))
      $project_id = $_POST['project_id'];
    if (!empty($_POST['project_variant']))
      $project_variant = $_POST['project_variant'];
    if (!empty($_POST['podId'])) {
      $podId = trim($_POST['podId'], ',');
      $podIdArr = explode(',', $podId);
    }
    $this->data['project_id'] = $project_id;
    $this->data['podId'] = $podIdArr;
    $search['project_id'] = $project_id;
    $search['podId'] = $podIdArr;
    $search['search_for'] = "count";
    $show = "No Record To Display";
    $project_list = $this->Project_Model->get_project($search);
    $count = 0;
    $countPos = 0;
    foreach ($podIdArr as $row) {
      $countPos++;
      $update_data['home_position'] = $countPos;//$podIdArr[$count];	
      $condition = "(project_id in ($podIdArr[$count]))";
      //$insertStatus = $this->Admin_Model->update($update_data,'category','' , $condition); //echo $insertStatus;
      $insertStatus = $this->Common_Model->update_operation(array('table' => 'project', 'data' => $update_data, 'condition' => $condition));
      //echo $this->db->last_query().'<br><br><br><br><br>';
      $count++;
    }
    $this->get_project_list_for_home($project_id, 1, 1);
  }

  function setPositionsProjectGalleryImage($project_id = "")
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 195;
    $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    //print_r($this->data['user_access']);
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }
    $this->data['page_is_master'] = $this->data['user_access']->is_master;
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

    $search["project_id"] = $project_id;
    $this->data['project_data'] = $this->Project_Model->get_project($search)[0];

    $this->data['project_gallery_image_data'] = $this->Project_Model->get_project_gallery_image($search);

    $this->data['project_id'] = $project_id;

    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/catalog/Project_Module/pgi_position', $this->data);
    parent::get_footer();
  }
  function GetCompleteProjectGalleryImageList($project_gallery_image_id = '', $withPosition = '', $sortByPosition = '')
  {

    $search = array();
    if (!empty($_POST['project_gallery_image_id'])) {
      $project_gallery_image_id = $_POST['project_gallery_image_id'];
    }
    if (!empty($_POST['project_id'])) {
      $project_id = $_POST['project_id'];
    }
    if (!empty($_POST['withPosition'])) {
      $withPosition = $_POST['withPosition'];
    }
    if (!empty($_POST['sortByPosition'])) {
      $sortByPosition = $_POST['sortByPosition'];
    }

    $search['project_gallery_image_id'] = $project_gallery_image_id;
    $search['project_id'] = $project_id;
    $search['withPosition'] = $withPosition;
    $search['sortByPosition'] = $sortByPosition;
    $data['project_gallery_image_list'] = $this->Project_Model->get_project_gallery_image($search);

    // print_r($data['project_gallery_image_list']);
    $show = '';
    $count = 0;
    foreach ($data['project_gallery_image_list'] as $row) {


      $row = (array) $row;
      $count++;
      $link = MAINSITE_Admin . "catalog/Project-Module/project_view/" . $row['project_gallery_image_id'];
      $link1 = MAINSITE_Admin . "catalog/Project-Module/project_edit/" . $row['project_gallery_image_id'];
      if ($row['updated_on'] != '0000-00-00 00:00:00') {
        $updated_on = date('d-m-Y', strtotime($row['updated_on']));
      } else {
        $updated_on = 'N/A';
      }


      $image_link = _uploaded_files_ . 'project_gallery_image/' . $row["file"];
      $show .= "<tr id='$row[project_gallery_image_id]'>";
      $show .= "<td>$count</td>";
      $show .= "<td><a href='$image_link'
														target='_blank'><img
															src='$image_link'
															alt='' width='120' height='60' border='0' /></a></td>";
      if ($withPosition == 1) {
        $show .= '<td><span style="cursor: move;" class="fa fa-arrows-alt" ></span> ' . $row['position'] . '</td>';
      }
      if ($row['status']) {
        $show .= "<td class='nodrag' align='center'><i class='fa fa-check true-icon'></i><span style='display:none'>Publish</span></td>";
      } else {
        $show .= "<td align='center'><i class='fa fa-close false-icon'></i><span style='display:none'>Un Publish</span></td>";
      }
      $show .= "<td>" . date('d-m-Y', strtotime($row['added_on'])) . "</td>";
      $show .= "<td><button class='btn btn-outline-danger btn-xs'
																	onclick='return del_pgi(`$row[project_gallery_image_id]`)' title='remove'><i
																		class='fas fa-trash'></i></button></td>";
      $show .= '</tr>';
    }
    echo $show;
  }

  function GetCompleteProjectGalleryImageListNewPos()
  {
    $search = array();
    $project_gallery_image_id = '';
    $project_id = '';
    $podId = '';
    $podIdArr = '';
    if (!empty($_POST['project_gallery_image_id']))
      $project_gallery_image_id = $_POST['project_gallery_image_id'];
    if (!empty($_POST['project_id']))
      $project_id = $_POST['project_id'];

    if (!empty($_POST['podId'])) {
      $podId = trim($_POST['podId'], ',');
      $podIdArr = explode(',', $podId);
    }
    $this->data['project_gallery_image_id'] = $project_gallery_image_id;
    $this->data['project_id'] = $project_id;
    $this->data['podId'] = $podIdArr;
    $search['project_gallery_image_id'] = $project_gallery_image_id;
    $search['project_id'] = $project_id;
    $search['podId'] = $podIdArr;
    $search['search_for'] = "count";
    $show = "No Record To Display";
    $project_gallery_image_list = $this->Project_Model->get_project_gallery_image($search);
    $count = 0;
    $countPos = 0;
    foreach ($podIdArr as $row) {
      $countPos++;
      $update_data['position'] = $countPos;//$podIdArr[$count];	
      $condition = "(project_gallery_image_id in ($podIdArr[$count]))";
      //$insertStatus = $this->Admin_Model->update($update_data,'category','' , $condition); //echo $insertStatus;
      $insertStatus = $this->Common_Model->update_operation(array('table' => 'project_gallery_image', 'data' => $update_data, 'condition' => $condition));
      //echo $this->db->last_query().'<br><br><br><br><br>';
      $count++;
    }
    $this->GetCompleteProjectGalleryImageList($project_gallery_image_id, 1, 1);
  }


  function upload_any_image($table_name, $id_column, $id, $input_name, $target_column, $prefix, $target_folder_name)
  {
    $file_name = "";
    if (isset($_FILES[$input_name]['name'])) {
      $timg_name = $_FILES[$input_name]['name'];
      if (!empty($timg_name)) {
        $temp_var = explode(".", strtolower($timg_name));
        $timage_ext = end($temp_var);
        $timage_name_new = $prefix . $id . "." . $timage_ext;
        $image_enter_data[$target_column] = $timage_name_new;
        $imginsertStatus = $this->Common_Model->update_operation(array('table' => $table_name, 'data' => $image_enter_data, 'condition' => "$id_column = $id"));
        if ($imginsertStatus == 1) {
          if (!is_dir(_uploaded_temp_files_ . $target_folder_name)) {
            mkdir(_uploaded_temp_files_ . './' . $target_folder_name, 0777, TRUE);

          }


          move_uploaded_file($_FILES["$input_name"]['tmp_name'], _uploaded_temp_files_ . $target_folder_name . "/" . $timage_name_new);
          $file_name = $timage_name_new;
        }

      }
    }
  }






  public function isValidSlug($slug)
  {
    // Check if the slug contains only lowercase letters, numbers, and hyphens
    return preg_match('/^[a-z0-9-]+$/', $slug);
  }

  public function addNewLine_pgi()
  {
    if (!empty($_POST['append_id_pgi'])) {
      $this->data['append_id_pgi'] = $_POST['append_id_pgi'];
    }
    $template = $this->load->view('admin/catalog/Project_Module/template/file_line_add_more_pgi', $this->data, true);
    echo json_encode(array("template" => $template));
  }




  function upload_multi_files_normal_pgi($idf)
  {

    $table_name = "project_gallery_image";
    $idp_column = "project_gallery_image_id";
    $idf_column = "project_id";
    $input_file_name = "image";
    $target_file_column = "file";
    $prefix = "project_gallery_image_";
    $target_folder_name = "project_gallery_image";
    $logo_file_name = "";
    $count = 0;

    if (!empty($_FILES[$input_file_name]['name'])) {
      if (!is_dir(_uploaded_temp_files_ . $target_folder_name)) {
        mkdir('./' . _uploaded_temp_files_ . $target_folder_name, 0777, TRUE);
      }

      // $file_title2 = $_POST[$input_text_name];
      for ($i = 0; $i < count($_FILES[$input_file_name]['name']); $i++) {
        if (isset($_FILES[$input_file_name]['name'][$i]) && !empty($_FILES[$input_file_name]['name'][$i])) {

          $img_data[$idf_column] = $idf;
          $img_data['added_on'] = date("Y-m-d H:i:s");
          $img_data['added_by'] = $this->data['session_uid'];
          $idp = $this->Common_Model->add_operation(array('table' => $table_name, 'data' => $img_data));

          $count++;

          $timg_name = $_FILES[$input_file_name]['name'][$i];
          $temp_var = explode(".", strtolower($timg_name));
          $timage_ext = end($temp_var);
          $timage_name_new = $prefix . $idf . "_" . $idp . "." . $timage_ext;
          $update_img_data[$target_file_column] = $timage_name_new;
          $idp = $this->Common_Model->update_operation(array('table' => $table_name, 'data' => $update_img_data, 'condition' => "$idp_column = $idp"));
          if ($idp > 0) {
            move_uploaded_file($_FILES[$input_file_name]['tmp_name'][$i], _uploaded_temp_files_ . $target_folder_name . "/" . $timage_name_new);
            $logo_file_name = $timage_name_new;
          }
        }
      }
    }
  }

  function upload_multi_files_pgi($idf)
  {
    $table_name = "project_gallery_image";
    $idp_column = "project_gallery_image_id";
    $idf_column = "project_id";
    $input_file_name = "file_pgi";
    $input_text_name = "position_pgi";
    $target_file_column = "file";
    $target_text_column = "position";
    $prefix = "project_gallery_image_";
    $target_folder_name = "project_gallery_image";
    $logo_file_name = "";
    $count = 0;

    if (!empty($_FILES[$input_file_name]['name'])) {
      if (!is_dir(_uploaded_temp_files_ . $target_folder_name)) {
        mkdir('./' . _uploaded_temp_files_ . $target_folder_name, 0777, TRUE);
      }

      $file_title2 = $_POST[$input_text_name];
      for ($i = 0; $i < count($_FILES[$input_file_name]['name']); $i++) {
        if (isset($_FILES[$input_file_name]['name'][$i]) && !empty($_FILES[$input_file_name]['name'][$i])) {

          $img_data[$target_text_column] = $file_title2[$i];
          $img_data[$idf_column] = $idf;
          $img_data['added_on'] = date("Y-m-d H:i:s");
          $img_data['added_by'] = $this->data['session_uid'];
          $idp = $this->Common_Model->add_operation(array('table' => $table_name, 'data' => $img_data));

          $count++;

          $timg_name = $_FILES[$input_file_name]['name'][$i];
          $temp_var = explode(".", strtolower($timg_name));
          $timage_ext = end($temp_var);
          $timage_name_new = $prefix . $idp . "." . $timage_ext;
          $update_img_data[$target_file_column] = $timage_name_new;
          $idp = $this->Common_Model->update_operation(array('table' => $table_name, 'data' => $update_img_data, 'condition' => "$idp_column = $idp"));
          if ($idp > 0) {
            move_uploaded_file($_FILES[$input_file_name]['tmp_name'][$i], _uploaded_temp_files_ . $target_folder_name . "/" . $timage_name_new);
            $logo_file_name = $timage_name_new;
          }
        }
      }
    }
  }



  ////////////////////////////////////





  function project_list_export()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 195;
    $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    //print_r($this->data['user_access']);
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    if ($this->data['user_access']->export_data != 1) {
      $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Export " . $user_access->module_name);
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }
    $search = array();
    $field_name = '';
    $field_value = '';
    $end_date = '';
    $start_date = '';
    $record_status = "";
    $country_id = "";
    $state_id = "";

    if (!empty($_REQUEST['field_name']))
      $field_name = $_POST['field_name'];
    else if (!empty($field_name))
      $field_name = $field_name;

    if (!empty($_REQUEST['field_value']))
      $field_value = $_POST['field_value'];
    else if (!empty($field_value))
      $field_value = $field_value;

    if (!empty($_POST['end_date']))
      $end_date = $_POST['end_date'];

    if (!empty($_POST['start_date']))
      $start_date = $_POST['start_date'];

    if (!empty($_POST['record_status']))
      $record_status = $_POST['record_status'];

    if (!empty($_POST['country_id']))
      $country_id = $_POST['country_id'];

    if (!empty($_POST['state_id']))
      $state_id = $_POST['state_id'];


    $this->data['field_name'] = $field_name;
    $this->data['field_value'] = $field_value;
    $this->data['end_date'] = $end_date;
    $this->data['start_date'] = $start_date;
    $this->data['record_status'] = $record_status;
    $this->data['country_id'] = $country_id;
    $this->data['state_id'] = $state_id;

    $search['end_date'] = $end_date;
    $search['start_date'] = $start_date;
    $search['field_value'] = $field_value;
    $search['field_name'] = $field_name;
    $search['record_status'] = $record_status;
    $search['country_id'] = $country_id;
    $search['state_id'] = $state_id;
    $search['details'] = 1;

    $this->data['project_data'] = $this->Project_Model->get_project($search);


    $this->load->view('admin/catalog/Project_Module/project_list_export', $this->data);
  }









  function upload_project_file($project_id)
  {
    $logo_file_name = "";
    $count = 0;
    if (!empty($_FILES["file"]['name'])) {
      if (!is_dir(_uploaded_temp_files_ . 'project_file')) {
        mkdir('./' . _uploaded_temp_files_ . 'project_file', 0777, TRUE);
      }

      $file_title = $_POST['file_title'];
      //echo count($_FILES["file"]['name']);
      for ($i = 0; $i < count($_FILES["file"]['name']); $i++) {
        if (isset($_FILES["file"]['name'][$i]) && !empty($_FILES["file"]['name'][$i])) {
          $count++;
          $timg_name = $_FILES['file']['name'][$i];
          $temp_var = explode(".", strtolower($timg_name));
          //$temp_count = rand(10,10000);
          $timage_ext = end($temp_var);
          $timage_name_new = $temp_var[0] . '_' . $project_id . '_' . $count . "." . $timage_ext;
          //$timage_name_new = "file_".$quotation_enquiry_id.'_'.$count.".".$timage_ext; 
          $img_data['file_title'] = $file_title[$i];
          $img_data['project_id'] = $project_id;
          $img_data['file_name'] = $timage_name_new;
          $imginsertStatus = $this->Common_Model->add_operation(array('table' => 'admin_user_file', 'data' => $img_data));
          if ($imginsertStatus > 0) {
            move_uploaded_file($_FILES['file']['tmp_name'][$i], _uploaded_temp_files_ . "project_file/" . $timage_name_new);
            $logo_file_name = $timage_name_new;
          }
        }
      }
    }
  }






  function logout()
  {
    $this->unset_only();
    $this->session->set_flashdata('alert_message', '<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fas fa-check"></i> You Are Successfully Logout.
		</div>');
    $this->session->unset_userdata('sess_psts_uid');
    REDIRECT(MAINSITE_Admin . 'login');
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
