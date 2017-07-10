<section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="active">Payment Notice</li>
        </ol>
      </div>

      <div class="step-one">
        <h2 class="heading">Order Detail</h2>
      </div>
      
           
                    <h2>Dear <?php echo $user->firstname ?>  <?php echo $user->lastname ?></h2>
                    <div>
                        <span style="float: right;">Order Status : 
                        <strong class="valid"><?php if($success['status']=='P') echo 'Pending';
                         elseif($success['status']=='PO') echo 'Processing';
                         elseif($success['status']=='S') echo 'Shipped';
                         elseif($success['status']=='D') echo 'Delivered'; ?></strong>
                        </span>
                    </div><br>
                    <span style="float: right;">OrderID : 
                        <strong><?php echo order_id_display($success['orderid']); ?>
                        </strong>
                    </span><br>
                
   

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
               
                <?php foreach ($order as $items): ?>

                    
            <tr>
              <td class="cart_product">
              <a href="<?php echo base_url(); ?>product_detail/<?php echo $items->productid; ?>">
              <img src="<?php echo base_url().USER_UPLOAD_PRODUCT_URL.$items->image_name; ?>" alt="" style="height: 100px;width: 150px;">
              </a>
              </td>
              <td class="cart_description">
                <h4><a href="<?php echo base_url(); ?>product_detail/<?php echo $items->productid; ?>"><?php echo $items->name; ?></a></h4>
              </td>
              <td class="cart_price">
                <p>$<?php echo $items->price; ?></p>
              </td>
                        
              <td class="cart_quantity">
                
                  
                 <p><?php echo $items->quantity; ?></p>
                  
                
              </td>
              <td class="cart_total">
                <p class="cart_total_price" >$<?php echo $subtotal=($items->quantity*$items->price); ?></p>
              </td>
              
            </tr>
          
           
            <?php $total=0; $total= $total+$subtotal; endforeach; 
                  
                  if($total<500){
                      $ship_total=$total+50;
                      $ship=50;
                      $shipping='$50';
                  }else{
                      $ship_total=$total+0;
                      $ship=0;
                      $shipping="Free";
                  }
                  ?>
            <input type = "hidden" id="subtotal" name = "subtotal" value = "<?php echo $total; ?>" />

            <tr>
              <td colspan="4">
                <table class="table table-condensed total-result">
                  <tr>
                    
                    <td>
                    <div class="col-xs-7">
                    
                   
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
                 
                  <tr>
                    <td>Sub Total</td>
                    <td id="total">$<?php echo number_format($total,2); ?></td>
                  </tr>
                  <tr>
                    <td>Discount %</td>
                    <td id="discount"><?php echo $per=$success['percent']; ?></td>
                  </tr>
                  <tr>
                    <td>Discount Amount</td>
                    <td id="discount_amt">$<?php echo $discout_amt=number_format(($per*$total)/100,2); ?></td>
                  </tr>
                  <tr class="shipping-cost">
                    <td>Shipping Cost</td>
                    <td><?php echo $shipping; ?></td>                   
                  </tr>
                  <tr>
                    <td >Total</td>
                    <td id="gr_total"><span>$<?php echo $success['amount']; ?></span></td>
                  </tr>
                  
                 </table>
              </td>
            </tr>
              
            
          </tbody>
        </table>

       </div>
       
       <input type = "hidden" name = "ship_cost" value = "<?php echo $ship; ?>" />

       <div class="payment-options paysize">

          <button type="submit" name="submit" id="payclick" class="btn btn-danger cart_inline payment" onclick="location.href='<?php echo base_url(); ?>site/checkout/order'">Back</button>
          
          <button type="submit" name="submit" id="payclick" class="btn btn-warning cart_inline payment" onclick="location.href='<?php echo base_url(); ?>'">Continue Shopping</button>
      
        </div>
              
    </div>
  </section> <!--/#cart_items-->
