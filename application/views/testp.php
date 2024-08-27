<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Contact Us || Steel Age Building System</title>

  <!-- Bootstrap -->
  <link href="favicon.ico" rel="shortcut icon" type="x-image">
  <link href="<?= CSS ?>custome.css" rel="stylesheet">

  <link href="<?= CSS ?>bootstrap.min.css" rel="stylesheet">
  <link href="<?= CSS ?>font-awesome.min.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Montserrat:300,400,500,600,700|Open+Sans:400,600,700|Quicksand:400,500,700"
    rel="stylesheet">

  <link rel='stylesheet prefetch' href='<?= CSS ?>bootstrap.min.css'>
  <link rel="stylesheet" href="<?= CSS ?>img-hover.css">
  <link rel='stylesheet prefetch' href='<?= CSS ?>font-awesome.css'>
  <link rel="stylesheet" href="<?= CSS ?>mymenu.css">

  <link rel="stylesheet" href="<?= CSS ?>normalize.min.css">
  <link rel='stylesheet prefetch' href='<?= CSS ?>owl.carousel.min.css'>
  <link rel="stylesheet" href="<?= CSS ?>productsl.css">


  <link href="<?= CSS ?>responsive.css" rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
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
          <a class="navbar-brand" href="index.html"><img src="images/logo.png" class="logow img-responsive" alt=""></a>
        </div>
        <!-- End Header Navigation -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pdngnone" id="navbar-menu">
          <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
            <li><a href="index.html">HOME</a></li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">About Us</a>
              <ul class="dropdown-menu pull-right">
                <li><a href="company-profile.html">Company Profile</a></li>
                <li><a href="mission-vision.html">Mission/Vision/Values</a></li>
                <li><a href="infrastructure.html">Infrastructure</a></li>
              </ul>
            </li>
            <li><a href="services.html">Services</a></li>
            <li><a href="projects.html">Projects</a></li>
            <li><a href="clients.html">Clients</a></li>
            <li><a href="career.html">Career</a></li>
            <li><a class="activea" href="contacts.html">Contact Us</a></li>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav>
    <!-- End Navigation -->
  </div>

  <div class="container-fluid pdngnone mybanner2">
    <div class="container pdngnone">
      <h2 class="mybanner2_h2">CONTACT US</h2>
    </div>
  </div>

  <div class="container-fluid contact_sec bg6seccle">
    <div class="container pdngnone">
      <div class="col-sm-4">
        <h3 class="prdt_h3se">Contact Us</h3>
        <div class="sub_divider"></div>
        <ul class="forms_nav">
          <li><i class="fa fa-map-marker"></i><span><strong>Steel Age Building System</strong><br>
              #34 (Old No 25), 1st Main Road,<br>
              Shakambri Nagar, JP Nagar 1st Phase<br>
              Bangalore-560078
            </span></li>
          <li><i class="fa fa-phone"></i><span>+91 97177 30426</span><span>+91 80 2664 5137</span></li>
          <li><i class="fa fa-envelope-o"></i><span>info@steelagebuildingsystem.com</span></li>
        </ul>
      </div>
      <div class="col-sm-8">
        <h3 class="prdt_h3se">Send us a Message</h3>
        <div class="sub_divider"></div>
        <div class="inner contact">
          <!-- Form Area -->
          <div class="contact-form">
            <!-- Form -->
            <form name="enqForm" id="Contact-us" action="<?= MAINSITE ?>do_enquiry_1" onSubmit="submitForm(event)"
              novalidate="novalidate" accept-charset="utf-8" autocomplete="off" enctype="multipart/form-data"
              method="POST" data-parsley-validate>
              <input type="hidden" name="enq_type" value="enquiry">
              <input type="hidden" name="pagelink" value="contacts.html">
              <!-- Left Inputs -->
              <div class="col-sm-6 col-xs-12 pdngnone">
                <!-- Name -->
                <input type="text" class="form" id="Contact-us-name" name="name_contact_us"
                  pattern="(?=.*[A-Za-z])[A-Za-z\s]*" required="required" placeholder="Name"
                  data-parsley-required-message="Name is required" />
                <!-- Email -->
                <input type="email" class="form" id="Contact-us-email" name="email_contact_us" required="required"
                  placeholder="Email" data-parsley-required-message="E-mail address is required"
                  data-parsley-type="email" data-parsley-type-message="Please enter valid e-mail address" />
                <!-- Subject -->
                <input type="text" class="form" id="Contact-us-contact" name="contact_contact_us" maxlength="10"
                  pattern="[0-9\\s]{10,10}" required="required" placeholder="Mobile"
                  data-parsley-required-message="Contact number is required" data-parsley-type="integer"
                  data-parsley-type-message="Please enter valid mobile number" />
              </div><!-- End Left Inputs -->
              <!-- Right Inputs -->
              <div class="col-sm-6 col-xs-12 pdng767none">
                <!-- Message -->
                <textarea class="form textarea" id="Contact-us-message" name="message_contact_us" required="required"
                  placeholder="Enter the Message" data-parsley-required-message="Message/Requirement is required"
                  data-parsley-minlength="10" data-parsley-trigger="keyup"
                  data-parsley-minlength-message="You need to enter at least a 10 character message.."></textarea>
              </div><!-- End Right Inputs -->

              <!-- Bottom Submit -->
              <div class="relative fullwidth col-xs-12 pdngnone">
                <!-- Send Button -->
                <button class=" form-btn semibold" data-callback="onSubmit" data-wow-duration="1s"
                  data-action="submit">Send Message</button>
              </div><!-- End Bottom Submit -->
              <!-- Clear -->
              <div class="clear"></div>
            </form>

          </div><!-- End Contact Form Area -->
        </div><!-- End Inner -->
      </div>
    </div>
  </div>
  <div class="container-fluid pdngnone">

  </div>


  <div class="container-fluid bg3seccle1">
    <div class="container ctnrwdtnn">
      <div class="mysrvccl">
        <div class="col-md-4 col-sm-3 col-xs-12 pdng400none">
          <h3 class="h4servc" style="margin-left: 0px;">About Us</h3>
          <div class="subtitle-divider-2 divider-about-us"></div>
          <div class="footertxt">
            <p class="paraftr">Steel Age Building System is mainly engaged in fabrication and erection of Pre-
              Engineered Building (PEB), Structural steel system, Roofing & cladding commercial complex structure work,
              overhead bridge, Industrial buildings etc.

            </p>
          </div>
        </div>
        <div class="col-md-4 col-sm-3 col-xs-12 pdng400none">
          <h3 class="h4servc" style="margin-left: 0px;">Products</h3>
          <div class="subtitle-divider-2 divider-about-us"></div>
          <div class="footertxt">
            <ul class="ftrtags">
              <li><a href="index.html">HOME</a></li>
              <li><a href="company-profile.html">Company Profile</a></li>
              <li><a href="mission-vision.html">MIssion/ Vision/ Values</a></li>
              <li><a href="infrastructure.html">Infrastructure</a></li>
              <li><a href="services.html">Services</a></li>
              <li><a href="projects.html">Projects</a></li>
              <li><a href="clients.html">Clients</a></li>
              <li><a href="career.html">Career</a></li>
              <li><a href="contacts.html">Contact Us</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-4 col-sm-3 col-xs-12 pdng400none">
          <h3 class="h4servc" style="margin-left: 0px;">Contact Us</h3>
          <div class="subtitle-divider-2 divider-about-us"></div>
          <div class="footertxt">
            <ul class="ftrnav">
              <li>#34 (Old NO 25), 1st Main Road, Shakambri Nagar, JP Nagar 1st Phase, Bangalore-560078</li>
              <li><span>Tel :</span> +91 80 26645137 / 97177 30426</li>
              <li><span>Email :</span> info@steelagebuildingsystem.com</li>
              <li><a href="#"><span>Working Hours :</span> 10:00 a.m - 7:00 p.m</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid bg6sseccle about_bg5">
    <p class="paraftr">Copyright 2020 @ Steel Age Building System Reserved. Theme by <a
        href="https://www.marswebsolution.com/">Mars Web</a></p>
  </div>
  <div class="back-to-top"></div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="<?= JS ?>jquery.min.js"></script>

  <script src="dist/wow.js"></script>
  <script>
    wow = new WOW(
      {
        animateClass: 'animated',
        offset: 100,
        callback: function (box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
    document.getElementById('moar').onclick = function () {
      var section = document.createElement('section');
      section.className = 'section--purple wow fadeInDown';
      this.parentNode.insertBefore(section, this);
    };
  </script>

  <script>
    $(window).scroll(function () {
      var backToTopButton = $(".back-to-top");
      if ($(window).scrollTop() >= 200) {
        backToTopButton.css("bottom", "0px");
      } else {
        backToTopButton.attr('style', '');
      }
      backToTopButton.click(function () {
        $('body,html').stop().animate({
          scrollTop: 0
        }, "slow");
      });
      return false;
    });
  </script>
  <script src='<?= JS ?>owl.carousel.min.js'></script>
  <script src="<?= JS ?>product.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="<?= JS ?>bootstrap.min.js"></script>
  <script src="<?= JS ?>testis.js"></script>
  <script src="<?= JS ?>mymenus.js"></script>


  <style>
    input.parsley-success,
    select.parsley-success,
    textarea.parsley-success {
      color: #468847;
      background-color: #dff0d8;
      border: 1px solid #d6e9c6;
    }

    input.parsley-error,
    select.parsley-error,
    textarea.parsley-error {
      color: #b94a48;
      background-color: #f2dede;
      border: 1px solid #eed3d7;
    }

    .parsley-errors-list {
      margin: 2px 0 3px;
      padding: 0;
      list-style-type: none;
      font-size: 0.9em;
      line-height: 0.9em;
      opacity: 0;
      transition: all 0.3s ease-in;
      -o-transition: all 0.3s ease-in;
      -moz-transition: all 0.3s ease-in;
      -webkit-transition: all 0.3s ease-in;
      color: #ff0000;
    }

    .parsley-errors-list.filled {
      opacity: 1;
    }

    input[type="number"] {
      -moz-appearance: textfield;
    }

    ul.parsley-errors-list {
      order: 2;
      width: 100%;
      margin-top: 8px;
      margin-bottom: 0;
    }
  </style>
  <script type="text/javascript" src="<?= JS ?>jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="<?= JS ?>parsley.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js"></script>
  <script>
    var formCounter = 0;
    function submitForm(event) {
      formCounter++;
      if (formCounter > 1) {
        event.preventDefault();
        return false;
      }
    }

    function onSubmit(token) {
      //contactvalidateForm();
      if (!$("#Contact-us").parsley().isValid()) {
        $("#Contact-us").parsley().validate();
        return false;
      }
      else {
        $("#Contact-us").submit();
        return true;
      }
    }

  </script>

</body>

</html>