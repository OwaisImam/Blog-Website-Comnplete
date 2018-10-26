<?php
error_reporting(0);ini_set('display_errors', 0);
 include("admin/Common.php"); ?>
<?php $CatID=99999; 
if(isset($_POST["SendMsg"]) && $_POST["SendMsg"] == "SEND")
{
	$Name="";
	$Email="";
	$Telephone="";
	$Message="";
	$msg="";
	
	if(isset($_POST["Name"]))
		$Name=trim($_POST["Name"]);

	if(isset($_POST["Email"]))
		$Email=trim($_POST["Email"]);

	if(isset($_POST["Telephone"]))
		$Telephone=trim($_POST["Telephone"]);

	if(isset($_POST["Message"]))
		$Message=trim($_POST["Message"]);

		if($Name == "")
		{
			$msg="Please enter your name";
			$_SESSION['contmsg'] = '<section id="" class="mainnavbar">
				<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
				'.$msg.'
			</div></div></section>';
		}

		else if($Email == "")
		{
			$msg="Please enter your email";
			$_SESSION['contmsg'] = '<section id="" class="mainnavbar">
				<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
				'.$msg.'
			</div></div></section>';
		}
		else if($Message == "")
		{
			$msg="Please enter your message";
			$_SESSION['contmsg'] = '<section id="" class="mainnavbar">
				<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
				'.$msg.'
			</div></div></section>';
		}
		
		else if($msg == "")
		{
			$query="INSERT INTO messages (Name, Email, Telephone, Message, DateAdded) VALUES ('".addslashes($Name)."', '".addslashes($Email)."', '".addslashes($Telephone)."', '".addslashes($Message)."', NOW())";
			$a=mysql_query($query) or die(mysql_error());
			if($a)
			{
				$subject = "A message received on ".SiteTitle;				
				$to = "Info at ".SiteTitle." <info@".Domain.">";
				$from = $Name." <".$Email.">";
				$message = "Following are the details of the message:<br/><br/>";
				$message .= "Name: ".$Name." <br/>Email.: ".$Email." <br/>Phone No.: ".$Telephone."<br/>Message: ".$Message."<br/>";
				$headers = "From: ".$from."\r\n";
				$headers .= "Return-Path: <".$from."\r\n";
				$headers .= "X-Mailer: PHP5\r\n";
				$headers .= 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL . "\r\n";
				$mail = @mail($to,$subject,$message,$headers);
				$msg = ' Thank you for contacting us. Your message has been received.';
				$_SESSION['contmsg'] = '<section id="" class="mainnavbar">
				<div class="col-md-12"><div class="alert alert-success alert-dismissable">
					<i class="fa fa-check"></i>
					'.$msg.'
				</div></div></section>';
			}
			else
			{
				$msg = 'An error occured, please try again later!';
				$_SESSION['contmsg'] = '<section id="" class="mainnavbar">
				<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
					'.$msg.'
				</div></div></section>';
			}
		}
}
?>

<!DOCTYPE HTML>
<html>
<head>
<?php include ("favicon.php"); ?>
	<title>Contact - <?php echo SiteTitle; ?></title>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo SiteTitle; ?>">
<meta name="keywords" content="<?php echo SiteTitle; ?>">
<meta name="author" content="<?php echo SiteTitle; ?>">
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!----webfonts---->
		<link href='http://fonts.googleapis.com/css?family=Oswald:100,400,300,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic' rel='stylesheet' type='text/css'>
		<!----//webfonts---->
		  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<!--end slider -->
		<!--script-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<!--/script-->
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
</script>
<!---->

</head>
<body>
<?php include("header.php"); ?>
<div class="contact-content">
	 <div class="container">
		     <div class="contact-info">
			 <h2>CONTACT</h2>
			 <p>Feel Free To Ask Anything!</p>
		     </div>
             	<?php if(isset($_SESSION['contmsg'])) { echo $_SESSION['contmsg']; $_SESSION['contmsg'] = ""; } ?>
			 <div class="contact-details">				 
					<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
							<input  type="text" placeholder="Name"  name="Name">
							<input type="text" placeholder="Email"  name="Email">
							<input  type="text" placeholder="Contact No."  name="Telephone">
							<textarea  placeholder="Message"  name="Message"></textarea>
							<input type="submit" name="SendMsg" value="SEND">
				
			 </form>
		  </div>
		  <div class="contact-details">
			  <div class="col-md-6 contact-map">
				 <h4>FIND US HERE</h4>
				 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d803187.8113675824!2d-120.11910914056458!3d38.15292455846902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb9fe5f285e3d%3A0x8b5109a227086f55!2sCalifornia%2C+USA!5e0!3m2!1sen!2sin!4v1423829283333" frameborder="0" style="border:0"></iframe>
			  </div>
			  <div class="col-md-6 company_address">		 
					<h4>GET IN TOUCH</h4>
					<p><?php echo Address; ?></p>
					
					<?php
				$query="SELECT ID,PhoneNumber,Status, DATE_FORMAT(DateAdded, '%D %b %Y<br>%r') AS Added, 
				DATE_FORMAT(DateModified, '%D %b %Y<br>%r') AS Updated
				FROM telephones WHERE Status = 1 ";
				$result = mysql_query ($query) or die("Could not select because: ".mysql_error()); 
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
?>				<p><a href="callto:<?php echo $row["PhoneNumber"]; ?>"><?php echo $row["PhoneNumber"]; ?></a></p>
<?php
				}
				?>
					
				<?php
				$query="SELECT ID,EmailAddress,Status, DATE_FORMAT(DateAdded, '%D %b %Y<br>%r') AS Added, 
				DATE_FORMAT(DateModified, '%D %b %Y<br>%r') AS Updated
				FROM emails WHERE Status = 1 ";
				$result = mysql_query ($query) or die("Could not select because: ".mysql_error()); 
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
?>						<p><a href="mailto:<?php echo $row["EmailAddress"]; ?>"><?php echo $row["EmailAddress"]; ?></a></p>
<?php
				}
				?>
                <br>
                <h4>Follow Us On</h4>
					
							<?php 
					$query="SELECT ID,Image,URL,Name
					FROM socialmedia WHERE ID <>0 AND Status = 1 ORDER BY Sort ASC Limit 5";
					$r = mysql_query($query) or die(mysql_error());
					$n = mysql_num_rows($r);
					if($n != 0)
					{
					while($row =  mysql_fetch_array($r))
					{
					?>
	<a href="<?php echo dboutput($row['URL']); ?>" target="_blank" class="<?php echo dboutput($row['Name']); ?>"><p><?php
echo dboutput($row['Name']); ?></p> </a>
					<?php 
					}
					}
					?>
						
			 </div>
			  <div class="clearfix"></div>
	     </div>		 


			 </div>
	 </div>
</div>
<?php include ("footer.php");?>
</div>

	
