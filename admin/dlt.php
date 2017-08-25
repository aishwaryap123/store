<?php 
	include "config.php";

				if(isset($_GET['d_id'])){
					$stmt = $conn->prepare("DELETE FROM PRODUCT WHERE id=?");
	    				$stmt->bind_param("i", $_GET['d_id']);
	    					$stmt->execute();
	    						$stmt->close();
	    						
						}
						header("location:mngproduct.php");
				?>