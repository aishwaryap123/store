<?php session_start();?>
<?php include "../config.php"; ?>
<?php include "../functions.php"; ?>

<?php
	$cart=array();
	if(isset($_GET['id'])){
	$cart_id=$_GET['id'];
		if(isset($_SESSION['cart'])){
				$cart=$_SESSION['cart'];
		}
	
		//if product already present in cart
			if(productExistInCart($cart_id)){
				$cart=updateProduct($cart_id);
					$_SESSION['cart']=$cart;
					header("location:product.php");
		
			}
	
				else{
	   				$cart[]=getProduct($cart_id);
					$_SESSION['cart']=$cart;
					header("location:product.php");
				}
			

		
		}

	else if(isset($_POST['qty'])){
	$qty=$_POST['qty'];
	$cart=$_SESSION['cart'];
	$pro_id_Update=$_POST['hid'];
	$update_array=array_combine($pro_id_Update, $qty);
	foreach ($update_array as $key => $value) {
		foreach($cart as $x=>$y){
			foreach($y as $p=>$q){
				if($key==$cart[$x][$p]['id']){
					$cart[$x][$p]['quant']=$value;

				}
			}
		}
	}
	$_SESSION['cart']=$cart;
	
}
		else if (isset($_GET['d_id'])){
			$did=$_GET['d_id'];
			$cart=$_SESSION['cart'];
			foreach ($cart as $key => $value) {
				foreach ($value as $x => $y) {
					if($cart[$key][$x]['id']==$did){
						unset($cart[$key][$x]);
						reset($cart[$key]);
					}
				}
				# code...
			}
			$_SESSION['cart']=$cart;
		
				
			
		
	}
	if(isset($_SESSION['cart'])){
		$price=0;
		$cart=$_SESSION['cart'];
			foreach ($cart as $key => $value) {
				foreach ($value as $x => $y) {
				
			$price=$price+($cart[$key][$x]['quant']*$cart[$key][$x]['price']);
				
			}
			# code...
		}
			//echo $price;
				$_SESSION['total_price']=$price;
	}
	if(isset($_GET['pg'])){
	if($_GET['pg']=="product.php"){
		header("location:product.php");
	}
	else if($_GET['pg']=="cart.php" ){
		header("location:cart.php");
	}

	}
	else if (isset($_POST['qty'])){
		header("location:cart.php");

	}

?>
