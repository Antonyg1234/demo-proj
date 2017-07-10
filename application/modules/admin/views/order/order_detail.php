<script src="<?php echo base_url(); ?>public/assets/js/admin/global.js"></script>
<div class="modal fade" id="order-detail" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Order Detail</h4>
                        </div>
                        <div class="modal-body">
                          <div class="table-responsive cart_info" >
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
                            
                            <tbody id="order_table">
                            <?php $total=0; foreach($order as $items){ ?>
                              <tr>
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
                                            
                                  <td class="cart_quantity">
                                    <p><?php echo $items->quantity; ?></p>
                                  </td>
                                  <td class="cart_total">
                                    <p class="cart_total_price" >$<?php echo $subtotal=($items->quantity*$items->price); ?></p>
                                  </td>
                               </tr>
                               
                           <?php $total=$total+$subtotal;}
                           
                           ?>
                               
                            <tr>
                                <td colspan="2">
                                  <table class="table table-condensed total-result">
                                    <tr>
                                      <td>
                                      <h4>Shipping: <?php if($total_cart->shipping_charges==0){echo "Free";}else{echo $total_cart->shipping_charges;} ?></h4>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                      <h4>Payment Gateway:<strong><?php echo $total_cart->name; ?></strong></h4>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                      <h4>Order Status: <strong class="valid"><?php if($total_cart->order_status =='P') echo 'Pending';
                                         elseif($total_cart->order_status=='PO') echo 'Processing';
                                         elseif($total_cart->order_status=='S') echo 'Shipped';
                                         elseif($total_cart->order_status=='D') echo 'Delivered'; ?></strong></h4>
                                      </td>
                                    </tr>
                                    
                                  </table>
                                </td>

                                <td colspan="4">
                                  <table class="table table-condensed total-result" id="total_cal">
                                   
                                    <tr>
                                      <td>Sub Total</td>
                                      <td id="total">$<?php echo $total; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Discount Amount</td>
                                      <td id="discount_amt">$<?php echo ($total+$total_cart->shipping_charges-$total_cart->grand_total); ?></td>
                                    </tr>
                                    
                                    <tr>
                                      <td >Total</td>
                                      <td id="gr_total"><span>$<?php echo $total_cart->grand_total; ?></span></td>
                                    </tr>
                                    
                                   </table>
                                </td>
                            </tr>


                             </tbody>
                          </table>
                        </div>


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                  </div>
                  
                </div>
            </div>