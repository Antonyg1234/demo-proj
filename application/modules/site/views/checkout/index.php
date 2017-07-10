<section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="active">CheckOut</li>
        </ol>
      </div>

 
  <?php if(!($this->cart->contents())){ ?>
    <h3 style="text-align:center;color:#fe980f;">! No items for Checkout !</h3>
  <?php }else{ ?> 

      <div class="step-one">
        <h2 class="heading">Step1</h2>
      </div>
       
    <?php echo form_open('site/checkout', 'id="orderForm"', 'name="orderForm"','class="orderForm"'); ?>

      <div class="shopper-informations">
        <div class="row">
          <div class="col-sm-3">
            <div class="shopper-info">
              <p>Shopper Information</p>
               
                <input type="text" name="firstname" placeholder="First Name" value="<?php echo $user->firstname; ?>" class="order-input">
                <span class="required"> <?php echo form_error('firstname'); ?></span>

                <input type="text" name="lastname" placeholder="Last Name" value="<?php echo $user->lastname; ?>" class="order-input">
                <span class="required"> <?php echo form_error('lastname'); ?></span>
                
            </div>
          </div>
          <div class="col-sm-5 clearfix">
            <div class="bill-to">
              <p>Bill To</p>
              <div class="form-one">
                
                  <input type="text" name="email" placeholder="Email*" value="<?php echo $user->email; ?>" class="order-input">
                  <span class="required"><?php echo form_error('email'); ?></span>

                  <input type="text" name="add_firstname" placeholder="First Name *" value="<?php echo $address->firstname; ?>" class="order-input">
                  <span class="required"> <?php echo form_error('add_firstname'); ?></span>

                  <input type="text" name="add_lastname" placeholder="Last Name *" value="<?php echo $address->lastname; ?>" class="order-input">
                  <span class="required"> <?php echo form_error('add_lastname'); ?></span>

                  <input type="text" name="line1" placeholder="Address 1 *" value="<?php echo $address->address_1; ?>" class="order-input">
                  <span class="required"> <?php echo form_error('line1'); ?></span>

                  <input type="text" name="line2" placeholder="Address 2" value="<?php echo $address->address_2; ?>" class="order-input">
                  
                
              </div>
              <div class="form-two">
                
                  <input type="text" name="city" placeholder="City" value="<?php echo $address->city; ?>" class="order-input">
                  <span class="required"> <?php echo form_error('city'); ?></span>

                  <input type="text" name="zipcode" placeholder="Zip Code *" value="<?php echo $address->zipcode; ?>" class="order-input">
                  <span class="required"> <?php echo form_error('zipcode'); ?></span>

                  <select class="country order-input" name="country">
                   
                    <?php foreach ($country->result() as $row){?>
                    <option value="<?php echo $row->id;?>" <?php if($row->id==$address->countryid){echo 'selected="selected"'; } ?> ><?php echo $row->name;?></option>
                    <?php } ?>
                  </select>
                  <span class="required"> <?php echo form_error('country'); ?></span> 
                 
                    <select class="state order-input" name="state" id="state">
                    <?php foreach ($state->result() as $row){?>
                    <option value="<?php echo $row->id;?>" <?php if($row->id==$address->stateid){echo 'selected="selected"'; } ?> ><?php echo $row->name;?></option>
                    <?php } ?>
                    </select>
                    <span class="required"> <?php echo form_error('state'); ?></span>
                  
                  <input type="text" name="contactno" placeholder="Mobile Phone" value="<?php echo $address->contact_no; ?>" class="order-input">
                  <span class="required"> <?php echo form_error('contactno'); ?></span>
                  
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="order-message">
              <p>Shipping Order</p>
              <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
              <label><input name="shipping_bill" type="checkbox" checked="checked" value="1" disabled> Shipping to bill address</label>
            </div>  
          </div>          
        </div>
      </div>
      <div class="review-payment">
        <h2>Review & Payment</h2>
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

          
            
                    <?php $cnt=1;foreach ($this->cart->contents() as $items): ?>

                    
            <tr id=<?php echo 'row'.$cnt; ?>>
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
                  foreach ($this->cart->contents() as $items){
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
                    <input name="coupon" id="coupon" class="form-control" placeholder="Enter your Code" type="text" >
                    <input type = "hidden" name="coupon" id="coupon_hid" class="form-control" >
                    </div>
                    <button data-total="<?php echo $total; ?>" type="button" name="coupon" class="btn btn-warning cart_inline coupon_check"  >Check</button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div id="change_link" style="margin-left: 16px;display:none;">
                        <a id="change_code" href='javascript:void(0)' data-total="<?php echo $total; ?>" data-grtotal="<?php echo $ship_total; ?>">Click to Change Coupon Code</a>
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
          <span>Payment Method:  </span>
          <span>
            <label><input name="payment" type="radio" checked="checked" value="1"> COD</label>
          </span>
          <span>
            <label><input name="payment" type="radio" value="2"> Paypal</label>
          </span>
          <span class="required"> <?php echo form_error('payment'); ?></span>
          <button type="submit" name="submit" id="payclick" class="btn btn-success cart_inline payment" >Proceed to Payment</button>
      
        </div>
   <?php } ?>             
    </div>
  </section> <!--/#cart_items-->
