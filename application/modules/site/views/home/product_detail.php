<section>
		<div class="container">
			<div class="row">

				<div class="col-sm-12 padding-right">
								<div class="product-details"><!--product-details-->
								<?php $cnt=1; foreach($product_detail as $detail){ ?>
									<div class="col-sm-4">
                                        <div class="view-product">
											<img src="<?php echo base_url().USER_UPLOAD_PRODUCT_URL.$detail->image_name; ?>" alt="" />
											
										</div>
										

									</div>
									<div class="col-sm-8">
										<div class="product-information"><!--/product-information-->
											
											<h2><?php echo $detail->name;?></h2>
											
											<?php 
											$is_added = is_added_cart($detail->id); 
                                            $is_wishlist = is_added_wishlist($detail->id); 
											?>
											<span>
												<span>US $<?php echo $detail->price;?></span>
												<label>Quantity:</label>
												<input id="<?php echo 'qty'.$detail->id; ?>" type="text" value="1" <?php if($is_added){ echo "disabled";} ?>/>
												<button type="button" class="btn btn-fefault cart multi_cart" <?php if($is_added){ echo "disabled";} ?> data-id="<?php echo $detail->id; ?>" data-price="<?php echo $detail->price; ?>" data-quantity="<?php echo $detail->quantity; ?>" data-name="<?php echo $detail->name; ?>" data-image="<?php echo $detail->image_name; ?>">
													<i class="fa fa-shopping-cart"></i>
													<?php if($is_added){ echo "Added to Cart";}else{echo "Add to Cart";} ?>
												</button>
												
									        </span>
									        
									        <a href="javascript:void(0);" class="add_wishlist_product <?php if($is_wishlist){ echo "added_wishlist";} ?>" data-id="<?php echo $detail->id; ?>" data-row="<?php echo $cnt; ?>" <?php if($is_wishlist){ echo "disabled";} ?>>
									        <span class="glyphicon glyphicon-heart glyphicon_align">
									        
									        </span>
									        </a>
										
											<br>
											<br>
											<br>
											<p><b>Availability:</b>
											
											
										  <span class='<?php if($detail->quantity==0){echo "required";}else{echo "valid";}?>'>

										  <?php if($detail->quantity==0){
												echo "Out of Stock";
											   }else{echo "In Stock"; 
										  }?>
										  
										  </span>
										  </p>
											<p><b>Detail:</b><?php echo $detail->short_description;?></p>
											<p><b>Feature:</b><?php echo $detail->long_description;?></p>
											
										</div><!--/product-information-->
									</div>
									<?php $cnt=$cnt+1;} ?>
								</div><!--/product-details-->
			     </div>

			</div>
		</div>
</section>