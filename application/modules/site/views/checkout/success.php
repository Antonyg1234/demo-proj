<section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="active">Payment Notice</li>
        </ol>
      </div>

      <div class="step-one">
        <h2 class="heading"><?php if($pay==1){ echo "Order Placed"; }else{ echo "Payment Complete"; }?></h2>
      </div>

                    <h2>Dear <?php echo $user->firstname ?>  <?php echo $user->lastname ?></h2>
                    <div>
                    <?php if($pay==1){ ?>
                        <span>Your order is placed successfuly, thank you for purchase.</span>
                    <?php }else{ ?>
                       <span>Your payment was successful, thank you for purchase. Continue Shopping</span><br/>
                    <?php } ?>
                        <span style="float: right;">Order Status : 
                        <strong class="valid">Success</strong>
                        </span><br/>
                    </div><br/>
                    <span style="float: right;">OrderID : 
                        <strong><?php echo order_id_display($success['orderid']); ?>
                        </strong>
                    </span><br/>
                
   

     <div class="table-responsive cart_info">
        <table class="table table-condensed">
          <thead>
            <tr class="cart_menu">
              <td class="image">Item</td>
              <td class="description">Description</td>
              <td class="price">Price</td>
              <td class="quantity">Quantity</td>
              <td class="total">Sub-Total</td>
            </tr>
          </thead>
          <tbody>
               
                <?php $cnt=1;foreach ($cart as $items): ?>

                    
            <tr id=<?php echo 'row'.$cnt; ?> >
              <td class="cart_product">
              <a href="<?php echo base_url(); ?>product_detail/<?php echo $items['id']; ?>">
              <img src="<?php echo base_url().USER_UPLOAD_PRODUCT_URL.$items['image_name']; ?>" alt="" style="height: 100px;width: 150px;">
              </a>
              </td>
              <td class="cart_description">
                <h4><a href="<?php echo base_url(); ?>product_detail/<?php echo $items['id']; ?>"><?php echo $items['name']; ?></a></h4>
              </td>
              <td class="cart_price">
                <p>$<?php echo $items['price']; ?></p>
              </td>
                        
              <td class="cart_quantity">
                
                  
                 <p><?php echo $items['qty']; ?></p>
                  
                
              </td>
              <td class="cart_total">
                <p class="cart_total_price" id=<?php echo 'total'.$cnt; ?>>$<?php echo $items['subtotal']; ?></p>
              </td>
              
            </tr>
          

            <?php $cnt=$cnt+1; endforeach; 
                  $total=0; 
                  foreach ($cart as $items){
                        $total= $total+$items['subtotal'];
                  }
                  if($total<500){
                      $ship_total=$total+50;
                      $ship=50;
                      $shipping='$50';
                  }else{
                      $ship_total=$total+0;
                      $ship=0;
                      $shipping="Free";
                  }
                  if($payment_amt){
                    $discout_amt=$ship_total-$payment_amt;
                  }else{
                    $dis=$per;
                  }
                  ?>
            <input type = "hidden" id="subtotal" name = "subtotal" value = "<?php echo $total; ?>" />

            <tr>
              <td colspan="4">
                <table >
                  <tr>
                    
                    <td>
                    <div class="col-xs-12">
                    
                    <span>Billing Address : 
                    </span><br/>
                      <span>
                        <?php echo $address->billing_address_1.',<br>'.$address->billing_address_2.',<br>'.$address->billing_city.',<br>'.$address->statename.',<br>'.$address->countryname.' - '.$address->billing_zipcode; ?>
                    </span><br/>
                    
                    </div>
                   
                    </td>
                  </tr>
                  
                </table>
              </td>

              <td colspan="2">
                <table class="table table-condensed total-result" id="total_cal">
                 <?php if($payment_amt){ ?>
                  <tr>
                    <td>TXN ID : </td>
                    <td id="total"><strong><?php echo $txn_id; ?></strong></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td>Sub Total</td>
                    <td id="total">$<?php echo number_format($total,2); ?></td>
                  </tr>
                  <?php if($payment_amt){ ?>
                  <tr>
                    <td>Discount Amount</td>
                    <td id="discount_amt">$<?php echo $discout_amt; ?></td>
                  </tr>
                  <?php }else{ ?>
                    <tr>
                    <td>Discount %</td>
                    <td id="discount"><?php echo $dis; ?></td>
                  </tr>
                  <tr>
                    <td>Discount Amount</td>
                    <td id="discount_amt">$<?php echo $discout_amt=number_format(($dis*$total)/100,2); ?></td>
                  </tr>
                 <?php } ?>
                  <tr class="shipping-cost">
                    <td>Shipping Cost</td>
                    <td><?php echo $shipping; ?></td>                   
                  </tr>
                  <tr>
                    <td >Total</td>
                    <td id="gr_total"><span>$<?php echo $grand_total=number_format($ship_total-$discout_amt,2); ?></span></td>
                  </tr>
                  
                 </table>
              </td>
            </tr>
              
            
          </tbody>
        </table>

       </div>
       
       <input type = "hidden" name = "ship_cost" value = "<?php echo $ship; ?>" />

       <div class="payment-options paysize">
          
          <button type="submit" name="submit" id="payclick" class="btn btn-warning cart_inline payment" onclick="location.href='<?php echo base_url(); ?>'">Continue Shopping</button>
      
        </div>
              
    </div>
  </section> <!--/#cart_items-->
