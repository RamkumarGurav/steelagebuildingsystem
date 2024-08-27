<div class="container-fluid  mybanner2">
  <div class="container pdngnone">
    <h2 class="mybanner2_h2">CAREERS</h2>
  </div>
</div>

<div class="container-fluid contact_sec bg6seccle">
  <div class="container pdngnone">

    <div class="col-sm-12">
      <h3 class="prdt_h3se">Career with us</h3>
      <div class="sub_divider"></div>
      <div class="inner contact">
        <!-- Form Area -->
        <div class="contact-form">
          <!-- Form -->
          <form name="enqForm" id="Contact-us" action="<?= MAINSITE ?>do_enquiry" onSubmit="submitForm(event)"
            novalidate="novalidate" accept-charset="utf-8" autocomplete="off" enctype="multipart/form-data"
            method="POST" data-parsley-validate>
            <input type="hidden" name="enq_type" value="careers">
            <input type="hidden" name="pagelink" value="careers">
            <!-- Left Inputs -->
            <div class="col-sm-6 col-xs-12  ">
              <!-- Name -->
              <input type="text" class="form" id="Contact-us-name" name="name_contact_us"
                pattern="(?=.*[A-Za-z])[A-Za-z\s]*" required="required" placeholder="Name"
                data-parsley-required-message="Name is required" />
            </div>
            <div class="col-sm-6 col-xs-12  ">
              <!-- Email -->
              <input type="email" class="form" id="Contact-us-email" name="email_contact_us" required="required"
                placeholder="Email" data-parsley-required-message="E-mail address is required" data-parsley-type="email"
                data-parsley-type-message="Please enter valid e-mail address" />
            </div>
            <div class="col-sm-6 col-xs-12  ">
              <!-- Email -->
              <input type="text" class="form" id="Contact-us-contact" name="contact_contact_us" maxlength="10"
                pattern="[0-9\\s]{10,10}" required="required" placeholder="Mobile"
                data-parsley-required-message="Contact number is required" data-parsley-type="integer"
                data-parsley-type-message="Please enter valid mobile number" />
            </div>
            <div class="col-sm-6 col-xs-12  ">
              <!-- Subject -->
              <input type="text" class="form" id="Contact-us-qualification" name="qualification_contact_us"
                required="required" placeholder="Qualification"
                data-parsley-required-message="Qualification is required" />
            </div>
            <div class="col-sm-6 col-xs-12  ">
              <!-- Subject -->
              <input type="text" class="form" id="Contact-us-appliedfor" name="appliedfor_contact_us"
                required="required" placeholder="Position Applied for"
                data-parsley-required-message="Position Applied for is required" />
            </div>
            <div class="col-sm-6 col-xs-12   ">
              <!-- Subject -->
              <input type="text" class="form" id="Contact-us-experience" name="experience_contact_us"
                required="required" placeholder="Experience" data-parsley-required-message="Experience is required" />
            </div><!-- End Left Inputs -->
            <!-- Right Inputs -->
            <!-- End Right Inputs -->
            <!-- Bottom Submit -->
            <div class="col-sm-6 col-xs-12 ">
              <input type="file" class="form" id="Contact-us-userfile" name="userfile_contact_us" required="required"
                data-parsley-required-message="Resume is required">
            </div>

            <div class="relative fullwidth col-xs-12 ">
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
<div class="container-fluid ">
</div>
<div class="clearfix"></div>