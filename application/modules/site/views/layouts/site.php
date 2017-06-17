<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="<?php echo base_url(); ?>public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/price-range.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/stylesheet.css">
    <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>public/site_asset/js/html5shiv.js"></script>
    <script src="<?php echo base_url(); ?>public/site_asset/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/assets/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>public/assets/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>public/assets/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>public/assets/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>public/assets/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>public/assets/images/home/logo.png" alt="" /></a>
                    </div>
                    
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                        <?php if ($this->session->userdata('site_user')){ ?>
                            <li><a href="<?php echo base_url();?>site/account"><i class="fa fa-user"></i> 
                            <?php echo $this->session->userdata['site_user']['firstname']?> 
                            <?php echo $this->session->userdata['site_user']['lastname']?>
                            
                            </a></li>
                            <li><a href="<?php echo base_url();?>site/sale/wishcart"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="<?php echo base_url();?>site/checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a href="<?php echo base_url();?>site/sale/cart"><i class="fa fa-shopping-cart"></i>Cart</a></li> 
                            <li><a href="<?php echo base_url();?>site/login/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
                            <?php }else{ ?>
                            <li><a href="<?php echo base_url();?>site/sale/cart" id="ajaxCart"><i class="fa fa-shopping-cart"></i>Cart</a></li>
                            <li><a href="<?php echo base_url(); ?>login"><i class="fa fa-lock"></i> Login</a></li>
                            <?php } ?>
                         
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                         <!--   <li><a href="<?php echo base_url(); ?>" class="active">Home</a></li>
                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Products</a></li>
                                    <li><a href="product-details.html">Product Details</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="<?php echo base_url(); ?>login">Login</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="404.html">404</a></li>
                            <li><a href="contact-us.html">Contact</a></li> -->
                        </ul>
                    </div>
                </div>
                <!--<div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search"/>
                    </div>
                </div> -->
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?php echo $content;?>
</div>
<!-- /.content-wrapper -->


<footer id="footer" style="margin-top: 30px;"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2><span>e</span>-shopper</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="<?php echo base_url(); ?>public/assets/images/home/iframe1.png" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="<?php echo base_url(); ?>public/assets/images/home/iframe2.png" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="<?php echo base_url(); ?>public/assets/images/home/iframe3.png" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="<?php echo base_url(); ?>public/assets/images/home/iframe4.png" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="address">
                        <img src="<?php echo base_url(); ?>public/assets/images/home/map.png" alt="" />
                        <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Service</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Online Help</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Change Location</a></li>
                            <li><a href="#">FAQ’s</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Quock Shop</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">T-Shirt</a></li>
                            <li><a href="#">Mens</a></li>
                            <li><a href="#">Womens</a></li>
                            <li><a href="#">Gift Cards</a></li>
                            <li><a href="#">Shoes</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Policies</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privecy Policy</a></li>
                            <li><a href="#">Refund Policy</a></li>
                            <li><a href="#">Billing System</a></li>
                            <li><a href="#">Ticket System</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Company Information</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Store Location</a></li>
                            <li><a href="#">Affillate Program</a></li>
                            <li><a href="#">Copyright</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <form action="#" class="searchform">
                            <input type="text" placeholder="Your email address" />
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            <p>Get the most recent updates from <br />our site and be updated your self...</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->

<script src="<?php echo base_url(); ?>public/assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/jquery.scrollUp.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/price-range.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/site/home.js"></script>
<script> 
var base_url= '<?php echo base_url(); ?>';
//var product_url= base_url+'public/assets/images/uploads/product/';
var js_url = base_url+'site/home/category_product';
var cart_url = base_url+'site/sale';
var ajax_url = base_url+'public/assets/images/uploads/product/';
var update_url = base_url+'site/sale/update_cart';
var decrease_url = base_url+'site/sale/decrease_cart';
var remove_url = base_url+'site/sale/remove_cart';
var multi_url = base_url+'site/sale/multi_cart';
var wish_url = base_url+'site/sale/wishlist';
var login_url = base_url+'login';
var delete_url = base_url+'site/sale/delete_wishcart';
var country_url = base_url+'site/checkout/get_state';
var coupon_url = base_url+'site/checkout/coupon';
var changecoupon_url = base_url+'site/checkout/coupon_change';
</script>
<script src="<?php echo base_url(); ?>public/assets/js/site/validation.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/admin/function.js"></script>
</body>
</html>