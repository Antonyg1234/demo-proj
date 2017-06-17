<section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="active">CheckOut</li>
        </ol>
      </div>
<?php echo "===============";?>
  <?php if(!($this->cart->contents())){ ?>
    <h3 style="text-align:center;color:#fe980f;">! No items for Checkout !</h3>
  <?php }else{ ?> 

      <div class="step-one">
        <h2 class="heading">Payment Complete</h2>
      </div>
   

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
                  ?>
            <input type = "hidden" id="subtotal" name = "subtotal" value = "<?php echo $total; ?>" />

            <tr>
              <td colspan="4">
                <table class="table table-condensed total-result">
                  <tr>
                    
                    <td>
                    <div class="col-xs-4">
                   <h2>Dear Member</h2>
                    <span>Your payment was successful, thank you for purchase.</span><br/>
                    <span>Item Number : 
                        <strong>322323</strong>
                    </span><br/>
                    <span>TXN ID : 
                        <strong>465654</strong>
                    </span><br/>
                    <span>Amount Paid : 
                        <strong>$<?php echo $success['amount']; ?></strong>
                    </span><br/>
                    <span>Payment Status : 
                        <strong class="valid">Success</strong>
                    </span><br/>
                    </div>
                   
                    </td>
                  </tr>
                  
                </table>
              </td>

              <td colspan="2">
                <table class="table table-condensed total-result" id="total_cal">
                 
                  <tr>
                    <td>Cart Sub Total</td>
                    <td id="total">$<?php echo number_format($total,2); ?></td>
                  </tr>
                  <tr>
                    <td>Discount %</td>
                    <td id="discount"><?php echo $dis_percent="0.00%"; ?></td>
                  </tr>
                  <tr>
                    <td>Discount Amount</td>
                    <td id="discount_amt">$<?php echo $discout_amt=number_format(($dis_percent*$total)/100,2); ?></td>
                  </tr>
                  <tr class="shipping-cost">
                    <td>Shipping Cost</td>
                    <td><?php echo $shipping; ?></td>                   
                  </tr>
                  <tr>
                    <td >Total</td>
                    <td id="gr_total"><span>$<?php echo $grand_total=number_format($ship_total-$discout_amt,2); ?></span></td>
                  </tr>
                  <input type = "hidden" id="grandtotal" name = "grandtotal" value = "<?php echo $grand_total=number_format($ship_total-$discout_amt,2); ?>" />
                 </table>
              </td>
            </tr>
              
            
          </tbody>
        </table>

       </div>
       
       <input type = "hidden" name = "ship_cost" value = "<?php echo $ship; ?>" />

      <div class="payment-options paysize">
          
          <button type="submit" name="submit" id="payclick" class="btn btn-warning cart_inline payment" >Continue Shopping</button>
      
        </div>
   <?php } ?>             
    </div>
  </section> <!--/#cart_items-->
