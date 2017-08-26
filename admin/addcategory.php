<?php include('header.php'); ?>
	<?php $page=basename($_SERVER['PHP_SELF']); ?>
		<?php include('sidebar.php'); ?>
		<?php include "config.php" ?>
		<?php 
			$category=array();
			$bind_id=0;
			$stmt=$conn->prepare("SELECT * FROM Category WHERE parent_id=?");
			$stmt->bind_param("i",$bind_id);
			$stmt->bind_result($cat_id,$cat_name,$parent_id);
			$stmt->execute();
			                    while($stmt->fetch()){
								array_push($category,array('id'=>$cat_id,'name'=>$cat_name,'p_id'=>$parent_id));
										
									}
			$stmt->close();	
			//to fetch parent id
			$pid=0;
			if(isset($_POST['dropdown'])){
				$parent_name=$_POST['dropdown'];
				foreach($category as $x=>$y){
					if($y['name']==$parent_name){
						$pid=$y['id'];
					}
				}

			}
			if(isset($_POST['submit'])){
				$catname=isset($_POST['cat-name'])?$_POST['cat-name']:"";
				$stmt=$conn->prepare("INSERT INTO Category(cat_name,parent_id) VALUES(?,?)");
				$stmt->bind_param('si',$catname,$pid);
				$stmt->execute();
				$stmt->close();
				//header("location:mngcategory.php");
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
			<div class="tab-content" id="tab2">
				<form action="#" method="post" enctype="multipart/form-data">
					<fieldset>
					<p>
						<label>Category Name</label>
						<input class="text-input medium-input datepicker" type="text" id="cat-name" name="cat-name" >
					</p>
					<p>
					<select name="dropdown" class="small-input">
					<option  value="option0">Category</option>
					<?php foreach ($category as $key => $value) { ?>
						# code...
						<option  value="<?php echo $value['name'];?>"><?php echo $value['name']; ?></option>
					<?php } ?>
					
					
						
						
					</select>
					</p>
						<p>
						<input class="button" name="submit" type="submit" value="Submit" />
						</p>
				</form>
			<div class="clear"></div><!-- End .clear -->
			</div>