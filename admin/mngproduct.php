<?php include('header.php'); ?>
<?php	include ("../config.php"); ?>
<?php	include ("../functions.php"); ?>
<?php $page=basename($_SERVER['PHP_SELF']); ?>
		
		<?php include('sidebar.php'); ?>
		<?php
		//$products=array();
	
		//insertion with pagitation....
		
				
					$total_record=countProduct();
				
				$rec_limit=3;
				$product_per_page=ceil($total_record/$rec_limit);
					if(isset($_GET['pg'])){
						$pg=$_GET['pg'];
				
						for ($i=1; $i <= $product_per_page ; $i++) {

       					if($pg==$i){

           				 $offset= ($i-1)*$rec_limit;
        			}
   				 }

					
			}

    
 			$products=showPagination($offset,$rec_limit);
         				
		
				
								
			?>

		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
					</div>
				</div>
			</noscript>
			
			<!-- Page Head -->
			<h2>Welcome John</h2>
			<p id="page-intro">What would you like to do?</p>
			
			<!-- End .clear -->









		

			<div class="content-box">

				<div class="content-box-header">
					
					<h3>Manage Product</h3>					
					
				</div> <!-- End .content-box-header -->

				<div class="content-box-content">

					<table>
							
						<thead>
							<tr>
							   <th><input class="check-all" type="checkbox" /></th>
							   <th>Product ID</th>
							   <th>Product Name</th>
							   <th>Product Price</th>
							   <th>Product Image</th>
							   <th>Product Tag</th>
							   <th>Product Category</th>
							   <th>Action</th>
							</tr>
							
						</thead>
					 
						<tfoot>
							<tr>
								<td colspan="6">
									<div class="bulk-actions align-left">
										<select name="dropdown">
											<option value="option1">Choose an action...</option>
											<option value="option2">Edit</option>
											<option value="option3">Delete</option>
										</select>
										<a class="button" href="#">Apply to selected</a>
									</div>
									
									<div class="pagination">
									
					<?php for($i=1;$i<=$product_per_page;$i++) { ?>	
						<a href="mngproduct.php?pg=<?php echo $i;?>" 
							<?php if(isset($pg)&&$pg==$i): ?>
					class='number current' title='1' <?php endif; ?>>
						   <?php echo $i;?></a>"
							
							<?php } ?>
								 <!-- End .pagination -->
									<div class="clear"></div>
								</td>
							</tr>
						</tfoot>
					 
						<tbody>
					<?php foreach($products as $key=>$value):?>
							<tr>
								<td><input type="checkbox" /></td>
								<td><?php echo $products[$key]['id'];?></td>
								<td><?php echo $products[$key]['name'];?></td>
								<td><?php echo $products[$key]['price']; ?></td>
								<td><img height="60px" width="60px" src="../uploads/<?php echo $value['image'];  ?>"></td>
								<td><?php echo $value['tags']?></td>
								<td><?php echo $value['category'];?></td>
								<td>
									<!-- Icons -->
									 <a href="createproduct.php?e_id=<?php echo $value['id'];?>" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
									 <a href="dlt.php?d_id=<?php echo $value['id'] ?>" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a> 
									 <a href="#" title="Edit Meta"><img src="resources/images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a>
								</td>
							</tr>
								<?php endforeach;
								?>
							
							
						</tbody>
						
					</table>
				</div>
			</div>
				


			
			
					
					


	
			
			
			
			
			<div class="clear"></div>
			
			
			
			
			
			
			<?php include('footer.php'); ?>
