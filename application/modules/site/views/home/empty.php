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
                    <h2 class="title text-center"><?php echo $name;?></h2>
                     <h1 class="text-center theme">Coming Soon!!!!!</h1>

              
                </div><!--features_items-->

                
        </div>
    </div>
</section> 