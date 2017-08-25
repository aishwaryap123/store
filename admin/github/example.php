<?php
	session_start();
 	include "config.php";
 	if(isset($_POST['edtid'])){

         $uid= $_POST['edtid'];
            $cart= $_SESSION["cart"];
            	foreach ($cart as $key => $value) {

                    if($value['id']== $uid){
                    	$cart[$key]['quant']= $_POST['val'];
                            $_SESSION["cart"] = $cart;
                               // $cart=$_SESSION['cart'];
                             echo json_encode(array('cart'=>$cart));
                                }
                            }
                        }
                                            
                                              
                                                    

                                                        
                 
                                        
                                                          
                                                          
                                           
                                                       
                                                  
 	
 	function findPrice($checkout){
 		$price=0;
 			foreach($checkout as $key=>$value){
 				$price=$checkout[$key]['price']+$price;
 			}
 				return $price;
 		}
 		function findQuant($checkout){
 			$quant=0;
 				foreach($checkout as $key=>$value){
 					$quant=$value['quant'];
 				}
 					return $quant;
 			}
	$checkout=array();
		echo '<table><th>ID</th><th>Name</th><th>Price</th><th>Quantity</th><th>Image</th><th>Action</th>';

			if(isset($_SESSION['cart'])){
				$checkout=$_SESSION['cart'];
				$total_price=findPrice($checkout);
				$total_quantity=findQuant($checkout);
				$_SESSION['price']=$total_price;              
				$_SESSION['quantity']=$total_quantity;
					foreach($checkout as $x=>$y){
						echo '<tr><td>'.$y['id'].'</td>';
						echo '<td>'.$y['name'].'</td>';
						echo '<td>'.$y['price'].'</td>';
						echo '<td> <input type="number" class="qty" min="1" value='.$y['quant'].'></td>';
						echo '<td><img src="'.$y['image'].'"></td>';
						echo '<td><a class="Delete" href="" data-deleteid='.$y['id'].'> delete</a></td>';
						echo '<td><a class="Edit" href="" data-editid='.$y['id'].'> Edit</a></td>';

					}
						echo '<tr><td colspan="2">total price</td><td >'.$total_price.'</td></tr>';
							echo '</table>';
			}
					
	 		
		if(isset($_POST['order'])){
		$stmt = $conn->prepare("INSERT INTO placeorder (o_user,o_data,o_date,o_price) VALUES (?, ?, ?,?)");
		$stmt->bind_param("sssi",$user, $obj, $date,$total_price);

		$user= $_SESSION["role"];
		$obj= json_encode($_SESSION["cart"]);
		$date = date('Y/m/d H:i:s');
		


		$stmt->execute();
		$stmt->close();





	header("Location:thankyou.php");
		
 	}

?>
<html>
	<head>
	</head>
		<body>
		<script type="text/javascript" src="jquery.js"></script>
		<form action="" method="post">
		<input type="submit"  style="font-size:20px" name="order" value="place order">
		</form> 
		<div id="logout">
		<a href="task14.php?id=<?php echo $_SESSION['id']?>" style="font-size:20px" >Log Out</a>
		</div>
		<script type="text/javascript">
				$(document).ready(function(){
					$('.Delete').click(function(){
						var d_id=$(this).data('deleteid');

						$.ajax({method:"POST",
								url:"addcart.php",
									data:{dltid:d_id },
										dataType:"json"});
									

							

					});
					
						$('.Edit').click(function(){
							//e.preventDefault();
							var e_id=$(this).data('editid');
							$.ajax({
							method:"POST",
							url:"checkout.php",
							data:{edtid:e_id,val:$(this).parent().parent().find(".qty").val()},
						
							dataType:"json"

							    }).done(function(msg){
							    	alert("123");

							    });
							});
						});


				
		</script>
		</body>
		</html>