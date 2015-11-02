<?php
	$hide = '';
	if (isset($_POST["submit"])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$message = $_POST['message'];
		$human = $_POST['human'];
		$from = 'NAB Group Website'; 
		$to = 'info@nabgroupequipment.com'; 
		$subject = 'NAB Group Contact form';
		
		$body ="From: $name\n Phone: $phone\n E-Mail: $email\n Message:\n $message";
		// Check if name has been entered
		if (!$_POST['name']) {
			$errName = 'Please enter your name';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}
		
		//Check if message has been entered
		if (!$_POST['message']) {
			$errMessage = 'Please enter your message';
		}
		//Check if simple anti-bot test is correct
		if (!$human == '') {
			$errHuman = 'Your anti-spam is incorrect. Please reload the page and try again.';
		}
// If there are no errors, send the email
if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
	if (mail ($to, $subject, $body, $from)) {
		$result='<div class="alert alert-success">Thank you for your message, we will respond as soon as we can.</div>';
		$hide = 'hide';
	} else {
		$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again.</div>';
	}
}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta name="keywords" content="Micros, Point of Sale, 1700, 2700, 3700, 8700, 9700,  Micros Eclipse, WS4, Repair, POS, Restaurant, Parts">
<meta name="description" content="NAB sells Micros workstations, printers, and accessories.  We can usually ship the same day you order via UPS.  Call Bob or Joe for more information.">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta name="created" content="Thu, 05 Mar 2015 07:58:49 GMT">
<link rel="stylesheet" href="style.css" type="text/css" />


<title> Low prices on refurbished Micros POS Systems, for hospitality and restaurant businesses.  We sell Micros for less! </title>

<style type="text/css">

   /* TEXT STYLES */

.textstyle0 {font-family:Verdana;font-weight:bold;font-style:normal;font-size:18px;text-decoration:none;color:#ff9900;}
.textstyle1 {font-family:Verdana;font-weight:normal;font-style:normal;font-size:13px;text-decoration:none;color:#000000;}
.textstyle2 {font-family:Verdana;font-weight:bold;font-style:normal;font-size:13px;text-decoration:none;color:#000000;}
.textstyle3 {font-family:Arial;font-weight:bold;font-style:normal;font-size:18px;text-decoration:none;color:#ffffff;}
.textstyle4 {font-family:Arial;font-weight:normal;font-style:normal;font-size:15px;text-decoration:none;color:#000000;}
.textstyle5 {font-family:Arial;font-weight:normal;font-style:normal;font-size:15px;text-decoration:none;color:#ffffff;}
.textstyle6 {font-family:Verdana;font-weight:normal;font-style:normal;font-size:10px;text-decoration:none;color:#000000;}
.textstyle7 {font-family:Verdana;font-weight:normal;font-style:normal;font-size:10px;text-decoration:none;color:#ffffff;}


   /* OBJECT STYLES */

div.Object372 { position:absolute; top:218px; left:7px; z-index:0; }
div.Object373 { position:absolute; top:42px; left:682px; z-index:1; }
div.Object374 { position:absolute; top:245px; left:7px; z-index:2; }
div.Object375 { position:absolute; top:272px; left:7px; z-index:3; }
div.Object376 { position:absolute; top:353px; left:7px; z-index:4; }
div.Object377 { position:absolute; top:204px; left:111px; z-index:5; }
div.Object378 { position:absolute; top:599px; left:352px; z-index:6; }
div.Object379 { position:absolute; top:602px; left:394px; z-index:7; }
div.Object380 { position:absolute; top:616px; left:664px; width:170px; z-index:8; }
div.Object381 { position:absolute; top:498px; left:142px; z-index:9; }
div.Object382 { position:absolute; top:634px; left:342px; z-index:10; }
div.Object383 { position:absolute; top:45px; left:128px; z-index:11; }
div.Object384 { position:absolute; top:84px; left:135px; z-index:12; }
div.Object385 { position:absolute; top:326px; left:7px; z-index:13; }
div.Object386 { position:absolute; top:299px; left:7px; z-index:14; }
div.Object387 { position:absolute; padding-right:5px; top:245px; left:142px; z-index:15; text-align:left; width:685px; }
div.Object388 { position:absolute; padding-right:5px; top:52px; left:142px; z-index:16; text-align:left; width:343px; }
div.Object389 { position:absolute; padding-right:5px; top:186px; left:475px; z-index:17; text-align:right; width:383px; }

.hide {
	display: none;
}
.contact-form-wrap {
	position: absolute;
	left: 140px;
	top: 460px;
}

.antispam { display:none;}

   /* BODY STYLES */

body {
 margin:0px;
 padding :0px;
 text-align:center;
 height:100%;
 width:100%;
 background-color: #ffffff;
}

form * {
	font-family: Verdana,sans-serif;
	font-size: 13px;
}
.form-group {
	margin-bottom: 15px;
}
.text-danger {
    color: #a94442;
    margin-top: 2px;
    font-weight: bold;
}
.alert-success {
    background-color: #dff0d8;
    border-color: #d6e9c6;
    border-radius: 4px;
    color: #3c763d;
    font-family: Verdana;
    font-size: 14px;
    padding: 15px;
}
form input[type="text"],
form input[type="email"],
form textarea {
	
	padding: 5px;
	width: 300px;
	border: 1px solid #ccc;
}
form p {
	margin: 0;
}


   /* LINK STYLES */

A:link { color:#0000ff;}

A:visited  { color:#800080;}

A:hover  { color:#0000ff;}

   /* IMAGE STYLES */

img { border:0 none}

#submit {
    background: #fe9900 none repeat scroll 0 0;
    border: medium none;
    color: #fff;
    padding: 5px 25px;
}
#submit:hover,
#submit:active {
	background-color: #FCB03F
}
#submit:active {
	box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.25) inset;
}

   /* CONTAINER RULES */

#container { position:relative; margin:0px auto 0 auto; height:1200px; width:875px; text-align:left; padding-left:0px;}

</style>
<script type="text/javascript">
		// split your email into two parts and remove the @ symbol
		var first = "info";
		var last = "nabgroupequipment.com";
	</script>

<?php include "google-analytics.php"; ?>
</head>

<body>
<div id="container">

<div class="Object372"><a href="/" onMouseOver='img_mo0.src="files/mo_IMG_56.jpg"' onMouseOut='img_mo0.src="files/IMG_56.jpg"'><img src="files/IMG_56.jpg" name="img_mo0" width="100px" height="25px" alt="Home of Micros" title="Home of Micros"></a></div>

<div class="Object373"><img src="files/logo2.jpg"  width="175px" height="140px" alt="Contact Bob or Joe at NAB Group" title="Contact Bob or Joe at NAB Group"></div>

<div class="Object374"><a href="products.php" onMouseOver='img_mo1.src="files/mo_IMG_58.jpg"' onMouseOut='img_mo1.src="files/IMG_58.jpg"'><img src="files/IMG_58.jpg" name="img_mo1" width="100px" height="25px" alt="Products of Micros" title="Products of Micros"></a></div>

<div class="Object375"><a href="prices.php" onMouseOver='img_mo2.src="files/mo_IMG_59.jpg"' onMouseOut='img_mo2.src="files/IMG_59.jpg"'><img src="files/IMG_59.jpg" name="img_mo2" width="100px" height="25px" alt="Prices of Micros" title="Prices of Micros"></a></div>

<div class="Object376"><img src="files/IMG_60.jpg"  width="100px" height="25px" alt="Micros Contact Page" title="Micros Contact Page"></div>

<div class="Object377"><img src="files/line.gif"  alt="" width="740px" height="6px"></div>


<div class="Object380"><script language="JavaScript" type="text/javascript" src="NoIEActivate.js"></script></div>



<div class="Object383"><img src="files/IMG_66.jpg"  alt="" width="368px" height="119px"></div>

<div class="Object384"><img src="files/IMG_10.jpg"  alt="" width="354px" height="71px"></div>

<div class="Object385"><a href="tech-tips.php" onMouseOver='img_mo3.src="files/mo_IMG_68.jpg"' onMouseOut='img_mo3.src="files/IMG_68.jpg"'><img src="files/IMG_68.jpg" name="img_mo3" width="100px" height="25px" alt="Contact NAB Group" title="Contact NAB Group"></a></div>

<div class="Object386"><a href="spare-n-air.php" onMouseOver='img_mo4.src="files/mo_IMG_69.jpg"' onMouseOut='img_mo4.src="files/IMG_69.jpg"'><img src="files/IMG_69.jpg" name="img_mo4" width="100px" height="25px" alt="Contact NAB Group" title="Contact NAB Group"></a></div>

<div class="Object387"><span class="textstyle0">Contact Us<br>
<br>
</span><span class="textstyle1">We are on-site to answer questions and take orders Monday through Friday, from 8 a.m. to 5 p.m. 
Central Standard Time.<br>
<br>
</span><span class="textstyle2">Phone:<br>
</span><span class="textstyle1">847-526-9650<br>
<br>
</span><span class="textstyle2">Email:<br>
</span><span class="textstyle1"><script type="text/javascript">
		document.write('<a href="mailto:'+first + '@' + last+'">'+first + '@' + last+'<\/a>');
	</script>
	<noscript>
	Please enable javascript or use the contact form.
	</noscript>
<br>

</span></div>

<div class="contact-form-wrap">
	<p style="margin: 0;font-size: 13px;"><b>* Required fields</b></p>
<form class="form-horizontal <?php echo $hide;?>" role="form" method="post" action="contact-us.php">
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Name <b>*</b></label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
			<?php echo "<p class='text-danger'>$errName</p>";?>
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email <b>*</b></label>
		<div class="col-sm-10">
			<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
			<?php echo "<p class='text-danger'>$errEmail</p>";?>
		</div>
	</div>
	<div class="form-group">
		<label for="phone" class="col-sm-2 control-label">Phone</label>
		<div class="col-sm-10">
			<input type="phone" class="form-control" id="phone" name="phone" placeholder="555-555-5555" value="<?php echo htmlspecialchars($_POST['phone']); ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="message" class="col-sm-2 control-label">Message <b>*</b></label>
		<div class="col-sm-10">
			<textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
			<?php echo "<p class='text-danger'>$errMessage</p>";?>
		</div>
	</div>
	<div class="form-group antispam">
		<label for="human" class="col-sm-2 control-label">Address</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="human" name="human" placeholder="Address">
		</div>
	</div>
	<?php echo "<p class='text-danger'>$errHuman</p>";?>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
		</div>
	</div>
</form>
	<div>
		<?php echo $result; ?>	
	</div>
</div>
   
<div class="Object388"><span class="textstyle3">Wanted to buy!<br>
<br>
</span><span class="textstyle4">Micros UWS 4's</span><span class="textstyle5"> ..............</span><span class="textstyle4"> Micros Net CC<br>
Micros UW 5's</span><span class="textstyle5">..................</span><span class="textstyle4"> Micros UWS 4 Stands<br>
</span><span class="textstyle5"> ,,,,,,,,,,</span><span class="textstyle4"> *We do not buy Micros Software<br>
</span></div>

<div class="Object389">
	<?php include "header-text.php"; ?>
</div>
	<?php include "footer.php"; ?>
</div>

</body>
</html>
