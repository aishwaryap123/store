<?php  session_start();
$cart=array();
if(isset($_POST['qty'])){
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
	header("location:cart.php");
}

?>
