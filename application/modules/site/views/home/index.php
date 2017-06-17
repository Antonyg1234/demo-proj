<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">

                         <?php for($x=0; $x<count($slide); $x++) {?>
                         <li data-target="#slider-carousel" data-slide-to="<?php echo $x;?>" class="<?php if($x==0) echo 'active'; ?>"></li>
                         <?php }?>
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
                                            echo '<li><a href="'.base_url().'site/home/sub_category/'. $sub->id .'/'. $sub->name .'">' . $sub->name . '</a></li>';
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

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Featured Items</h2>

                    <?php $cnt=1;
                    foreach ($products as $category)
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
                                        <p><?php echo $category->name; ?></p>
                                       

                                </div>
                                <div class="product-overlay" >
                                <a href="<?php echo base_url(); ?>site/home/product_detail/<?php echo $category->id; ?>">
                                    <div class="overlay-content">
                                        <!--  <p>View detail</p> -->
                                        <h2>$<?php echo $category->price; ?></h2>
                                        <p><?php echo $category->name; ?></p>
                                        
                                        <?php
                                            $is_added = is_added_cart($category->id);
                                            $is_wishlist = is_added_wishlist($category->id);
                                        ?>

                                        <a href="javascript:void(0)" class="btn btn-default add-to-cart add_cart <?php if($is_added){ echo "disabled";} ?>" <?php if($is_added){ echo "disabled";} ?> data-id="<?php echo $category->id; ?>" data-price="<?php echo $category->price; ?>" data-name="<?php echo $category->name; ?>" 
                                            data-image="<?php echo $sub->image_name; ?>" >

                                    <i class="fa fa-shopping-cart" <?php if($is_added){ echo "disabled";} ?> ></i><?php if($is_added){ echo "Added to Cart";}else{echo "Add to Cart";} ?> </a>
                                        
                                    </div>
                                 </a>
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li ><a href="javascript:void(0)" class="add_wishlist <?php if($is_wishlist){ echo "added_wishlist";} ?>" <?php if($is_wishlist){ echo "disabled";} ?> data-id="<?php echo $category->id; ?> data-row="<?php echo $cnt; ?>"><?php if($is_wishlist){ echo "Added to wishlist";}else{echo "Add to wishlist";} ?>
                                        
                                       </a>
                                    </li>
                            
                                </ul> 
                            </div>
                        </div>
                    </div>

                    <?php $cnt=$cnt+1; }?>
                </div><!--features_items-->

            
                                                

                <div class="category-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs" id="category_nav">
                            <?php
                            foreach ($categories as $category)
                            { ?>
                                
                           <li class="category" data-id="<?php echo $category->id; ?>"><a><?php echo $category->parent_name; ?></a></li>
                               
                            <?php
                            }
                            ?>
                        </ul>
                    </div>


                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="ajaxCategory" >
                            <?php 
                            foreach ($products as $category)
                            {
                            ?>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                        <a href="<?php echo base_url(); ?>site/home/product_detail/<?php echo $category->id; ?>">
                                            <?php
                                            if(!empty($category->subs)) {
                                            foreach ($category->subs as $sub){ ?>
                                            <img style="height: 180px;" src="<?php echo base_url(); ?>/public/assets/images/uploads/product/<?php echo $sub->image_name; ?>" alt="" />
                                                <?php
                                            }
                                            } ?>
                                            <h2>$<?php echo $category->price; ?></h2>
                                            <p><?php echo $category->name; ?></p>
                                            <?php
                                            $is_added = is_added_cart($category->id);
                                            ?>
                                            <a href="javascript:void(0)" class="btn btn-default add-to-cart add_cart <?php if($is_added){ echo "disabled";} ?>" <?php if($is_added){ echo "disabled";} ?> data-id="<?php echo $category->id; ?>" data-price="<?php echo $category->price; ?>" data-name="<?php echo $category->name; ?>" data-image="<?php echo $sub->image_name; ?>" ><i class="fa fa-shopping-cart"></i><?php if($is_added){ echo "Added to Cart";}else{echo "Add to Cart";} ?> </a>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            
                        </div>
                    </div>

            </div>

        </div>
    </div>
</section> 