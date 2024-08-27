<?php
defined('BASEPATH') or exit('No direct script access allowed');

$ark_root = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
$ark_root .= "://" . $_SERVER['HTTP_HOST'];
$ark_root .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

define('__email_user_id__', "");
define('__email_user_password__', "");
define('__fromemail__', "clientnoreply@webdesigncompanybangalore.com");
define('__fromemailpassword__', "Myworld@123#");


define('_switch_google_ecom_', 0);

define('__delivery_api__', $ark_root . "/elivery/");

define('_project_name_', "Steel Age Building System");
define('_project_complete_name_', "Steel Age Building System");
define('_brand_name_', "SABS");
define('_project_address_', "
#34 (Old NO 25), 1st Main Road, Shakambri Nagar, JP Nagar 1st Phase, Bangalore-560078");
define('_project_contact_', "+91 8026645137");
define('_project_contact2_', "+91 9717730426");
define('_project_contact_without_space_', "+918026645137");
define('_project_contact_whatsapp_', "+91 9717730426");
define('_project_contact_whatsapp_without_space_', "+919392199595");
define('_project_contact_whatsapp_message_', "Welcome to 
Steel Age Building System");
define('_project_email_', "info@steelagebuildingsystem.com");
define('__adminemail__', "info@steelagebuildingsystem.com");
define('__adminsms__', "919392199595");  // for Register
define('_project_web_', "www.steelagebuildingsystem.com");
define('__order_initial__', "SABS");
define('_SMS_BRAND_', "steelagebuildingsystem.com");
define('__GSTIN__', "36AKRPG7758C2ZS");
define('_FACEBOOK_', "https://www.facebook.com/profile.php?id=100069220293490&mibextid=LQQJ4d");
define('_INSTAGRAM_', "https://instagram.com/annadatha.rythusevakendram?utm_source=qr");
define('_TWITTER_', "");
define('_YOUTUBE_', "https://youtube.com/@annadatha_farmer?si=G2mHlloY4qTbuUsd");
define('_PINTEREST_', "");
define('_LINKEDIN_', "");
define('_gtag_ptoduct_list_', "");


//local recaptcha
define('_google_recaptcha_site_key_', "6LezxwUqAAAAAC7iAfqFV-2G8Q6upDtpVxHnTKQx");
define('_google_recaptcha_secret_key_', "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe");
define('_mainsite_host_', "localhost");

//live recaptcha
// define('_google_recaptcha_site_key_', "6LfcbnkkAAAAADsjXc-d6lucEyYImxpJElTIp25z");
// define('_google_recaptcha_secret_key_', "6LfcbnkkAAAAAHf1IwPu6tRNdlC_KXggE4nQQnqY");
// define('_mainsite_host_', "steelagebuildingsystem.com");



//mail-smtp
define('_smtp_username_', "clientnoreply@webdesigncompanybangalore.com");
define('_smtp_password_', "Myworld@123#");
define('_smtp_from_email_', "clientnoreply@webdesigncompanybangalore.com");
define('_smtp_from_name_', _project_complete_name_);
define('_smtp_from_address_', _project_complete_name_);
define('_smtp_add_bcc_', "abhishek.khandelwal@marswebsolution.com");
define('_smtp_host_', "p3plzcpnl506980.prod.phx3.secureserver.net");
define('_smtp_port_', 465);
define('_smtp_to_email_for_enquiry_', "ramkumarsgurav@gmail.com");

define('__gtag_ptoduct_list__', "");
define('__free_shipping_above__', "499");
define('MAINSITE', $ark_root);
define('MAINSITE_Admin', $ark_root . "secureRegions/");
define('_access_denied_', $ark_root . "secureRegions/wam/access_denied");

define('IMAGE', $ark_root . "assets/front/images/");
define('IMAGE_TEMP', $ark_root);
define('CSS', $ark_root . "assets/front/css/");
define('JS', $ark_root . "assets/front/js/");

define('__scriptFilePath__', "assets/front/");  // for login

define('__const_country_id__', "1");
define('_uploaded_files_', $ark_root . "assets/uploads/");
define('_uploaded_temp_files_', "assets/uploads/");
define('__contactUs__', "contact-us");  // for Contact Us
define('__logout__', "logout");
define('__signup__', "sign-up");
define('__login__', "Login");
define('__forgotPassword__', "forgot-password");  // for forgot Password
define('__changePassword__', "change-password");  // for Change Password
define('__removeCoupon__', "remove-coupon");

define('__orderFail__', "order-fail");  // for Order Failure
define('__orderAbort__', "order-abort");  // for Order Abort
define('__orderSuccess__', "order-success");  // for Order Success
define('__shippingAddress__', "shipping-address");  // for Shipping Address
define('__reviewRatings__', "ratings-reviews");
define('__profileGSTInformation__', "personal-gst-information");  // for Profile Info

define('__featuredProducts__', "featured-products");
define('__bestSellers__', "best-sellers");
define('__whatsNew__', "whats-new");
define('__cart__', "viewcart");  // for My Cart
define('__all_category__', "all-categories");
define('__wishlist__', "wishlist");  // for Wishlist
define('__payment__', "checkout");  // for payment
define('__paymentProcess__', "payment-process");  // for Payment Process
define('__privacy_policy__', "privacy-policy");  // for privacy-policy
define('__terms_conditions__', "terms-conditions");  // for privacy-policy
define('__dashboard__', "dashboard");  // for User Dashboard
define('__orderDetails__', "order-details");  // for Order Details
define('__ReOrder__', "re-order");  // for Order Details
define('__orderHistory__', "order-history");  // for Order History
define('__orderInvoice__', "order-invoice");  // for Order Invoice
define('__orderStatus__', "order-status");  // for Order Invoice




define('__from_email__', "noreply@steelagebuildingsystem.com");


define('_lte_files_', $ark_root . "assets/admin/lte/");
define('_admin_files_', $ark_root . "assets/admin/");
define('_image_files_', $ark_root . "assets/front/images/");
define('_all_pagination_', "999999999");

define('__thanks__', "thanks");  // for Register

define('_summernote_', "toolbar: [
    ['style', ['style']],
    ['font', ['bold', 'italic', 'underline', 'clear']],
    ['fontname', ['fontname', 'fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['table', ['table']],
    ['view', ['fullscreen', 'codeview']]
  ]");



defined('__PG_MERCHANT_KEY__') or define('__PG_MERCHANT_KEY__', '0KEWA850BU');
defined('__PG_SALT__') or define('__PG_SALT__', 'E28O3BINEE');
defined('__PG_ENV__') or define('__PG_ENV__', 'prod');  // prod  test
define('__app_is_sell_local__', "");
define('__is_location_wise_product__', "");
define('__allCategories__', "");
/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE') or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ') or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS') or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
