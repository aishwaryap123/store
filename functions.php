<?php 

function addProduct($product){
 global $conn;
 
				
	$nme=isset($product['name'])?$product['name']:"";
	$prc=isset($product['price'])?$product['price']:"";
	$img=isset($product['image'])?$product['image']:"";
	$ctg=isset($product['category'])?$product['category']:"";
	$tg=isset($product['tag'])?$product['tag']:"";
	$stmt=$conn->prepare("INSERT INTO PRODUCT (name,price,image,category,tags) values (?,?,?,?,?)");
				$stmt->bind_param("sssss",$nme,$prc,$img,$ctg,$tg);
				$execute=$stmt->execute();
				if(false===$execute){
					return false;
				}
				//$product_id=$stmt->insert_id;
				return $execute;
}
		function showCategory(){
			global $conn;
			$ctg=array();
			$stmt=$conn->prepare("SELECT * FROM Category");
			$stmt->bind_result($c_id,$c_name,$c_parent);
			$stmt->execute();
	                    while($stmt->fetch()){
						array_push($ctg,array('id'=>$c_id,'name'=>$c_name,'p_id'=>$c_parent));
								
							}
			$stmt->close();	
			return $ctg;
		}

	
			
			
			

		
		function showProduct(){
			global $conn;
			$products=array();
			$stmt= $conn->prepare("SELECT * FROM PRODUCT");
			$stmt->execute();
				$stmt->bind_result($r_id,$r_name,$r_price,$r_image,$r_cat,$r_tag);
					while($stmt->fetch()){
						array_push($products,array('id'=>$r_id,'name'=>$r_name,'price'=>$r_price,'image'=>$r_image,'category'=>$r_cat,'tags'=>$r_tag));
					}
					$stmt->close();
					return $products;

		}
		function countProduct(){
			global $conn;
			$stmt=$conn->prepare("SELECT count(id) FROM PRODUCT");
     		$stmt->bind_result($count);
      		$stmt->execute();
       		while($stmt->fetch()){
          	$total_record=$count;

        }
           	return $total_record;
		}
		function showMultipleCategory($check_array){
				global $conn;
					$cat_products=array();

                    foreach($check_array as $key){
                 
                    $stmt=$conn->prepare("SELECT * FROM PRODUCT WHERE category=?");
                    $stmt->bind_param("s",$key);
                    $stmt->execute();
                     $stmt->bind_result($ro_id,$ro_name,$ro_price,$ro_image,$ro_cat,$ro_tag);
                    
                   
                    while($stmt->fetch()){
                      array_push($cat_products,array('id'=>$ro_id,'name'=>$ro_name,'price'=>$ro_price,'image'=>$ro_image,'category'=>$ro_cat,'tags'=>$ro_tag));
                    }
                    return $cat_products;

		}
	}
			function showPagination($offset,$rec_limit){
				global $conn;
				$products=array();
					$stmt= $conn->prepare("SELECT * FROM PRODUCT LIMIT ?,?");
		                $stmt->bind_param("ii",$offset,$rec_limit);
		                    $stmt->execute();
		                        $stmt->bind_result($r_id,$r_name,$r_price,$r_image,$r_cat,$r_tag);
		                          while($stmt->fetch()){
		                   			 array_push($products,array('id'=>$r_id,'name'=>$r_name,'price'=>$r_price,'image'=>$r_image,'category'=>$r_cat,'tags'=>$r_tag));
		                  }
		                  return $products;

			}
			function addCategory(){
				$stmt=$conn->prepare("INSERT INTO Category(cat_name,parent_id) VALUES(?,?)");
				$stmt->bind_param('si',$catname,$pid);
				$stmt->execute();
				$stmt->close();
			}
?>
