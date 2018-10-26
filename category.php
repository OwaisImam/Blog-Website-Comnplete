<?php
error_reporting(0);ini_set('display_errors', 0);
 include("admin/Common.php"); ?>
<?php include ('pagination.php'); //include of paginat page ?>
<?php
$Name="";
$NameArabic="";
$MetaDes="";
$MetaKey="";
$Description="";
$DescriptionArabic="";
$URL="";
$Parent=0;
$Banner="";
$ID=0;
$CatID=0;

	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
{
		$CatID=trim($_REQUEST["ID"]);
		$ID=trim($_REQUEST["ID"]);
		$query="SELECT ID,CategoryName,CategoryNameArabic,MetaDescription,Banner,Description,DescriptionArabic,MetaKeywords,URL,Parent FROM categories WHERE ID='" . (int)$ID . "' AND Status=1";
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
		$Name=$row["CategoryName"];
		$NameArabic=$row["CategoryNameArabic"];
		$MetaDes=$row["MetaDescription"];
		$MetaKey=$row["MetaKeywords"];
		$Description=$row["Description"];
		$DescriptionArabic=$row["DescriptionArabic"];
		$URL=$row["URL"];
		$Parent=$row["Parent"];
		$Banner=$row["Banner"];
	}
}
else
{
		redirect("404.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include ("favicon.php"); ?>
<title><?php echo $Name; ?> - <?php echo SiteTitle; ?></title>
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
					
	<!--//header-->
    
     <script>
$(document).ready(
    function()
    {
        $("input:checkbox").change(
            function()
            {
                if( $(this).is(":checked") )
                {
                    $("#frmsubmit").submit();
                }
				else
				{
					$("#frmsubmit").submit();
				}
            }
        )
    }
);
</script>
<div class="content">
	 <div class="container">
		 <div class="content-grids">
         	<div class="col-sm-5 content-main">
                        
                            <select id="input-sort" id="sorting" name="sort" onchange='this.form.submit()' class="select_item">
                            <option value="0" selected="selected">Default</option>
                            <option <?php if(isset($_REQUEST['sort'])){echo ($_REQUEST['sort'] == 1 ? 'selected' : '');}; ?> value="1">Name (A - Z)</option>
                            <option <?php if(isset($_REQUEST['sort'])){echo ($_REQUEST['sort'] == 2 ? 'selected' : '');}; ?> value="2">Name (Z - A)</option>
                          
                        </select>
                        
							</form>
						</div>
			 <div class="col-md-8 content-main">
					
                 
                    <?php
					$per_page = 5;
					$query="SELECT ID,BlogName,Overview,Description,Image,URL,Ratings FROM blogs WHERE FIND_IN_SET (".$ID.",Categories) AND Status = 1 ";
												
							if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == 0)
							{
								$query .= ' ORDER BY ID DESC';	
							}
							if(!isset($_REQUEST['sort']))
							{
								$query .= ' ORDER BY ID DESC';	
							}
							if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == 1)
							{
								$query .= ' ORDER BY BlogName ASC';	
							}
							if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == 2)
							{
								$query .= ' ORDER BY BlogName DESC';	
							}
						
							
								
					// echo $query;
					// exit();
					$result = mysql_query($query) or die(mysql_error());
					$total_results = mysql_num_rows($result);
					$total_pages = ceil($total_results / $per_page);//total pages we going to have
					//-------------if page is setcheck------------------//
					if (isset($_REQUEST['page'])) {
						$show_page = $_REQUEST['page'];             //it will telles the current page
						if ($show_page > 0 && $show_page <= $total_pages) {
							$start = ($show_page - 1) * $per_page;
							$end = $start + $per_page;
						} else {
							// error - show first set of results
							$start = 0;              
							$end = $per_page;
						}
					} else {
						// if page isn't set, show first set of results
						$show_page = 1;
						$start = 0;
						$end = $per_page;
					}

					if (isset($_REQUEST['page'])) {
						$currentpage = $_REQUEST['page'];             //it will telles the current page
					} else {
						// if page isn't set, show first set of results
						$currentpage = 1;
					}

					// display pagination
					$page = intval($currentpage);

					$tpages=$total_pages;
					if ($page <= 0)
						$page = 1;
					if($total_results == 0)
					{
					echo '<h1>Blogs Not Found</h1><br/><a href="home" class="btn btn-default">Go Home</a>';
					}
					for ($i = $start; $i < $end; $i++) {
					if ($i == $total_results) {
						break;
					}
					$Image=explode(',', mysql_result($result, $i, 'Image'));
					$img1 = $Image[0];
					$BlogIDTemp = mysql_result($result, $i, 'ID');
					$BlogNameTemp = mysql_result($result, $i, 'BlogName');
					$Ratings = mysql_result($result, $i, 'Ratings');
					$URLTemp = mysql_result($result, $i, 'URL');
					$Description = mysql_result($result,$i, 'Description');
					
					?>	
					<div class="content-grid">
						
                 <div class="content-grid-info">
  						<img src="ImageResizer.php?w=600&h=400&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($BlogNameTemp);?>"/>
						 <div class="post-info">
			 <h4><a href="<?php echo dboutput($URLTemp);?>"><?php echo dboutput($BlogNameTemp); ?></a><?php echo dboutput($row['Added']);?> / 27 Comments</h4>
						 <p><?php echo dboutput($Description); ?></p>
						 <a href="<?php echo dboutput($URLTemp); ?>"><span></span>READ MORE</a>
						 </div>
                         </div>
                      	</div>
						
						                   
                  
					 <?php
					}
					?>
								
                    
                     <?php
					$string = $_SERVER['REQUEST_URI'];

					$parts = parse_url($string);

					$queryParams = array();
					parse_str($parts['query'], $queryParams);
					unset($queryParams['page']);
					unset($queryParams['tpages']);
					$queryString = http_build_query($queryParams);
					$url = $parts['path'] . '?' . $queryString;
					
					
                    $reload = $url . "&tpages=" . $tpages;
                    echo '
					<div class="col-md-6">
					<ul class="pagination pagination-sm">';
                    if ($total_pages > 1) {
                        echo paginate($reload, $show_page, $total_pages);
                    }
                    echo "</ul></div>";
                    // display data in table
					?>
					
				 </div>
			  </div>
              
			  <?php include("sidebar.php");?>
			  <div class="clearfix"></div>
		  </div>
	  </div>
</div>
    <?php include "footer.php"; ?>

</body>
</html>