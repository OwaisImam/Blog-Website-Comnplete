<?php
error_reporting(0);ini_set('display_errors', 0);
 include("admin/Common.php"); ?>
<?php $CatID = 0; ?>

<!DOCTYPE HTML>
<html>
<head>
<?php include ("favicon.php"); ?>

	<title><?php echo SiteTitle; ?></title>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo SiteTitle; ?>">
<meta name="keywords" content="<?php echo SiteTitle; ?>">
<meta name="author" content="<?php echo SiteTitle; ?>">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
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
<!--header-->
<?php include("header.php"); ?>
<!--header-->


<div class="content">
	 <div class="container">
		 <div class="content-grids">
			 <div class="col-md-8 content-main">
				
                 
                 	  <?php 
				$query="SELECT ID,BlogName,MetaDescription,Overview,Description,URL,Status,Categories,Image,Options,Ratings,RelatedBlog,DATE_FORMAT(DateAdded, '%D %b %Y / %r') AS Added,DateModified FROM blogs WHERE Status = 1 ORDER BY RAND() Limit 4";
				$res = mysql_query($query) or die(mysql_error());
				$res22=$res;
				$cou=0;
				while($row = mysql_fetch_array($res,MYSQL_ASSOC))
				{
?>
<?php
				$Image=explode(',', $row["Image"]);
				$img1 = $Image[0];
				$url = $row['URL'];
				if($cou%4==0)
				{
				?>
                				 
					 <div class="content-grid">
						 <?php
				}
				?>
                 <div class="content-grid-info">
  						<img src="ImageResizer.php?w=600&h=400&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['BlogName']); ?>"/>
						 <div class="post-info">
			 <h4><a href="<?php echo dboutput($row['URL']);?>"><?php echo dboutput($row['BlogName']); ?></a><?php echo dboutput($row['Added']);?> </h4>
						 <p><?php echo dboutput($row['Description']); ?></p>
						 <a href="<?php echo dboutput($row['URL']); ?>"><span></span>READ MORE</a>
						 </div>
                         </div>
                          <?php
								$cou++;
								if($cou%4==0)
								{
								?>
								</div>
								<?php
								}
								
				}
								?>
										 
				 </div>
			  </div>
              
			  <?php include("sidebar.php");?>
			  <div class="clearfix"></div>
		  </div>
	  </div>
</div>
<!-- footer -->
<?php include("footer.php");?>
<!--footer-->	
