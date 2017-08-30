<?php 
	include "../config.php";

				if(isset($_GET['d_id'])){
					$stmt = $conn->prepare("DELETE FROM PRODUCT WHERE id=?");
	    				$stmt->bind_param("i", $_GET['d_id']);
	    					$stmt->execute();
	    						$stmt->close();
	    						header("location:mngproduct.php");
	    						
						}
						//to delete category
					if(isset($_GET['c_id'])){
						$stmt = $conn->prepare("DELETE FROM Category WHERE parent_id=?");
	    				$stmt->bind_param("i", $_GET['c_id']);
	    					$stmt->execute();
	    						$stmt->close();
	    						$stmt = $conn->prepare("DELETE FROM Category WHERE cat_id=?");
	    				$stmt->bind_param("i", $_GET['c_id']);
	    					$stmt->execute();
	    						$stmt->close();

								header("location:mngcategory.php");
									}
									?>
