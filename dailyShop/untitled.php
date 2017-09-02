 <?php  if(!empty($_POST['param'])){ ?>
                   <?php for($i=1;$i<=$product_per_page;$i++):?>  
                  <li><a href="product.php?pg=<?php echo "$i&cat[]=men&cat[]=sports&cat[]=Electronics"?>"><?php echo $i;?></a></li>
                  <?php endfor;
                    }
  /////////////////////////
  if(isset($_POST["category"]))
         $data=array("cat_new"=>$_POST["category"]);
       if(isset($_GET["cat_new"]))$data=array("cat_new"=>$_GET["cat_new"]);   
       ///////////////////////
       $pageLink.= "<li><a href='select_by_filter.php?page_id=".$i."&". http_build_query($data)."'>$i</a></li>";           
       ///////////////////////
       /*()
                  else
                  { 
                   ?>
                   <?php for($i=1;$i<=$product_per_page;$i++):?>  
                   <li><a href="product.php?pg=<?php echo "$i";?>"><?php echo $i;?></a></li>
                    <?php endfor; } ?>
                    */
                    /////////////////////////////
                     global $conn;
    $products = array();

    $query1=array(); //as implode function works on array..

    $query= "SELECT * FROM products WHERE category IN (";
    

    foreach ($array as $value) {


        $query1[]= "'$value'";// cant put , here as it will give 1 extra so using implode..

    }

    $query2= implode(',',$query1);
    $query.= $query2.") LIMIT ?,?";

    $off=0;
    $num=8;


    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $off,$num);
    
    $stmt->bind_result($Pid, $Pname, $Pcategory, $Ptag, $Pprice, $Pimage);
    $stmt->execute();
    while ($stmt->fetch()){

        array_push($products,array('id'=>$Pid, 'name'=>$Pname, 'category'=>$Pcategory, 'tag'=>$Ptag, 'price'=>$Pprice, 'image'=>$Pimage));
    }
    
    return $products;
}////////////////////////
