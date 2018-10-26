<?php
 include("admin/Common.php");
 $CatID=99999;
 $ID=0;
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Not Found - <?php echo SiteTitle; ?></title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--//for-mobile-apps -->
<!--Custom Theme files -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--//Custom Theme files -->
<!--js
<script src="js/jquery-1.11.1.min.js"></script>
-->
<script src="js/modernizr.custom.js"></script>
<script src='js/jquery-1.9.1.js'></script>
<script src='js/jquery.elevatezoom.js'></script>
<!--//js-->
<!--flex slider-->
<script defer src="js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="css/flexslider1.css" type="text/css" media="screen" />
<script>
// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails"
  });
});
</script>
<!--flex slider-->
<script src="js/imagezoom.js"></script>
<!--cart-->
<script src="js/simpleCart.min.js"></script>
<!--cart-->
<!--web-fonts-->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'><link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Pompiere' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Fascinate' rel='stylesheet' type='text/css'>
<!--web-fonts-->
<!--animation-effect-->
<link href="css/animate.min.css" rel="stylesheet"> 
<script src="js/wow.min.js"></script>
<script>
 new WOW().init();
</script>
<!--//animation-effect-->
<!--start-smooth-scrolling-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>	
<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
</script>
<!--//end-smooth-scrolling-->

<style>
/*--four--*/
.four {
	padding: 9em 0 10em 0;
    min-height: 478px;
		text-align:center;
}
.four h3 {
	color: #f02b63;
	font-size: 7em;

}
.four p {
  color: #c3c3c3;
  font-size: 1.6em;
  padding: 0.5em 0 1em;
}
a.more{
	color:#fff;
	background:#f02b63;
	text-decoration:none;
	padding: 0.5em 2em;
  font-size: 1.1em;
  border-radius: 5px;
	-webkit-border-radius: 5px;
	-o-border-radius: 5px;
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
}
a.more:hover{	
	background:#4cb1ca;	
}
</style>
</head>
<body>
	<!--header-->
	<?php include("header.php"); ?>
<!--//header-->
<!-- breadcrumbs -->
	<div class="breadcrumb_dress">
		<div class="container">
			<ul>
				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
				<li>404 Page Not Found</li>
			</ul>
		</div>
	</div>
<!-- //breadcrumbs -->
	<!--single-page-->
	<div class="single">
		<div class="container">
			<div class="single-info">		
	<div class="row">
    	<div class="col-md-12">
        	<center>
			<div class="four">
				<h3>404</h3>
				<p>The page you're looking for could not be found.</p>
					<a href="index.php" class="more ">Go back to home</a>
				
			</div>

			<br class="clear" />
			</center>
    		</div>
			   <div class="clearfix"> </div>
			</div>
		</div>
        </div>
	</div>
	<!--//single-page-->


	<!--footer-->
	<?php include("footer.php"); ?>
	<!--//footer-->		
	<!--search jQuery-->
	<script src="js/main.js"></script>
	<!--//search jQuery-->
	<!--smooth-scrolling-of-move-up-->
	<script type="text/javascript">
		$(document).ready(function() {
		
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
	<!--//smooth-scrolling-of-move-up-->
	<!--Bootstrap core JavaScript
    ================================================== -->
    <!--Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.js"></script>
</body>
</html>