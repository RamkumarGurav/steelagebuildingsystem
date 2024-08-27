<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');


include_once('Main.php');
class User extends Main
{

  public function __construct()
  {
    parent::__construct();

    //models
    $this->load->model('Common_Model');
    $this->load->model('User_Model');


    //headers
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");

  }




  public function generate_sitemap()
  {
    // Load the URL helper
    $this->load->helper('url');

    $this->data['url_data'] = array(
      array("slug_url" => "", "priority" => 1),
      array("slug_url" => "about-us", "priority" => 1),
      array("slug_url" => "mission-values", "priority" => 0.7),
      array("slug_url" => "services", "priority" => 1),
      array("slug_url" => "infrastructure", "priority" => 0.8),
      array("slug_url" => "contact-us", "priority" => 0.5),
      array("slug_url" => "careers", "priority" => 0.5),
      array("slug_url" => "clients", "priority" => 0.6),
    );



    $ongoing_project_data = $this->Common_Model->getData(array(
      "select" => "slug_url,updated_on",
      "from" => "project",
      "where" => "project_variant=1 and status=1"
    ));

    if (!empty($ongoing_project_data)) {
      $arr1 = array("slug_url" => "ongoing-projects", "priority" => 1);
      array_push($this->data['url_data'], $arr1);
    }


    $ongoing_product_data_product = $this->Common_Model->extract_column_values_to_array_for_sitemap(array(
      "data" => $ongoing_project_data,
      "column_name" => "slug_url",
      "prefix" => "ongoing-projects/",
      "priority" => 0.8,
    ));

    $completed_project_data = $this->Common_Model->getData(array(
      "select" => "slug_url,updated_on",
      "from" => "project",
      "where" => "project_variant=2 and status=1"
    ));

    if (!empty($completed_project_data)) {
      $arr1 = array("slug_url" => "completed-projects", "priority" => 1);
      array_push($this->data['url_data'], $arr1);
    }


    $completed_product_data_product = $this->Common_Model->extract_column_values_to_array_for_sitemap(array(
      "data" => $completed_project_data,
      "column_name" => "slug_url",
      "prefix" => "completed-projects/",
      "priority" => 0.8,
    ));






    $this->data['url_data'] = array_merge($this->data['url_data'], $ongoing_product_data_product);
    $this->data['url_data'] = array_merge($this->data['url_data'], $completed_product_data_product);

    // Generate the XML content
    $xml_content = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

    foreach ($this->data['url_data'] as $url) {
      $loc = MAINSITE . $url['slug_url'];
      $xml_content .= '  <url>' . PHP_EOL;
      $xml_content .= '    <loc>' . $loc . '</loc>' . PHP_EOL;
      $xml_content .= '    <priority>' . $url['priority'] . '</priority>' . PHP_EOL;
      $xml_content .= '  </url>' . PHP_EOL;
    }

    $xml_content .= '</urlset>' . PHP_EOL;

    // Define the path where the sitemap.xml will be saved in the views folder
    $file_path = FCPATH . 'sitemap.xml';

    // Save the XML content to the file
    return file_put_contents($file_path, $xml_content);
  }





  public function index()
  {



    $this->data['meta_title'] = _project_name_;
    $this->data['meta_description'] = _project_name_;
    $this->data['meta_keywords'] = _project_name_;
    $this->data['meta_others'] = "";



    $this->data['completed_project_home_data'] = $this->User_Model->get_project([
      "project_variant" => 2,
      "is_home_display" => 1,
      "sort_by_home_position" => 1,
      "details" => 1
    ]);

    $this->data['ongoing_project_home_data'] = $this->User_Model->get_project([
      "project_variant" => 1,
      "is_home_display" => 1,
      "sort_by_home_position" => 1,
      "details" => 1
    ]);



    $this->data['css'] = array(
      "img-hover.min.css",
      "custome2.min.css",
      "parsley_custom_style.min.css",

    );



    $this->data['direct_js'] = array(
      "https://www.google.com/recaptcha/api.js",

    );


    $this->data['js'] = array(
      "owl.carousel.min.js",
      "home.min.js",
      "jquery-3.2.1.min.js",
      "parsley.min.js",
      "parsley_form.min.js"
    );


    $this->data['canonical_url'] = MAINSITE;
    $this->data['og_script'] = '
    <script type="application/ld+json">
{
"@context": "http://www.schema.org",
"@type": "Services",
"name": "Steel Age Building System",
"alternateName": "Steel Age Building System",
"url": "https://steelagebuildingsystem.com/"
}
</script>
<script type="application/ld+json">
{
"@context": "http://www.schema.org",
"@type": "Services",
"brand": "Steel Age Building System",
"name": "Steel Age Building System is specialized in the field of design , engineering , fabrication , surface preperation & protection installation and erections of all kind of steel structures.",
"image": "https://steelagebuildingsystem.com/assets/front/images/logo.png",
"description": "Steel Age Building System is mainly engaged in fabrication and erection of Pre- Engineered Building (PEB), Structural steel system, Roofing & cladding commercial complex structure work, overhead bridge, Industrial buildings etc.",
  "aggregateRating": {
    "@type": "Rating",
    "ratingValue": "4.8",
    "reviewCount": "2300"
  }
}
</script>
 
<meta property="og:type" content= "Steel Age Building System is specialized in the field of design , engineering , fabrication , surface preperation & protection installation and erections of all kind of steel structures."/>
<meta property="og:url" content= "https://steelagebuildingsystem.com"/>
<meta property="og:site_name" content="Steel Age Building System"/>
<meta property="og:title" content= "Steel Age Building System is specialized in the field of design , engineering , fabrication , surface preperation & protection installation and erections of all kind of steel structures."/>
<meta property="og:author" content= "Steel Age Building System"/>
<meta property="og:image"content="https://steelagebuildingsystem.com/assets/front/images/logo.png"/>
<meta property="og:locale" content="en_US">
<meta property="og:description" content= "Steel Age Building System is mainly engaged in fabrication and erection of Pre- Engineered Building (PEB), Structural steel system, Roofing & cladding commercial complex structure work, overhead bridge, Industrial buildings etc."/>
    ';


    parent::getHeader('header', $this->data);
    $this->load->view('home', $this->data);
    parent::getFooter('footer', $this->data);
  }


  public function ongoing_projects()
  {
    $this->data['meta_title'] = _project_name_ . " - Ongoing Projects";
    $this->data['meta_description'] = _project_name_ . " - Ongoing Projects";
    $this->data['meta_keywords'] = _project_name_ . " - Ongoing Projects";
    $this->data['meta_others'] = "";

    $this->data['project_data'] = $this->User_Model->get_project([
      "project_variant" => 1,
      "details" => 1
    ]);




    $this->data['css'] = array("custome2.min.css", );//, 'js/all-scripts.js'


    $this->data['canonical_url'] = MAINSITE . "ongoing-projects";

    parent::getHeader('header', $this->data);
    $this->load->view('ongoing_projects', $this->data);
    parent::getFooter('footer', $this->data);
  }


  public function ongoing_projects_details($slug)
  {



    $this->data['project_data'] = $this->User_Model->get_project([
      "project_variant" => 1,
      "details" => 1
    ]);
    $this->data['single_project_data'] = $this->User_Model->get_project([
      "project_variant" => 1,
      "slug_url" => $slug,
      "details" => 1
    ]);

    if (empty($this->data['single_project_data'])) {
      $this->load->view('pageNotFound', $this->data);
    } else {
      $this->data['single_project_data'] = $this->data['single_project_data'][0];

      $this->data['meta_title'] = _project_name_ . " - " . $this->data['single_project_data']->name;
      $this->data['meta_description'] = _project_name_ . " - Ongoing Projects";
      $this->data['meta_keywords'] = _project_name_ . " - Ongoing Projects";
      $this->data['meta_others'] = "";



      $this->data['css'] = array("custome2.min.css", );//, 'js/all-scripts.js'
      $this->data['direct_css'] = array("https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css");//, 'js/all-scripts.js'
      $this->data['js'] = array("owl.carousel.min.js", "wow.min.js", "index.min.js", "lightbox-plus-jquery.min.js");



      $this->data['canonical_url'] = MAINSITE . "ongoing-projects/" . $slug;


      parent::getHeader('header', $this->data);
      $this->load->view('ongoing_projects_details', $this->data);
      parent::getFooter('footer', $this->data);
    }


  }



  public function completed_projects()
  {
    $this->data['meta_title'] = _project_name_ . " - Completed Projects";
    $this->data['meta_description'] = _project_name_ . " - Completed Projects";
    $this->data['meta_keywords'] = _project_name_ . " - Completed Projects";
    $this->data['meta_others'] = "";

    $this->data['project_data'] = $this->User_Model->get_project([
      "project_variant" => 2,
      "details" => 1
    ]);




    $this->data['css'] = array(
      "custome2.min.css",
    );


    $this->data['canonical_url'] = MAINSITE . "completed_projects";

    parent::getHeader('header', $this->data);
    $this->load->view('completed_projects', $this->data);
    parent::getFooter('footer', $this->data);
  }


  public function completed_projects_details($slug)
  {



    $this->data['project_data'] = $this->User_Model->get_project([
      "project_variant" => 2,
      "details" => 1
    ]);
    $this->data['single_project_data'] = $this->User_Model->get_project([
      "project_variant" => 2,
      "slug_url" => $slug,
      "details" => 1
    ]);

    if (empty($this->data['single_project_data'])) {
      $this->load->view('pageNotFound', $this->data);
    } else {
      $this->data['single_project_data'] = $this->data['single_project_data'][0];

      $this->data['meta_title'] = _project_name_ . " - " . $this->data['single_project_data']->name;
      $this->data['meta_description'] = _project_name_ . " - Completed Projects";
      $this->data['meta_keywords'] = _project_name_ . " - Completed Projects";
      $this->data['meta_others'] = "";






      $this->data['css'] = array("custome2.min.css", );//, 'js/all-scripts.js'
      $this->data['direct_css'] = array("https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css");//, 'js/all-scripts.js'
      $this->data['js'] = array("owl.carousel.min.js", "wow.min.js", "index.min.js", "lightbox-plus-jquery.min.js");

      $this->data['canonical_url'] = MAINSITE . "completed-projects/" . $slug;

      parent::getHeader('header', $this->data);
      $this->load->view('completed_projects_details', $this->data);
      parent::getFooter('footer', $this->data);
    }


  }



  function host_captcha_validation()
  {
    if (true) {
      if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
        $link = $_SERVER['HTTP_REFERER'];
        $link_array = explode('/', $link);
        $page_action = end($link_array);
        $parts = parse_url($link);
        $page_host = $parts['host'];
        if (strpos($parts["host"], 'www.') !== false) { //echo 'yes<br>';
          $parts1 = explode('www.', $parts["host"]);
          $page_host = $parts1[1];
        }

        // $host='steelagebuildingsystem.com';
        $host = _mainsite_host_;

        if ($page_host != $host) {
          echo '<script language="javascript">';
          echo 'alert("Host validation failed! Please try again.")';
          echo '</script>';
          echo "<script>location.href='error'</script>";
          die();
        }
      } else {
        echo '<script language="javascript">';
        echo 'alert("Error: HTTP_REFERER failed! Please try again.")';
        echo '</script>';
        echo "<script>location.href='error'</script>";
        die();
      }

      $request = '';


      if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $param['secret'] = _google_recaptcha_secret_key_;
        $param['response'] = $_POST['g-recaptcha-response'];
        $param['remoteip'] = $_SERVER['REMOTE_ADDR'];
        foreach ($param as $key => $val) {
          $request .= $key . "=" . $val;
          $request .= "&";
        }
        $request = substr($request, 0, strlen($request) - 1);
        $url = "https://www.google.com/recaptcha/api/siteverify?" . $request;
        //echo $url; exit;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result_data = curl_exec($ch);
        if (curl_exec($ch) === false) {
          $error_info = curl_error($ch);
        }
        curl_close($ch);

        $response = json_decode($result_data);
        if ($response->success != 1) {
          echo '<script language="javascript">';
          echo 'alert("google recaptcha validation failed! Please try again.")';
          echo '</script>';
          echo "<script>location.href='error'</script>";
          die();
        }
      } else {
        echo '<script language="javascript">';
        echo 'alert("Error: google recaptcha post validation failed! Please try again.")';
        echo '</script>';
        echo "<script>location.href='error'</script>";
        die();
      }
    }

  }


  function do_enquiry()
  {


    date_default_timezone_set('Asia/Kolkata');
    $timestamp = date("Y-m-d H:i:s");

    $this->host_captcha_validation();

    // $attachment_file_name = "";
    // $attachment_file = "";
    //exit;
    //echo "2";
    if (
      !empty($_POST['enq_type']) && !empty($_POST['name_contact_us']) && !empty($_POST['email_contact_us']) && !empty($_POST['contact_contact_us'])
      && !empty($_POST['qualification_contact_us']) && !empty($_POST['appliedfor_contact_us']) && !empty($_POST['experience_contact_us']) && $_SERVER['REQUEST_METHOD'] == 'POST'
    ) {

      $userfile = $attachment_file_name = $attachment_file = '';


      $full_name = '';
      if (isset($_POST['name_contact_us']) && !empty($_POST['name_contact_us'])) {
        $enquiry_input_data_career_equiry['name'] = $full_name = trim($_POST['name_contact_us']);
      }

      $pagelink = '';
      if (isset($_POST['pagelink']) && !empty($_POST['pagelink'])) {
        $enquiry_input_data_career_equiry['page_link'] = $pagelink = trim($_POST['pagelink']);
      }

      $email = '';
      if (isset($_POST['email_contact_us']) && !empty($_POST['email_contact_us'])) {
        $enquiry_input_data_career_equiry['email'] = $email = trim($_POST['email_contact_us']);
      }

      $contact = '';
      if (isset($_POST['contact_contact_us']) && !empty($_POST['contact_contact_us'])) {
        $enquiry_input_data_career_equiry['contactno'] = $contact = trim($_POST['contact_contact_us']);
      }

      $qualification = '';
      if (isset($_POST['qualification_contact_us']) && !empty($_POST['qualification_contact_us'])) {
        $enquiry_input_data_career_equiry['qualification'] = $qualification = trim($_POST['qualification_contact_us']);
      }

      $appliedfor = '';
      if (isset($_POST['appliedfor_contact_us']) && !empty($_POST['appliedfor_contact_us'])) {
        $enquiry_input_data_career_equiry['appliedfor'] = $appliedfor = trim($_POST['appliedfor_contact_us']);
      }

      $experience = '';
      if (isset($_POST['experience_contact_us']) && !empty($_POST['experience_contact_us'])) {
        $enquiry_input_data_career_equiry['experience'] = $experience = trim($_POST['experience_contact_us']);
      }

      $enquiry_input_data_career_equiry['ip_address'] = $ip_address = $this->Common_Model->get_client_ip();



      if (isset($_FILES['userfile_contact_us']['name']) && !empty($_FILES['userfile_contact_us']['name']))
        $userfile = $_FILES['userfile_contact_us']['name'];
      if (!empty($userfile)) {
        $temp_var = explode(".", strtolower($userfile));
        $timage_ext = end($temp_var);

        $temp_name = 'RESUME-';
        if (!empty($full_name)) {
          $temp_full_name = str_replace(' ', '_', $full_name);
          $temp_name = ucwords($temp_full_name) . '-RESUME-';
        }

        // echo "UploadedFiles - " . _uploaded_temp_files_;
        $attachment_file_name = $temp_name . $this->n_digit_random(4) . '.' . $timage_ext;
        // echo "attachment_file_name : $attachment_file_name";
        $target_folder_name = "career_resume";
        if (!is_dir(_uploaded_temp_files_ . $target_folder_name)) {
          mkdir(_uploaded_temp_files_ . './' . $target_folder_name, 0777, TRUE);

        }


        // move_uploaded_file($_FILES['userfile_contact_us']['tmp_name'], "E:/xampp/htdocs/xampp/MARS/steelagebuildingsystem/assets/uploads/" . $attachment_file_name);

        move_uploaded_file($_FILES['userfile_contact_us']['tmp_name'], _uploaded_temp_files_ . $target_folder_name . "/" . $attachment_file_name);
        $attachment_file = _uploaded_temp_files_ . $target_folder_name . "/" . $attachment_file_name;

        $enquiry_input_data_career_equiry["resume_file"] = $attachment_file_name;
      }

      // $ip_address = $this->Common_Model->get_client_ip();
      $date = date('D dS M, Y h:i a');

      $mailMessage = file_get_contents(APPPATH . 'mailer/career.html');
      $mailMessage = preg_replace('/\\\\/', '', $mailMessage); //Strip backslashes
      $mailMessage = str_replace("#enq_date#", stripslashes($date), $mailMessage);
      $mailMessage = str_replace("#name#", stripslashes($full_name), $mailMessage);
      $mailMessage = str_replace("#contact#", stripslashes($contact), $mailMessage);
      $mailMessage = str_replace("#qualification#", stripslashes($qualification), $mailMessage);
      $mailMessage = str_replace("#appliedfor#", stripslashes($appliedfor), $mailMessage);
      $mailMessage = str_replace("#experience#", stripslashes($experience), $mailMessage);
      $mailMessage = str_replace("#email#", stripslashes($email), $mailMessage);
      $mailMessage = str_replace("#ip_address#", stripslashes($ip_address), $mailMessage);
      $mailMessage = str_replace("#page_url#", stripslashes($pagelink), $mailMessage);
      if ($pagelink == "home_page") {
        $mailMessage = str_replace("#page_url#", stripslashes(""), $mailMessage);
        $mailMessage = str_replace("#page_url_name#", stripslashes("home_page"), $mailMessage);
      } else {
        $mailMessage = str_replace("#page_url#", stripslashes($pagelink), $mailMessage);
        $mailMessage = str_replace("#page_url_name#", stripslashes($pagelink), $mailMessage);
      }
      $mailMessage = str_replace("#mainsite#", MAINSITE, $mailMessage);
      $mailMessage = str_replace("#company_name#", _project_complete_name_, $mailMessage);


      $to_name = _project_complete_name_;
      $subject = "New Enquiry From " . _project_web_;
      if ($_POST['enq_type'] == 'career') {
        $subject = "New Career Contact Enquiry From" . _project_web_;
      }
      $to = _smtp_to_email_for_enquiry_;

      $mail_status = $this->Common_Model->send_mail(array(
        "template" => $mailMessage,
        "subject" => $subject,
        "to" => "$to",
        "name" => $to_name,
        "attachment_file" => $attachment_file
      ));




      if (!empty($mail_status)) {
        if (!empty($enquiry_input_data_career_equiry)) {
          $insertStatus = $this->Common_Model->add_operation(array('table' => 'career_enquiry', 'data' => $enquiry_input_data_career_equiry));

        }

        $_SESSION['is_thank_you_page'] = 1;
        $location = MAINSITE . 'thank-you';

        echo "<script>location.href='{$location}'</script>";
        die();
      } else {
        echo "<script>location.href='error'</script>";
        die();
      }





    } else if (!empty($_POST['enq_type']) && !empty($_POST['name_contact_us']) && !empty($_POST['email_contact_us']) && !empty($_POST['contact_contact_us']) && !empty($_POST['message_contact_us']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
      //echo "2";



      if (isset($_POST['message_contact_us']) && !empty($_POST['message_contact_us'])) {
        if (preg_match('/http|www/i', $_POST['message_contact_us'])) {
          echo '<script language="javascript">';
          echo 'alert("Something Went Wrong! Please try again.")';
          echo '</script>';
          echo "<script>location.href='error'</script>";
          die();
        }
      }




      $full_name = '';
      if (isset($_POST['name_contact_us']) && !empty($_POST['name_contact_us'])) {
        $enquiry_input_data_contact_us['name'] = $full_name = trim($_POST['name_contact_us']);
      }

      $pagelink = '';
      if (isset($_POST['pagelink']) && !empty($_POST['pagelink'])) {
        $enquiry_input_data_contact_us['page_link'] = $pagelink = trim($_POST['pagelink']);
      }

      $email = '';
      if (isset($_POST['email_contact_us']) && !empty($_POST['email_contact_us'])) {
        $enquiry_input_data_contact_us['email'] = $email = trim($_POST['email_contact_us']);
      }

      $contact = '';
      if (isset($_POST['contact_contact_us']) && !empty($_POST['contact_contact_us'])) {
        $enquiry_input_data_contact_us['contactno'] = $contact = trim($_POST['contact_contact_us']);
      }

      $message = '';
      if (isset($_POST['message_contact_us']) && !empty($_POST['message_contact_us'])) {
        $enquiry_input_data_contact_us['message'] = $message = trim($_POST['message_contact_us']);
      }
      $enquiry_input_data_contact_us['ip_address'] = $ip_address = $this->Common_Model->get_client_ip();

      $date = date('D dS M, Y h:i a');

      $mailMessage = file_get_contents(APPPATH . 'mailer/enquiry.html');
      $mailMessage = preg_replace('/\\\\/', '', $mailMessage); //Strip backslashes
      $mailMessage = str_replace("#enq_date#", stripslashes($date), $mailMessage);
      $mailMessage = str_replace("#name#", stripslashes($full_name), $mailMessage);
      $mailMessage = str_replace("#contact#", stripslashes($contact), $mailMessage);
      $mailMessage = str_replace("#email#", stripslashes($email), $mailMessage);
      $mailMessage = str_replace("#ip_address#", stripslashes($ip_address), $mailMessage);
      $mailMessage = str_replace("#message#", stripslashes($message), $mailMessage);
      if ($pagelink == "home_page") {
        $mailMessage = str_replace("#page_url#", stripslashes(""), $mailMessage);
        $mailMessage = str_replace("#page_url_name#", stripslashes("home_page"), $mailMessage);

      } else {

        $mailMessage = str_replace("#page_url#", stripslashes($pagelink), $mailMessage);
        $mailMessage = str_replace("#page_url_name#", stripslashes($pagelink), $mailMessage);
      }
      $mailMessage = str_replace("#mainsite#", MAINSITE, $mailMessage);
      $mailMessage = str_replace("#company_name#", _project_complete_name_, $mailMessage);

      $to_name = _project_complete_name_;
      $subject = "New Enquiry From " . _project_web_;
      if ($_POST['enq_type'] == 'career') {
        $subject = "New Career Contact Enquiry From" . _project_web_;
      }
      $to = _smtp_to_email_for_enquiry_;

      $mail_status = $this->Common_Model->send_mail(array(
        "template" => $mailMessage,
        "subject" => $subject,
        "to" => "$to",
        "name" => $to_name,
      ));

      if (!empty($mail_status)) {
        if (!empty($enquiry_input_data_contact_us)) {
          $insertStatus = $this->Common_Model->add_operation(array('table' => 'enquiry', 'data' => $enquiry_input_data_contact_us));

        }

        $_SESSION['is_thank_you_page'] = 1;
        $location = MAINSITE . 'thank-you';

        echo "<script>location.href='{$location}'</script>";
        die();
      } else {
        echo "<script>location.href='error'</script>";
        die();
      }




    } else {
      echo "<script>location.href='error'</script>";
      die();
    }






  }






  function n_digit_random($digits)
  {
    return rand(pow(10, $digits - 1) - 1, pow(10, $digits) - 1);
  }










  function upload_any_file($table_name, $id_column, $id, $input_name, $target_column, $prefix, $target_folder_name)
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







  public function infrastructure()
  {
    $this->data['meta_title'] = _project_name_ . " - Infrastructure";
    $this->data['meta_description'] = _project_name_ . " - Infrastructure";
    $this->data['meta_keywords'] = _project_name_ . " - Infrastructure";
    $this->data['meta_others'] = "";


    $this->data['css'] = array("foundation.min.css", "style.min.css");


    $this->data['canonical_url'] = MAINSITE . "infrastructure";

    parent::getHeader('header', $this->data);
    $this->load->view('infrastructure', $this->data);
    parent::getFooter('footer', $this->data);
  }









  public function mission_values()
  {
    $this->data['meta_title'] = _project_name_ . " - Mission Values";
    $this->data['meta_description'] = _project_name_ . " - Mission Values";
    $this->data['meta_keywords'] = _project_name_ . " - Mission Values";
    $this->data['meta_others'] = "";

    $this->data['css'] = array("foundation.min.css", "style.min.css");
    $this->data['js'] = array("modernizr");

    $this->data['canonical_url'] = MAINSITE . "mission-values";

    parent::getHeader('header', $this->data);
    $this->load->view('mission_values', $this->data);
    parent::getFooter('footer', $this->data);
  }



  public function clients()
  {
    $this->data['meta_title'] = _project_name_ . " - Clients";
    $this->data['meta_description'] = _project_name_ . " - Clients";
    $this->data['meta_keywords'] = _project_name_ . " - Clients";
    $this->data['meta_others'] = "";


    $this->data['canonical_url'] = MAINSITE . "clients";

    parent::getHeader('header', $this->data);
    $this->load->view('clients', $this->data);
    parent::getFooter('footer', $this->data);
  }



  public function about_us()
  {
    $this->data['meta_title'] = _project_name_ . " - About Us";
    $this->data['meta_description'] = _project_name_ . " - About Us";
    $this->data['meta_keywords'] = _project_name_ . " - About Us";
    $this->data['meta_others'] = "";




    $this->data['css'] = array("foundation.min.css", "style.min.css");
    $this->data['js'] = array("modernizr");

    $this->data['canonical_url'] = MAINSITE . "about-us";

    parent::getHeader('header', $this->data);
    $this->load->view('about_us', $this->data);
    parent::getFooter('footer', $this->data);
  }



  public function services()
  {
    $this->data['meta_title'] = _project_name_ . " - Services";
    $this->data['meta_description'] = _project_name_ . " - Services";
    $this->data['meta_keywords'] = _project_name_ . " - Services";
    $this->data['meta_others'] = "";


    $this->data['canonical_url'] = MAINSITE . "services";


    parent::getHeader('header', $this->data);
    $this->load->view('services', $this->data);
    parent::getFooter('footer', $this->data);
  }

  public function careers()
  {
    $this->data['meta_title'] = _project_name_ . " - Careers";
    $this->data['meta_description'] = _project_name_ . " - Careers";
    $this->data['meta_keywords'] = _project_name_ . " - Careers";
    $this->data['meta_others'] = "";



    $this->data['css'] = array("parsley_custom_style.min.css", );//, 'js/all-scripts.js'
    $this->data['direct_js'] = array("https://www.google.com/recaptcha/api.js");//, 'js/all-scripts.js'
    $this->data['js'] = array("jquery-3.2.1.min.js", "parsley.min.js", "parsley_form.min.js", );//, 'js/all-scripts.js'


    $this->data['canonical_url'] = MAINSITE . "careers";

    parent::getHeader('header', $this->data);
    $this->load->view('careers', $this->data);
    parent::getFooter('footer', $this->data);
  }

  public function contact_us()
  {
    $this->data['meta_title'] = _project_name_ . " - Contact Us";
    $this->data['meta_description'] = _project_name_ . " - Contact Us";
    $this->data['meta_keywords'] = _project_name_ . " - Contact Us";
    $this->data['meta_others'] = "";



    $this->data['css'] = array("parsley_custom_style.min.css", );//, 'js/all-scripts.js'
    $this->data['direct_js'] = array("https://www.google.com/recaptcha/api.js");//, 'js/all-scripts.js'
    $this->data['js'] = array("jquery-3.2.1.min.js", "parsley.min.js", "parsley_form.min.js", );//, 'js/all-scripts.js'



    $this->data['canonical_url'] = MAINSITE . "contact-us";
    $this->data['og_script'] = '
    <script type="application/ld+json">
{
"@context": "http://www.schema.org",
"@type": "Services",
"name": "Steel Age Building System",
"alternateName": "Steel Age Building System",
"url": "https://steelagebuildingsystem.com/contact-us"
}
</script>
<script type="application/ld+json">
{
"@context": "http://www.schema.org",
"@type": "Services",
"brand": "Steel Age Building System",
"name": "Steel Age Building System is specialized in the field of design , engineering , fabrication , surface preperation & protection installation and erections of all kind of steel structures.",
"image": "https://steelagebuildingsystem.com/assets/front/images/logo.png",
"description": "Steel Age Building System is mainly engaged in fabrication and erection of Pre- Engineered Building (PEB), Structural steel system, Roofing & cladding commercial complex structure work, overhead bridge, Industrial buildings etc.",
  "aggregateRating": {
    "@type": "Rating",
    "ratingValue": "4.8",
    "reviewCount": "2300"
  }
}
</script>

    <meta property="og:type" content= "Steel Age Building System is specialized in the field of design , engineering , fabrication , surface preperation & protection installation and erections of all kind of steel structures."/>
<meta property="og:url" content= "https://steelagebuildingsystem.com/contact-us"/>
<meta property="og:site_name" content="Steel Age Building System"/>
<meta property="og:title" content= "Steel Age Building System is specialized in the field of design , engineering , fabrication , surface preperation & protection installation and erections of all kind of steel structures."/>
<meta property="og:author" content= "Steel Age Building System"/>
<meta property="og:image"content="https://steelagebuildingsystem.com/assets/front/images/logo.png"/>
<meta property="og:locale" content="en_US">
<meta property="og:description" content= "Steel Age Building System is mainly engaged in fabrication and erection of Pre- Engineered Building (PEB), Structural steel system, Roofing & cladding commercial complex structure work, overhead bridge, Industrial buildings etc."/>
    ';
    parent::getHeader('header', $this->data);
    $this->load->view('contact_us', $this->data);
    parent::getFooter('footer', $this->data);
  }

  public function thank_you()
  {
    $this->data['meta_title'] = _project_name_ . " - Thank You";
    $this->data['meta_description'] = _project_name_ . " - Thank You";
    $this->data['meta_keywords'] = _project_name_ . " - Thank You";
    $this->data['meta_others'] = "";

    $this->data['canonical_url'] = MAINSITE . "thank-you";

    parent::getHeader('header', $this->data);
    $this->load->view('thank_you', $this->data);
    parent::getFooter('footer', $this->data);
  }


  public function test1()
  {
    $this->data['meta_title'] = _project_name_ . " - Thank You";
    $this->data['meta_description'] = _project_name_ . " - Thank You";
    $this->data['meta_keywords'] = _project_name_ . " - Thank You";
    $this->data['meta_others'] = "";

    $this->data['canonical_url'] = MAINSITE . "thank-you";

    parent::getHeader('header', $this->data);
    $this->load->view('test1', $this->data);
    parent::getFooter('footer', $this->data);
  }

  public function pageNotFound()
  {
    $this->data['meta_title'] = _project_name_ . " - Page Not Found";
    $this->data['meta_description'] = _project_name_ . " - Page Not Found";
    $this->data['meta_keywords'] = _project_name_ . " - Page Not Found";
    $this->data['meta_others'] = "";


    $this->load->view('pageNotFound', $this->data);
  }

  public function found404()
  {
    $this->data['meta_title'] = _project_name_ . " - 404 found";
    $this->data['meta_description'] = _project_name_ . " - 404 found";
    $this->data['meta_keywords'] = _project_name_ . " - 404 found";
    $this->data['meta_others'] = "";

    parent::getHeader('header', $this->data);
    $this->load->view('404found', $this->data);
    parent::getFooter('footer', $this->data);
  }

  public function error()
  {
    $this->data['meta_title'] = _project_name_ . " - Error";
    $this->data['meta_description'] = _project_name_ . " - Error";
    $this->data['meta_keywords'] = _project_name_ . " - Error";
    $this->data['meta_others'] = "";

    parent::getHeader('header', $this->data);
    $this->load->view('error', $this->data);
    parent::getFooter('footer', $this->data);
  }












}
