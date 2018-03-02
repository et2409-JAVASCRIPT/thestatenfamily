<?php 
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {
	
	// require a name from user
	if(trim($_POST['contactName']) === '') {
		$nameError =  'Forgot your name!'; 
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	
	// need valid email
	if(trim($_POST['email']) === '')  {
		$emailError = 'Forgot your e-mail address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'Invalid email address!';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
		
	// we need at least some content
	if(trim($_POST['comments']) === '') {
		$commentError = 'You your message!';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}
		
	// upon no failure errors let's email now!
	if(!isset($hasError)) {
		
		$emailTo = 'contactus@thestatenfamily.com'; // ADD YOUR EMAIL ADDRESS HERE FOR CONTACT FORM!
		$subject = 'Submitted message from the Staten web'.$name; // ADD YOUR EMAIL SUBJECT LINE HERE FOR CONTACT FORM!
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
        
        // set our boolean completion value to TRUE
		$emailSent = true;
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>The Staten Family</title>
		<link href="css/jquery.bxslider.css" rel="stylesheet" />
		<link href="style.css" rel="stylesheet">
        <link href="css/print.css" rel="stylesheet" type="text/css" media="print">
        <link href="css/media-gallery.css" rel="stylesheet" type="text/css" media="screen">
		<link href="css/font-awesome.min.css" rel="stylesheet"/>
        <link href='http://fonts.googleapis.com/css?family=Merienda:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Quicksand:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" type="image/png" href="img/yoga_favicon.png"/> <!--- 30px x 30px -->
		<meta name="description" content="The Staten Family memories through the years: PAST and PRESENT!">
	</head>
<body>
<!--- Start Wrapper -->
	<div id="wrapper">
<!--- Start Header -->
		<header>
			<div id="callout">
				<h2>WHAT'S SHAKIN!</h2>
			<!---	<p>530 Street Road, Solana Beach, CA 92075</p> -->
			</div>
			<div id="logo">
                <h2>THE STATEN FAMILY</h2>
				<!---<a href="index.html"><img src="img/400x75.png" title=""/></a>-->
			</div>
		</header>
<!--- End Header -->
	<div class="clearfix"></div>
<!--- Sart Banner Wrapper -->
		<div id="banner-wrapper">
<!--- Start Navigation -->
        <script src="js/jquery-1.11.2.min.js"></script>
		<script src="js/main.js"></script> <!--- For Navigation  -->
		<div class="nav-wrap">
			<div class="menu-toggle-wrap">
				<span class="toggle-menu"><i class="fa fa-navicon"></i></span>
			</div>
			<nav class="navigation">
				<div class='nav' nav-menu-style="yoga">
					<ul class="nav-menu">
						<li ><a href="index.html">Welcome</a></li>
						<li><a href="newsletter.html" target='_blank' title="Newsletter">Family Newsletter</a></li>
						<li><a href="http://www.odb.org/" target='_blank' title="THE WORD">THE WORD</a></li>
						<li><a href="gallery.html">Gallery</a></li> 
						<li class="active"><a href="contact.html">Contact</a></li>
					</ul>
				</div>
			</nav>
		</div>
<!--- End Navigation -->

<!--- Start Bread Crumbs -->
			<div id="bread-crumbs">
				<h3>Contact Us</h3>
			</div>
		</div>
<!--- End Bread Crumbs -->
<!--- End Banner Wrapper -->
<!--- Start Banner Image -->
		<div class="banner-img">
			<img src="img/1000x245.png" title=""/>
		</div>
	<div class="clearfix"></div>
<!--- End Banner Image -->
	<div class="clearfix"></div>	
<!--- Start Contact Info -->
		<section class="one-third">
			<h2>Our Contact info:</h2>
				<br>
			<h3>307 Cloverdale Drive<br>Durham, NC 27703</h3>
				<br>
			<!---<h3 class"phone"><strong>Phone :</strong> 1 888 466 1508</h3>-->
				<br>
			<h4><strong>Email :</strong> contactus@thestatenfamily.com</h4>
				<br>
			<p>Thank you for visiting our website, we'd be happy to hear from you and your input!</p>
		</section>
<!-- End Contact Info -->
<!-- Start Contact Form -->
	<section class="two-third" class="contact">
	<div id="contact-area">
	<div id="contact" class="section">
		<div class="container content">
	        <?php if(isset($emailSent) && $emailSent == true) { ?>
                <p class="info">Your email was sent. Thank You!</p>
            <?php } else { ?>		
				</div>	
				<div id="contact-form">
					<?php if(isset($hasError) || isset($captchaError) ) { ?>
                        <p class="alert">Error submitting the form</p>
                    <?php } ?>
				
					<form id="contact-us" action="contact.php" method="post">
						<div class="formblock">
							<label class="screen-reader-text">Name</label>
							<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="txt requiredField" placeholder="Name:" />
							<?php if($nameError != '') { ?>
								<br /><span class="error"><?php echo $nameError;?></span> 
							<?php } ?>
						</div>
                        <div class="clearfix"></div>
						<div class="formblock">
							<label class="screen-reader-text">Email</label>
							<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="txt requiredField email" placeholder="Email:" />
							<?php if($emailError != '') { ?>
								<br /><span class="error"><?php echo $emailError;?></span>
							<?php } ?>
						</div>
                        <div class="clearfix"></div>
						<div class="formblock">
							<label class="screen-reader-text">Message</label>
							 <textarea name="comments" id="commentsText" class="txtarea requiredField" placeholder="Message:"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if($commentError != '') { ?>
								<br /><span class="error"><?php echo $commentError;?></span> 
							<?php } ?>
						</div>
                      <div class="clearfix"></div>  
							<button name="submit" type="submit" class="subbutton">Submit</button>
							<input type="hidden" name="submitted" id="submitted" value="true" />
					</form>			
			<?php } ?>
		</div>
    </div>
<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	$(document).ready(function() {
		$('form#contact-us').submit(function() {
			$('form#contact-us .error').remove();
			var hasError = false;
			$('.requiredField').each(function() {
				if($.trim($(this).val()) == '') {
					var labelText = $(this).prev('label').text();
					$(this).parent().append('<span class="error">Forgot your '+labelText+'!</span>');
					$(this).addClass('inputError');
					hasError = true;
				} else if($(this).hasClass('email')) {
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if(!emailReg.test($.trim($(this).val()))) {
						var labelText = $(this).prev('label').text();
						$(this).parent().append('<span class="error">Sorry! Invalid '+labelText+'!</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				}
			});
			if(!hasError) {
				var formInput = $(this).serialize();
				$.post($(this).attr('action'),formInput, function(data){
					$('form#contact-us').slideUp("fast", function() {				   
						$(this).before('<p class="tick"><h3>Thanks! Your email has been delivered!</h3></p>');
					});
				});
			}
			
			return false;	
		});
	});
	//-->!]]>
</script>
			</div>
		</section>
<!-- End Contact Form -->
	<div class="clearfix"></div>				
<!--- Start Footer -->
		  <div id="footer-bg">
          <div id="footer">
               <p class="footer-text">&copy;2018<?php echo date("Y");?> • All Rights Reserved • Pages4All</p>
               <p class="footer-text">Durham, North Carolina &bull; contactus@thestatenfamily.com</p>
               <p class="footer-text">Hebrews 11:1</p>
               <p class="footer-text">Now faith is the substance of things hoped for; the evidence of things not seen.</p>

               <div id="social-media">
                    <ul>
                         <!--- <li><a href="http://www.facebook.com">
                              <img class="img-swap" src="img/icons/social-media/facebook_off.png" /></a></li>-->
                         <li><a href="http://www.youtube.com">
                              <img class="img-swap" src="img/icons/social-media/youtube_off.png" /></a></li>
                         <!---<li><a href="http://www.twitter.com">
                              <img class="img-swap" src="img/icons/social-media/twitter2_off.png" /></a></li>-->
                         <li><a href="http://www.linkedin.com">
                              <img class="img-swap" src="img/icons/social-media/linkedin_off.png" /></a></li>
                         <li><a href="https://plus.google.com">
                              <img class="img-swap" src="img/icons/social-media/google_off.png" /></a></li>
                         <li><a href="http://pinterest.com">
                              <img class="img-swap" src="img/icons/social-media/pinterest_off.png" /></a></li>
                       <!---  <li><a href="http://www.vimeo.com">
                              <img class="img-swap" src="img/icons/social-media/vimeo_off.png" /></a></li>-->
                         <!---<li><a href="http://feeds.feedburner.com">
                              <img class="img-swap" src="img/icons/social-media/rss_off.png" /></a></li>-->
                    </ul>
               </div>
          </div>
     </div>
        
<div id="print-footer">
     <h4>Main Print Footer</h4>
</div>

<!--- End Footer -->
<!--- End Wrapper -->
<!--- Top Scroll Start -->
	<a href="#0" class="cd-top">Top</a>
		<script src="js/top.js"></script> <!-- Gem jQuery -->
		<script src="js/modernizr.js"></script>
<!--- Top Scroll End -->
         </div>
</body>
</html>