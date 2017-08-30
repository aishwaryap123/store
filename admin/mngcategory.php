<?php include('header.php'); 
include "../config.php";
include "../functions.php";
?>
	<?php $page=basename($_SERVER['PHP_SELF']); ?>
		<?php include('sidebar.php'); ?>
		<?php 
			
			//to show categories.....
			$ctg=showCategory();
			
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
							   
							   <th>Category ID</th>
							   <th>Category Name</th>
							   <th>Parent ID</th>
							   <th></th>
							   
							</tr>
							</thead>
							
							<?php foreach ($ctg as $key => $value):?>
								<tr>
								<td><?php echo $value['id']; ?></td>
								<td><?php echo $value['name']; ?></td>
								<td><?php echo $value['p_id']; ?></td>
								<td>
									
									 <a href="dlt.php?c_id=<?php echo $value['id'] ?>" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a>
								</td> 
								</tr>
							
						<?php	 endforeach ;?>

						
							
					
					</table>
				</div>
			</div>
					 

