<?php session_start(); ?>
  
  <?php include ("../config.php"); ?> 
  <?php include ("../functions.php");?>
    <?php $page=basename($_SERVER['PHP_SELF']); ?>
  <?php include ("header.php"); ?>

  <!-- menu -->
  <?php //include ("menu.php");?>
  <?php 
   
    $rec_limit=6;
    //count total # of products
      $total_record=countProduct();
         $offset=0;
           $product_per_page=ceil($total_record/$rec_limit);
            if(isset($_GET['pg'])){
              $pg=$_GET['pg'];
            
                for ($i=1; $i <= $product_per_page ; $i++) {

                  if($pg==$i){

                    $offset= ($i-1)*$rec_limit;
                    
                   }
                 }

               }
               
               
                //to show multiple category wise.......
                  $min="";
                  $max="";
                    if(isset($_POST['submit'])){
                    $min=isset($_POST['minprice'])?$_POST['minprice']:20;
                    $max=isset($_POST['maxprice'])?$_POST['maxprice']:100;
                     echo $min;
                  


              if(isset($_POST['param']) && isset($_POST['minprice']) && isset($_POST['maxprice'])){
                     

                      $check_array=$_POST['param'];
                     // print_r($check_array);

                      
                         $cnt=countMultiple($check_array,$min,$max);
                         //echo $cnt;
                          $product_per_page=ceil($cnt/$rec_limit);



                         
                        $cat_products=showMultipleCategory($check_array,$offset,$rec_limit,$min,$max);
                         }
                         else if(isset($_POST['minprice'])){
                         $check_array=array();
                         $cnt=countMultiple($check_array,$min,$max);
                         $cat_products=showMultipleCategory($check_array,$offset,$rec_limit,$min,$max);
                                $product_per_page=ceil($cnt/$rec_limit);
                           }

                         }
                      
                          else if (isset($_GET['cat'])||isset($_get['min'])){
                           $arr=isset($_GET['cat'])?$_GET['cat']:array();
                             $cat=array();
                             $min=$_GET['min'];
                             $max=$_GET['max'];
                              if(!empty($arr)){
                                $cnt=countMultiple($arr,$min,$max);

                                  $cat=$arr;
                           }
                            else{
                            $cnt=countMultiple($arr,$min,$max);
                          }
                            $product_per_page=ceil($cnt/$rec_limit);
                              for ($i=1; $i <= $product_per_page ; $i++) {

                                if($pg==$i){

                                 $offset= ($i-1)*$rec_limit;
                    
                              }
                            }
                             $cat_products=showMultipleCategory($arr,$offset,$rec_limit,$min,$max);
                     
                            //  $product_per_page=ceil($cnt/$rec_limit);
                             
                     
                

                          }
                          
                          else{
                            //to show all products with pagination.....
                            $products=showPagination($offset,$rec_limit);
                          }
                            //to select all category....
                            $ctg=array();
                                $ctg=showCategory();
  ?>
                       
                       
                       
                       
                        
                       
                    
                     
                        


                    
  
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Fashion</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>         
          <li class="active">Women</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                  <label for="">Sort by</label>
                  <select name="">
                    <option value="1" selected="Default">Default</option>
                    <option value="2">Name</option>
                    <option value="3">Price</option>
                    <option value="4">Date</option>
                  </select>
                </form>
                <form action="" class="aa-show-form">
                  <label for="">Show</label>
                  <select name="">
                    <option value="1" selected="12">12</option>
                    <option value="2">24</option>
                    <option value="3">36</option>
                  </select>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
              <!-- start single product item -->
               <?php if(!isset($_POST['submit']) && !isset($_GET['cat'])){ ?>
              <?php  foreach($products as $key=>$value):?>

                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="../uploads/<?php 
                    echo $value['image'];?>" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn" href="addtocart.php?id=<?php echo $value['id'];?>"><?php 
                    echo $value['name'];?><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#"><?php 
                    echo $value['name'];?></a></h4>
                      <span class="aa-product-price"><?php 
                    echo $value['price'];?></span><span class="aa-product-price"><del><?php 
                    echo $value['price'];?></del></span>
                      <p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
                    </figcaption>
                  </figure>                         
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                  </div>
                  <!-- product badge -->
                  <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>
              <?php endforeach; 
                }
              else
              {
              ?>
              <?php  foreach($cat_products as $key=>$value){?>

                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="../uploads/<?php 
                    echo $value['image'];?>" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><?php 
                    echo $value['name'];?><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#"><?php 
                    echo $value['name'];?></a></h4>
                      <span class="aa-product-price"><?php 
                    echo $value['price'];?></span><span class="aa-product-price"><del><?php 
                    echo $value['price'];?></del></span>
                      <p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
                    </figcaption>
                  </figure>                         
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                  </div>
                  <!-- product badge -->
                  <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>
                   <?php } ?>
                <?php } ?>

                <!-- start single product item -->
               
                <!-- start single product item -->
                                
              </ul>
              <!-- quick view modal -->                  
              <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                          <img src="img/view-slider/medium/polo-shirt-1.png" class="simpleLens-big-image">
                                      </a>
                                  </div>
                              </div>
                              <div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                  </a>                                    
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                                  </a>

                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                                  </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3>T-Shirt</h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price">$34.99</span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                              <a href="#">S</a>
                              <a href="#">M</a>
                              <a href="#">L</a>
                              <a href="#">XL</a>
                            </div>
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="#" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div>
              <!-- / quick view modal -->   
            </div>
            <div class="aa-product-catg-pagination">
              <nav>
                <ul class="pagination">
                <?php
                $check_str="";
                if(isset($check_array)){
                foreach($check_array as $cat){
                  $check_str.="&cat[]=".$cat;
                } 
              }
              else if(isset($cat)){
                 $check_str="";
                foreach($cat as $cat){
                  $check_str.="&cat[]=".$cat;
                } 

              }
                ?>

             
              
                 
              
                 <?php for($i=1;$i<=$product_per_page;$i++): ?>  
                  <li><a href='product.php?pg=<?php echo $i?><?php echo $check_str;?><?php echo "&min=$min&max=$max"?>'><?php echo $i?></a></li>
                  <?php endfor; ?>
                  
                
                   </ul>
                   <?php
                
               ?>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <form method="post" action="product.php">
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
              <ul class="aa-catg-nav">
              <?php foreach ($ctg as $key=>$value):?>
              
             
                <li><input type="checkbox" name="param[]" value="<?php echo $value['name']?>"/><?php echo $value['name'] ?></li>
                    
               
              <?php endforeach;
                 
              ?>
            <!-- <button class="aa-filter-btn" value="submit" name="submit" type="submit">Filter</button> !-->
              </ul>
            </div>
            
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Tags</h3>
              <div class="tag-cloud">
                <a href="#">Fashion</a>
                <a href="#">Ecommerce</a>
                <a href="#">Shop</a>
                <a href="#">Hand Bag</a>
                <a href="#">Laptop</a>
                <a href="#">Head Phone</a>
                <a href="#">Pen Drive</a>
              </div>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>              
              <!-- price range -->
              <div class="aa-sidebar-price-range">
               
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <span id="skip-value-lower" class="example-val">30.00</span>
                  <input  type="hidden" id="skip-value-lower1" value="" name="minprice" class="example-val">
                 <span id="skip-value-upper" class="example-val">100.00</span>
                 <input type="hidden" id="skip-value-upper1" class="example-val" value="" name="maxprice">
                 <button class="aa-filter-btn" name="submit" type="submit">Filter</button>
               </form>
              </div>              

            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <div class="aa-color-tag">
                <a class="aa-color-green" href="#"></a>
                <a class="aa-color-yellow" href="#"></a>
                <a class="aa-color-pink" href="#"></a>
                <a class="aa-color-purple" href="#"></a>
                <a class="aa-color-blue" href="#"></a>
                <a class="aa-color-orange" href="#"></a>
                <a class="aa-color-gray" href="#"></a>
                <a class="aa-color-black" href="#"></a>
                <a class="aa-color-white" href="#"></a>
                <a class="aa-color-cyan" href="#"></a>
                <a class="aa-color-olive" href="#"></a>
                <a class="aa-color-orchid" href="#"></a>
              </div>                            
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Recently Views</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Top Rated Products</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div>
          </aside>
        </div>
       
      </div>
    </div>
  </section>
  <!-- / product category -->


  <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
            <form action="" class="aa-subscribe-form">
              <input type="email" name="" id="" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->

<?php include ("productfooter.php"); ?>



 
                 
                  
                         
                         


                        

                   
                
           

         
         
                    
      
                    
                  

                   
              

          
      
 

      
      

        
       
         
                

  