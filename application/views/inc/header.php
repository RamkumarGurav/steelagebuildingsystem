<?php
$CI =& get_instance();
if (empty($meta_title)) {
   $meta_title = _project_name_;
}

if (empty($meta_description)) {
   $meta_description = _project_name_;
}

if (empty($meta_keywords)) {
   $meta_keywords = _project_name_;
}

if (empty($meta_others)) {
   $meta_others = "";
}

// Get the current URL segment to determine the active menu item
$current_url = $CI->uri->segment(1); // Change the segment number as per your URL structure

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <base href="<?= base_url() ?>">
   <title><?= $meta_title ?></title>
   <meta name="description" content="<?= $meta_description ?>">
   <?php if (!empty($canonical_url)) {
      echo '<link rel="canonical" href="' . $canonical_url . '"  >';
   } ?>

   <?php if (!empty($og_script)) {
      echo $og_script;
   } ?>
   <meta name="keywords" content="<?= $meta_keywords ?>">
   <meta name="GOOGLEBOT" content="index,follow" />
   <meta name="distribution" content="global" />
   <link rel="shortcut icon" type="image/x-icon" href="<?= IMAGE ?>favicon.ico">



   <link href="<?= CSS ?>custome.min.css" rel="stylesheet">
   <link href="<?= CSS ?>bootstrap.min.css" rel="stylesheet prefetch">
   <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
      rel="stylesheet">
   <link href="<?= CSS ?>font-awesome.min.css" rel="stylesheet prefetch">
   <link href="<?= CSS ?>mymenu.min.css" rel="stylesheet">

   <?php if (!empty($direct_css)) {
      foreach ($direct_css as $dcss) {
         echo '<link rel="stylesheet" href="' . $dcss . '"  crossorigin="anonymous">';
      }
   } ?>
   <?php if (!empty($css)) {
      foreach ($css as $css) {
         echo '<link rel="stylesheet" href="' . CSS . $css . '"  crossorigin="anonymous">';
      }
   } ?>

   <link href="<?= CSS ?>style.min.css" rel="stylesheet">
   <link href="<?= CSS ?>responsive.min.css" rel="stylesheet">
   <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T7VVM7WV4J"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-T7VVM7WV4J');
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NK6CVKFB');</script>
<!-- End Google Tag Manager -->
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NK6CVKFB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
   <div class="container-fluid subnav">
      <div class="container pdngnone ctnrwdtnn">
         <div class="col-md-7 dspl767nn">
            <ul class="navdtail-sec">
               <li><i class="fa fa-phone"></i> Call us: +91 80 26645137 / 97177 30426</li>
               <li><i class="fa fa-envelope"></i> Email us: info@steelagebuildingsystem.com</li>
            </ul>
         </div>
         <div class="col-md-5">
            <div class="mysocial text-right">
               <a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
               <a class="btn btn-social-icon btn-google-plus"><i class="fa fa-google-plus"></i></a>
               <a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
               <a class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
            </div>
         </div>
      </div>
   </div>

   <div class="container-fluid pdngnone mynavbar">
      <!-- Start Navigation -->
      <nav class="navbar navbar-default bootsnav">
         <div class="container pdngnone">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                  <i class="fa fa-bars"></i>
               </button>
               <a class="navbar-brand" href="<?= MAINSITE ?>"><img src="<?= IMAGE ?>logo.png"
                     class="logow img-responsive" alt=""></a>
            </div>
            <!-- End Header Navigation -->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pdngnone" id="navbar-menu">
               <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                  <li><a class="<?= ($current_url == '') ? 'activea' : '' ?>" href="<?= MAINSITE ?>">HOME</a></li>
                  <li class="dropdown"><a
                        class="dropdown-toggle <?= ($current_url == 'about-us' || $current_url == 'mission-values' || $current_url == 'infrastructure') ? 'activea' : '' ?>"
                        data-toggle="dropdown">About Us</a>
                     <ul class="dropdown-menu pull-right">
                        <li><a href="about-us">Company Profile</a></li>
                        <li><a href="mission-values">Mission/Vision/Values</a></li>
                        <li><a href="infrastructure">Infrastructure</a></li>
                     </ul>
                  </li>
                  <li><a class="<?= ($current_url == 'services') ? 'activea' : '' ?>" href="services">Services</a></li>
                  <li class="dropdown"><a
                        class="dropdown-toggle <?= ($current_url == 'completed-projects' || $current_url == 'ongoing-projects') ? 'activea' : '' ?>"
                        data-toggle="dropdown">Projects</a>
                     <ul class="dropdown-menu pull-right">
                        <?php if (!empty($completed_project_home_data_count)): ?>
                           <li><a href="completed-projects">Completed Projects</a></li>
                        <?php endif; ?>
                        <?php if (!empty($ongoing_project_home_data_count)): ?>
                           <li><a href="ongoing-projects">Ongoing Projects</a></li>
                        <?php endif; ?>
                     </ul>
                  </li>
                  <li><a class="<?= ($current_url == 'clients') ? 'activea' : '' ?>" href="clients">Clients</a></li>
                  <li><a class="<?= ($current_url == 'careers') ? 'activea' : '' ?>" href="careers">Careers</a></li>
                  <li><a class="<?= ($current_url == 'contact-us') ? 'activea' : '' ?>" href="contact-us">Contact Us</a>
                  </li>
               </ul>
            </div><!-- /.navbar-collapse -->
         </div>
      </nav>
      <!-- End Navigation -->
   </div>