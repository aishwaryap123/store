<?php include('header.php'); ?>
		<?php $page=basename($_SERVER['PHP_SELF']); ?>
		<?php include('sidebar.php'); ?>
		<?php
			include "config.php";
			$tag="";
		    if(isset($_POST['tag1'])){
		    	$tag=$_POST['tag1'];
		    }
		    else if(isset($_POST['tag2'])){
		    	$tag=$_POST['tag2'];
		    }
			if(isset($_POST['submit'])){
			
			$name=$_POST['product-name'];
			$price=$_POST['product-price'];
			$category=$_POST['dropdown'];
			$image="";
		}
		if(isset($_GET['e_id'])){
			$edt_id=$_GET['e_id'];
			$stmt=$conn->prepare("SELECT * FROM  PRODUCT WHERE id=?");
			$stmt->bind_param("i",$edt_id);
			$stmt->bind_result($id1,$name1,$price1,$image1,$category1,$tag1);
			$stmt->execute();
			                    while($stmt->fetch()){
										$i=$id1;
										$n=$name1;
										$p=$price1;
										$img=$image1;
										$tag_edit=$tag1;
									}
		}
		if(isset($_POST['edit'])){
			$postId=$_POST['edit'];
			$postName=$_POST['product-name'];
			$postPrice=$_POST['product-price'];
			$stmt = $conn->prepare("UPDATE PRODUCT SET name=?,price=? WHERE id=?");
				$stmt->bind_param("ssi", $postName,$postPrice,$postId);
					$stmt->execute();
						$stmt->close();
							//header("location:dlt.php");
		}
		if(isset($_POST['submit'])){
		
			$filename="";
			if(isset($_FILES['image'])){
					
					if(move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$_FILES['image']['name'])){
							$filename = $_FILES['image']['name'];
								$image=$filename;
			 }
			}
		}
		$stmt=$conn->prepare("INSERT INTO PRODUCT (name,price,image,category,tags) values (?,?,?,?,?)");
				$stmt->bind_param("sssss",$name,$price,$image,$category,$tag);
					$stmt->execute();
						$stmt->close();
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
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								
								
								<p>
									<label>Product Name</label>
									<input class="text-input medium-input datepicker" type="text" id="product-name" name="product-name" value="<?php if(isset($_GET['e_id'])){ echo $n; } ?>" /> 
								</p>
								
								<p>
									<label>Product Price</label>
									<input class="text-input large-input" type="text" id="product-price" name="product-price" value="<?php if(isset($_GET['e_id'])){ echo $p; } ?>" />
								</p>
								<p>
								<label for="product_image">
								<span>Product Image</span> 
								<input type="file" name="image" value="upload_image" id="imageToupload">
				
								</label>
								</p>
								<?php if(isset($_GET['e_id'])){?>
							<input type="hidden" name="edit" value="<?php echo $edt_id; ?>"

								<?php } ?>
								
								
								<p>
									<label>This is a drop down list</label>              
									<select name="dropdown" class="small-input">
										<option name="option0" value="option0">Category</option>
										<option name="option1" value="Sports">Sports</option>
										<option  name="option2" value="Electronics">Elctronics</option>
										<option  name="option3" value="Automobiles">Automobiles</option>
										<option  name="option4" value="Luxury">Luxury</option>
										
									</select> 
								</p>
								
								<p>
									<label>Product Tags</label>
									<input type="checkbox" value="brittle" class="tags" name="tag1">Brittle</input>
									<input type="checkbox" value="fragile" class="tags" name="tag2">Fragile</input> 
								</p>
								
								<p>
								<?php if(!isset($edt_id)){  ?>
									<input class="button" name="submit" type="submit" value="Submit" />
									<?php } else{?>
									<input class="button" name="update" type="submit" value="Update" />
									<?php } ?>
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->   
