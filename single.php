<?php 
error_reporting(0);ini_set('display_errors', 0);
include("admin/Common.php"); ?>
<?php $CatID=99999; ?>
<?php
$ID=0;
if(isset($_REQUEST["ProductID"]))
$ID=trim($_REQUEST["ProductID"]);
?>
<?php
/*Review*/
$ReviewName="";
$ReviewReview="";
$ReviewRatings=0;
$msg1="";
/*Review*/



$Name="";
$NameArabic="";
$MetaDes="";
$MetaKey="";
$URL="";
$Overview="";
$Description="";
$Category="";
$Cat=array();
$Ratings=60;
$Image="";
$RelatedBlogs="";

	if(isset($_REQUEST["ProductID"]))
	{
			$ID=trim($_REQUEST["ProductID"]);
			$query="SELECT ID,BlogName,RelatedBlog,Description,MetaDescription,Image,Overview,Ratings,Image,URL FROM blogs WHERE URL='" . $ID . "' AND Status=1";
			$result = mysql_query ($query) or die(mysql_error()); 
			$num = mysql_num_rows($result);
		
		if($num==0)
		{
			redirect("404.php");
		}
		else
		{
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			
			$ID=$row["ID"];
			$Name=$row["ProductName"];
			$NameArabic=$row["ProductNameArabic"];
			$MetaDes=$row["MetaDescription"];
			$MetaKey=$row["MetaKeywords"];
			$URL=$row["URL"];
			$Overview=$row["Overview"];
			$Description=$row["Description"];
			$Ratings=$row["Ratings"];
			$Category=explode(',',$row["Categories"]);
			$RelatedBlogs=$row["RelatedBlogs"];
			$Image=$row["Image"];
			$Img = explode(',',$Image);
	
			$numb=count($Img);
		}
	}
	else
	{
			redirect("404.php");
	}
	// echo $Pricee;
	// exit();
?>

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
 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=982307405150852";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--header-->
<?php include("header.php");?>
<!--header-->
<div class="single">
	 <div class="container">
		  <div class="col-md-8 single-main">				 
			  <div class="single-grid">
              	 <h3><?php echo dboutput($row['BlogName']); ?></h3>
				<img src="ImageResizer.php?w=600&h=400&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES . $Image; ?>" data-imagezoom="true" class="img-responsive"> 		 					 
					<p><?php echo $Description;?></p>
			  </div>
			 <ul class="comment-list">
		  		   <h5 class="post-author_head">Written by <a href="#" title="Posts by admin" rel="author">admin</a></h5>
		  		   <li><img src="images/avatar.png" class="img-responsive" alt="">
		  		   <div class="desc">
		  		   <p>View all posts by: <a href="#" title="Posts by admin" rel="author">admin</a></p>
		  		   </div>
		  		   <div class="clearfix"></div>
		  		   </li>
		  	  </ul>
              
			  <div class="content-form">
					 <h3>Leave a comment</h3>
                <div class="fb-like" data-href="https://ustaadonline.net/blog/<?php echo $URL; ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
						 </div>
                        <div class="fb-comments" data-href="https://ustaadonline.net/blog/<?php echo $URL; ?>" data-width="670" data-numposts="10"></div>
		  </div>

			 <?php include("sidebar.php"); ?>
			  <div class="clearfix"></div>
		  </div>
	  </div>
</div>
<!--footer-->
<?php include("footer.php"); ?>
<!--footer-->


	
