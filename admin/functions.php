<?php 
include ("config.php");
function addProduct($product){
 global $conn;
 
				
	$nme=isset($product['name'])?$product['name']:"";
	$prc=isset($product['price'])?$product['price']:"";
	$img=isset($product['image'])?$product['image']:"";
	$ctg=isset($product['category'])?$product['category']:"";
	$tg=isset($product['tag'])?$product['tag']:"";
	$stmt=$conn->prepare("INSERT INTO PRODUCT name,price,image,category,tags) values (?,?,?,?,?)");
				$stmt->bind_param("sssss",$nme,$prc,$img,$ctg,$tg);
				$execute=$stmt->execute();
				if(false===$execute){
					return false;
				}
				$product_id=$stmt->insert_id;
				return $product_id;
}
?>
