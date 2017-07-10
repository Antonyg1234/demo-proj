<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="<?php echo base_url(); ?>">Home</a></li>
				  <li class="active">Order Details</li>
				</ol>
			</div>
			<div class="table-responsive cart_info" id="no_cart_wish">
			    <?php if(!$order){ ?>
					<h3 style="text-align:center;color:#fe980f;">! No Orders Placed !</h3>
				<?php }else{ ?>	
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu" id="no_cart">
						
							<td class="image">OrderId</td>
							<td class="description">Status</td>
							<td class="price">Created Date</td>
							<td class="quantity">Total</td>
							<td class="quantity">Shipping</td>
							<td class="total">Action</td>
							
							
					</thead>
					<tbody>

					
            
                    <?php foreach ($order as $items): ?>

              			
						<tr>
							<td class="cart_product">
							  <p><?php $str = "ODR-";
                            if($items->id<9){
                                $pad=str_pad($str,6,"0");
                                echo $pad.$items->id;
                            }elseif($items->id<99){
                            $pad=str_pad($str,5,"0");
                                echo $pad.$items->id;
                            }elseif($items->id<999){
                            $pad=str_pad($str,4,"0");
                                echo $pad.$items->id;
                            } ?></p>
							</td>
							<td class="cart_description">
							  <p><?php if($items->order_status=='P') echo 'Pending';
							           elseif($items->order_status=='PO') echo 'Processing';
							           elseif($items->order_status=='S') echo 'Shipped';
							           elseif($items->order_status=='D') echo 'Delivered'; ?></p>
							</td>
							<td class="cart_price">
								<p><?php echo $items->created_date; ?></p>
							</td>
                            
                            <td class="cart_price" >
							   <p><?php echo $items->grand_total; ?></p>  
							</td>
							
							<td class="cart_price" >
							   <p><?php echo $items->shipping_charges; ?></p>  
							</td>
							
							<td class="cart_price">
								<a href="<?php echo base_url().'order_view/'.$items->id ?> "></i>view</a>
							</td>
						</tr>
                  

                    <?php  endforeach; ?> 
						
					</tbody>
				</table>
				<?php } ?>
			</div>
		</div>
	</section> <!--/#cart_items-->
