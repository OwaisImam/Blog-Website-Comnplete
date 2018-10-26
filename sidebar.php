<div class="col-md-4 content-right">
				 <div class="recent">
					 <h3>RECENT POSTS</h3>
					<ul>
                         <?php
							$query="SELECT ID,BlogName,URL FROM blogs WHERE Status = 1 ORDER BY BlogName ASC";
							$result = mysql_query ($query) or die(mysql_error()); 
							$num = mysql_num_rows($result);
							if($num != 0)
							{
							$i=0;
							while($row = mysql_fetch_array($result,MYSQL_ASSOC))
							{
							$i++;
							?>
                             <?php
							$query2="SELECT ID,CategoryName,CategoryNameArabic FROM categories WHERE Status = 1 AND Parent = ".$row['ID']." ORDER BY Sort DESC";
							$result2 = mysql_query ($query2) or die(mysql_error()); 
							$num2 = mysql_num_rows($result2);
							if($num2 != 0)
							{
				?>     
							<ul>
					<a href="<?php $row['URL']; ?>" ><?php echo $row['BlogName']; ?></a>
                                		
										</ul>
									
                                    <?php
							}
							else
							{
							?>
							<li><a href="<?php echo $row['URL']; ?>"><?php echo $row['BlogName']; ?></a></li>
							<?php
							}
							}
							?>
						</ul> 
                        
 							<?php
							}
							?>
                           
				 </div>
				 <div class="clearfix"></div>
				 <div class="categories">
					 <h3>CATEGORIES</h3>
					<ul>
                         <?php
							$query="SELECT ID,CategoryName,CategoryNameArabic FROM categories WHERE Status = 1 AND Parent = 0 ORDER BY Sort";
							$result = mysql_query ($query) or die(mysql_error()); 
							$num = mysql_num_rows($result);
							if($num != 0)
							{
							$i=0;
							while($row = mysql_fetch_array($result,MYSQL_ASSOC))
							{
							$i++;
							?>
                             <?php
							$query2="SELECT ID,CategoryName,CategoryNameArabic FROM categories WHERE Status = 1 AND Parent = ".$row['ID']." ORDER BY Sort ASC";
							$result2 = mysql_query ($query2) or die(mysql_error()); 
							$num2 = mysql_num_rows($result2);
							if($num2 != 0)
							{
							echo '<li>'; ?>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $row['CategoryName']; ?><b class="caret"></b></a>
						
                                    
							<ul>
								
                                
                              <?php
							while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC))
							{
							?>
							
							<ul>
             <li> <a href="category.php?ID=<?php echo $row2['ID']; ?>"><?php echo $row2['CategoryName']; ?></a></li>
											
                                             <?php
							$query3="SELECT ID,CategoryName,CategoryNameArabic FROM categories WHERE Status = 1 AND Parent = ".$row2['ID']." ORDER BY Sort ASC";
							$result3 = mysql_query ($query3) or die(mysql_error()); 
							$num3 = mysql_num_rows($result3);
							if($num3 != 0)
							{
							echo '';
							while($row3 = mysql_fetch_array($result3,MYSQL_ASSOC))
							{
							?>
			<li><a href="category.php?ID=<?php echo $row3['ID']; ?>"><?php echo $row3['CategoryName']; ?></a></li>
							<?php
							}
							}
							?>
											
										</ul>
									
                                    <?php
							}
							echo '
								</ul>
							</li>';
							}
							else
							{
							?>
							<li><a href="category.php?ID=<?php echo $row['ID']; ?>"><?php echo $row['CategoryName']; ?></a></li>
							<?php
							}
							}
							?>
						</ul> 
                        
                       
<?php
if($i%4 == 0)
{
?>
    
	
									
<?php									
}
?>
							<?php
							}
							?>
    
					 
				 </div>
				 <div class="clearfix"></div>
			  </div>