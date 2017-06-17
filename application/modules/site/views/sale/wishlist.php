
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="<?php echo base_url(); ?>">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info" id="no_cart_wish">
			    <?php if(!$data_id){ ?>
					<h3 style="text-align:center;color:#fe980f;">! No items in Wishlist !</h3>
				<?php }else{ ?>	
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu" id="no_cart">
						
							<td class="image">Item</td>
							<td class="description">Description</td>
							<td class="price">Price</td>
							<td class="quantity">Cart</td>
							<td class="total">Remove</td>
							
							
					</thead>
					<tbody>

					
            
                    <?php $cnt=1;foreach ($data_id as $items): ?>

              			
						<tr id=<?php echo 'row'.$cnt; ?>>
							<td class="cart_product">
							<img src="<?php echo base_url().USER_UPLOAD_PRODUCT_URL.$items->image_name; ?>" alt="" style="height: 100px;width: 150px;">
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $items->name; ?></a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>$<?php echo $items->price; ?></p>
							</td>
                            <?php $is_added = is_added_cart($items->id); ?>
                            <td class="cart_price" >
							      <button type="button" class="add_cart btn btn-warning" <?php if($is_added){ echo "disabled";} ?> data-id="<?php echo $items->id; ?>" data-price="<?php echo $items->price; ?>" data-name="<?php echo $items->name; ?>" 
                                            data-image="<?php echo $items->image_name; ?>"><?php if($is_added){ echo "Added to Cart";}else{echo "Add to Cart";} ?></button>
							</td>
							
							
							<td class="cart_delete">
								<a class="cart_quantity_delete delete_wishlist" data-id=<?php echo $items->id; ?> data-row=<?php echo $cnt; ?> href="javascript:void(0)"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                  

                    <?php $cnt=$cnt+1; endforeach; ?>
						
					</tbody>
				</table>
				<?php } ?>
			</div>
		</div>
	</section> <!--/#cart_items-->

	