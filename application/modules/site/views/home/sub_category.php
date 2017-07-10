<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                            
                            <?php
                            $count =0;
                            foreach ($slide as $key){ 
                            $count =$count+1;
                                ?>
                                
                                <div class="item <?php if($count==1){echo active;} ?>">
                                        <div class="col-sm-6">
                                            <h1><span>E</span>-SHOPPER</h1>
                                            <h2>Free E-Commerce Template</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                            <button type="button" class="btn btn-default get">Get it now</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <img src="<?php echo base_url().USER_UPLOAD_URL; ?><?php echo $key->banner_path; ?>" class="img-responsive" />
                                            <img src="<?php echo base_url().USER_UPLOAD_URL; ?>pricing.png"  class="pricing" alt="" />
                                        </div>
                                </div>
                            
                            <?php } ?>
                      </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->


<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                        <?php
                        foreach ($categories as $category)
                        {
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#category<?php echo $category->id; ?>">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        <?php echo $category->parent_name; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="category<?php echo $category->id; ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <?php
                                        if(!empty($category->subs)) {
                                            foreach ($category->subs as $sub){
                                            echo '<li><a href="'.base_url().'category_product/'. $sub->id .'">' . $sub->name . '</a></li>';
                                        }
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                       <?php }?>
                    </div>


                </div>
            </div>
        
                    <?php 
                    foreach ($subproduct as $category)
                    {
                        $pagename=$category->subcategory_name;
                    }
                    ?>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                <?php echo $name_id=$subproduct->id; ?>
                    <h2 class="title text-center"><?php echo $pagename; ?></h2>

                    <?php $cnt=1;
                    foreach ($subproduct as $category)
                    {
                    ?>

                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                        <?php
                                        if(!empty($category->subs)) {
                                        foreach ($category->subs as $sub){ ?>
                                        <img style="height: 220px;" src="<?php echo base_url(); ?>public/assets/images/uploads/product/<?php echo $sub->image_name; ?>" alt="" />
                                        <?php
                                        }
                                        } ?>
                                        <h2>$<?php echo $category->price; ?></h2>
                                        <p><?php echo $category->productname; ?></p>
                                       

                                </div>
                                <div class="product-overlay">
                                 <a href="<?php echo base_url(); ?>product_detail/<?php echo $category->id; ?>">
                                    <div class="overlay-content">
                                        <h2>$<?php echo $category->price; ?></h2>
                                        <p><?php echo $category->productname; ?></p>
                                        <?php
                                            $is_added = is_added_cart($category->id);
                                            $is_wishlist = is_added_wishlist($category->id);
                                        ?>
                                        <a href="javascript:void(0)" class="btn btn-default add-to-cart add_cart" <?php if($is_added){ echo "disabled";} ?> data-id="<?php echo $category->id; ?>" data-price="<?php echo $category->price; ?>" data-quantity="<?php echo $category->quantity; ?>" data-name="<?php echo $category->productname; ?>" 
                                            data-image="<?php echo $sub->image_name; ?>" 

                                          s<i class="fa fa-shopping-cart"></i><?php if($is_added){ echo "Added to Cart";}else{echo "Add to Cart";} ?> </a>
                                        
                                    </div>
                                 </a>
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li ><a href="javascript:void(0)" class="add_wishlist <?php if($is_wishlist){ echo "added_wishlist";} ?>"  data-id="<?php echo $category->id; ?> data-row="<?php echo $cnt; ?>"><?php if($is_wishlist){ echo "Added to wishlist";}else{echo "Add to wishlist";} ?>
                                        
                                       </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <?php $cnt=$cnt+1; }?>
                </div><!--features_items-->

                
        </div>
    </div>
</section> 