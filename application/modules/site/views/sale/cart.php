
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="<?php echo base_url(); ?>">Home</a></li>
				  <li class="active">Cart</li>
				</ol>
			</div>

			<div class="table-responsive cart_info" id="no_cart">
			        <?php if(!($this->cart->contents())){ ?>
					
							<h3 style="text-align:center;color:#fe980f;">! No items in the Cart !</h3>
								
				    <?php }else{ ?>	
			           
				<table class="table table-condensed">
					
					<thead>
						<tr class="cart_menu" >
							<td class="image">Item</td>
							<td class="description">Description</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Sub-Total</td>
							<td class="total">Remove</td>
						</tr>
					</thead>
					
					<tbody>


                    <?php $cnt=1;foreach ($this->cart->contents() as $items): ?>

              			
						<tr id=<?php echo 'row'.$cnt; ?>>
							<td class="cart_product">
							<img src="<?php echo base_url().USER_UPLOAD_PRODUCT_URL.$items['image_name']; ?>" alt="" style="height: 100px;width: 150px;">
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $items['name']; ?></a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>$<?php echo $items['price']; ?></p>
							</td>
                        
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up cart_update" data-id=<?php echo $items['id']; ?> data-price=<?php echo $items['price']; ?> data-row=<?php echo $cnt; ?> data-rowid=<?php echo $items['rowid']; ?> href="javascript:void(0)"> + </a>
									<input class="cart_quantity_input list" id=<?php echo 'qty'.$cnt; ?> type="text" name="quantity" value="<?php echo $items['qty']; ?>" autocomplete="off" size="2" disabled>
									<a class="cart_quantity_down cart_decrease" data-id=<?php echo $items['id']; ?> data-price=<?php echo $items['price']; ?> data-row=<?php echo $cnt; ?> data-rowid=<?php echo $items['rowid']; ?> href="javascript:void(0)"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price" id=<?php echo 'total'.$cnt; ?>>$<?php echo $items['subtotal']; ?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete delete_cart" data-id=<?php echo $items['id']; ?> data-row=<?php echo $cnt; ?> data-price=<?php echo $items['price']; ?>  data-rowid=<?php echo $items['rowid']; ?> href="javascript:void(0)"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                  

                    <?php $cnt=$cnt+1; endforeach; ?>
						
					</tbody>
					
				</table>
				<?php } ?>
			</div>
			

			<?php if(!($this->cart->contents())){ ?>
				 <div class="clearfix" style="margin-left: 200px;float:right;margin-top: -23px;">
                        <button type="submit" name="submit" class="btn btn-warning cart_inline"  onclick="location.href='<?php echo base_url(); ?>'">Continue Shopping</button>
                 </div>

            <?php }else{ ?>	
			        <div class="clearfix" style="margin-left: 200px;float:right;margin-top: -23px;" >
                        <button type="submit" name="submit" class="btn btn-warning cart_inline"  onclick="location.href='<?php echo base_url(); ?>'">Continue Shopping</button>
                        <button id="replace_nocart" type="button" name="back" class="btn btn-success cart_inline" onclick="location.href='<?php echo base_url(); ?>site/checkout'">Proceed to Checkout</button>
                    </div>
            <?php } ?>
		</div>
	</section> <!--/#cart_items-->

	