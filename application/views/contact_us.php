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
          <form name="enqForm" id="Contact-us" action="<?= MAINSITE ?>do_enquiry" onSubmit="submitForm(event)"
            novalidate="novalidate" accept-charset="utf-8" autocomplete="off" enctype="multipart/form-data"
            method="POST" data-parsley-validate>
            <input type="hidden" name="enq_type" value="contact_us">
            <input type="hidden" name="pagelink" value="contact-us">
            <!-- Left Inputs -->
            <div class="col-sm-6 col-xs-12 pdngnone">
              <!-- Name -->
              <input type="text" class="form" id="Contact-us-name" name="name_contact_us"
                pattern="(?=.*[A-Za-z])[A-Za-z\s]*" required="required" placeholder="Name"
                data-parsley-required-message="Name is required" />
              <!-- Email -->
              <input type="email" class="form" id="Contact-us-email" name="email_contact_us" required="required"
                placeholder="Email" data-parsley-required-message="E-mail address is required" data-parsley-type="email"
                data-parsley-type-message="Please enter valid e-mail address" />
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
              <button class="g-recaptcha form-btn semibold" data-callback="onSubmit"
                data-sitekey="<?= _google_recaptcha_site_key_ ?>" data-wow-duration="1s" data-action="submit">Send
                Message</button>
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