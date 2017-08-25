<?php include('header.php'); ?>
<?php $page=basename($_SERVER['PHP_SELF']); ?>
		
		<?php include('sidebar.php'); ?>
		<?php
		$products=array();
		include "config.php";
	    	$stmt= $conn->prepare("SELECT * FROM PRODUCT ");
				$stmt->execute();
					$stmt->bind_result($r_id,$r_name,$r_price,$r_image,$r_cat);
					while($stmt->fetch()){
						array_push($products,array('id'=>$r_id,'name'=>$r_name,'price'=>$r_price,'image'=>$r_image,'category'=>$r_cat));
					}
		
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
										<a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a>
										<a href="#" class="number" title="1">1</a>
										<a href="#" class="number" title="2">2</a>
										<a href="#" class="number current" title="3">3</a>
										<a href="#" class="number" title="4">4</a>
										<a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
									</div> <!-- End .pagination -->
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
								<td><?php echo $value['category'];?></td>
								<td>
									<!-- Icons -->
									 <a href="createproduct.php?e_id=<?php echo $value['id'] ?>" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
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
