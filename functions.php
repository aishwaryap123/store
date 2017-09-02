<?php 
//session_start();

function addProduct($product){
 global $conn;
 
				
	$nme=isset($product['name'])?$product['name']:"";
	$prc=isset($product['price'])?$product['price']:"";
	$img=isset($product['image'])?$product['image']:"";
	$ctg=isset($product['category'])?$product['category']:"";
	$tg=isset($product['tag'])?$product['tag']:"";
	$stmt=$conn->prepare("INSERT INTO PRODUCT (name,price,image,category,tags) values (?,?,?,?,?)");
				$stmt->bind_param("sisss",$nme,$prc,$img,$ctg,$tg);
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
		function countMultiple($check_array,$min,$max){
				global $conn;
				$query1=array();
				
				$s="SELECT count(id) FROM PRODUCT ";
				if(!empty($check_array)){
				$sql_cat="WHERE category IN (";
					 foreach ($check_array as $value) {


        				$query1[]= "'$value'";

   					 }
   					  $query2= implode(',',$query1);
   					   $sql_cat.= $query2.") ";
   					     $s.=$sql_cat;
   					     


		}
		else{
			$sql_price="WHERE price>=$min AND price<=$max ";
			$s.=$sql_price;
		}
		 $stmt=$conn->prepare($s);

                   		 $stmt->bind_result($count_multiple);
                   		 $stmt->execute();
                   		 while($stmt->fetch()){
                    	$c_multiple=$count_multiple;
                    }
					return $c_multiple;
	}
		
		function showMultipleCategory($check_array,$offset,$rec_limit,$min,$max){
				global $conn;
				$cat_products=array();
			

					/////////
					
					$query1=array();
					$sql="SELECT * FROM PRODUCT WHERE price>=$min AND price<=$max";

					

					if(!empty($check_array)){
					$sql_cat=" AND category IN (";
					 foreach ($check_array as $value) {


        				$query1[]= "'$value'";
        			}

					    $query2= implode(',',$query1);
					    $sql_cat.= $query2.")";
					    $sql.=$sql_cat;
					}
					
					$sql.=" LIMIT ?,? ";

					
					

				    $stmt = $conn->prepare($sql);
				    $stmt->bind_param("ii", $offset,$rec_limit);
				    $stmt->execute();
                    $stmt->bind_result($ro_id,$ro_name,$ro_price,$ro_image,$ro_cat,$ro_tag);
                    
                   
                    while($stmt->fetch()){
                      array_push($cat_products,array('id'=>$ro_id,'name'=>$ro_name,'price'=>$ro_price,'image'=>$ro_image,'category'=>$ro_cat,'tags'=>$ro_tag));
                    }
                    $stmt->close();
                       return $cat_products;
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
			function productExistInCart($id){
				$cart=array();
				if (isset($_SESSION['cart'])){
					$cart=$_SESSION['cart'];
					//print_r($_SESSION['cart']);
						foreach($cart as $key=>$value){
							foreach($value as $x=>$y){

								if($y['id']==$id){
				
								return true;
							}
						}
					}
       			}
	return false;
}
			function updateProduct($id){
				$cart=array();
				if (isset($_SESSION['cart'])){
					$cart=$_SESSION['cart'];
					//print_r($_SESSION['cart']);
						foreach($cart as $key=>$value){
							foreach($value as $x=>$y){

								if($y['id']==$id){
								
								$cart[$key][$x]['quant']=$cart[$key][$x]['quant']+1;
									return $cart;
								}
							}
						}
       				}
				}


				
					
				
		
				
			function getProduct($id){
				global $conn;
				$cart=array();

				$stmt=$conn->prepare("SELECT * FROM PRODUCT WHERE id=?");
				$stmt->bind_param("i",$id);
				$stmt->bind_result($r_id,$r_name,$r_price,$r_image,$r_cat,$r_tag);
				$stmt->execute();
				while($stmt->fetch()){
					array_push($cart, array('id'=>$r_id,'name'=>$r_name,'price'=>$r_price,'image'=>$r_image,'quant'=>1));
				}
				return $cart;

			}
?>


        				
                    
                

    

  
   
                   
                   
                   
                   
                       
                   
                    

   
					
					
                 

		
	
			