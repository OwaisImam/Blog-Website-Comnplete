<!---header---->			
<div class="header">  
	 <div class="container">
		  <div class="logo">
			  <a href="index.html"><img src="images/logo.png" title="" /></a>
		  </div>
			 <!---start-top-nav---->
  
			 <div class="top-menu">
				 <div class="search">
					 <form method="post" action="search.php">
					<input type="text" name="keyword" placeholder="Search...">
						
					 </form>
				 </div>
				  <span class="menu"> </span> 
				   <ul>
						<li class="active"><a href="home" <?php echo ($CatID == 0 ? '' : ''); ?>>HOME</a></li>						
						<li><a href="contact.php">CONTACT</a></li>						
						<div class="clearfix"> </div>
				 </ul>
			 </div>
			 <div class="clearfix"></div>
					<script>
					$("span.menu").click(function(){
					$(".top-menu ul").slideToggle("slow" , function(){
					});
					});
					</script>
				<!---//End-top-nav---->					
	 </div>
</div>
<!--/header-->
