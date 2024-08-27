<div class="container-fluid bg3seccle1">
   <div class="container ctnrwdtnn">
      <div class="mysrvccl" style="padding-top:20px;">
         <div class="col-md-4 col-sm-3 col-xs-12 pdng400none">
            <h3 class="h4servc" style="margin-left: 0px;">About Us</h3>
            <div class="subtitle-divider-2 divider-about-us"></div>
            <div class="footertxt">
               <p class="paraftr">Steel Age Building System is mainly engaged in fabrication and erection of Pre-
                  Engineered Building (PEB), Structural steel system, Roofing & cladding commercial complex structure
                  work, overhead bridge, Industrial buildings etc.

               </p>
            </div>
         </div>
         <div class="col-md-4 col-sm-3 col-xs-12 pdng400none">
            <h3 class="h4servc" style="margin-left: 0px;">Products</h3>
            <div class="subtitle-divider-2 divider-about-us"></div>
            <div class="footertxt">
               <ul class="ftrtags">
                  <li><a href="<?= MAINSITE ?>">HOME</a></li>
                  <li><a href="about-us">Company Profile</a></li>
                  <li><a href="mission-values">MIssion/ Vision/ Values</a></li>
                  <li><a href="infrastructure">Infrastructure</a></li>
                  <li><a href="services">Services</a></li>
                  <li><a href="clients">Clients</a></li>
                  <li><a href="careers">Careers</a></li>
                  <li><a href="contact-us">Contact Us</a></li>
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

<script src="<?= JS ?>jquery.min.js"></script>
<script src="<?= JS ?>bootstrap.min.js"></script>
<!-- <script src="<?= JS ?>product.min.js"></script> -->

<?php if (!empty($direct_js)) {
   foreach ($direct_js as $dj) {
      echo '<script src="' . $dj . '" type="text/javascript"></script>';
   }
} ?>
<?php if (!empty($js)) {
   foreach ($js as $j) {
      echo '<script src="' . JS . $j . '" type="text/javascript"></script>';
   }
} ?>
<?php if (!empty($php)) {
   foreach ($php as $j) {
      $this->load->view($j, $this->data);
   }
} ?>




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
<script>
   $('.dropdown').on('mouseenter mouseleave click tap', function () {
      $(this).toggleClass("open");
   });
</script>

</body>

</html>