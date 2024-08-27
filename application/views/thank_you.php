<?php
if (!empty($_SESSION['is_thank_you_page']) && $_SESSION['is_thank_you_page'] == 1) {
	$_SESSION['is_thank_you_page'] = 0;
	unset($_SESSION['is_thank_you_page']);
} else {
	echo "<script>location.href='contact-us'</script>";
	die();
}

?>

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
			<h3 class="prdt_h3se">! ! ! Thank You ! ! !</h3>
			<div class="sub_divider"></div>
			<div class="inner contact">
				<div class="contact-form">
					<h3 class="prdt_h3se">We will get back within 24 - 48 hours.</h3>
				</div><!-- End Contact Form Area -->
			</div><!-- End Inner -->
		</div>
	</div>
</div>
<div class="container-fluid pdngnone">

</div>