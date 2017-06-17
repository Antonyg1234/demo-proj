<section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="<?php echo base_url(); ?>">Home</a></li>
                  <li class="active">Cart</li>
                </ol>
            </div>

            <div class="table-responsive cart_info" id="no_cart">
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
                                    
                                    <input class="cart_quantity_input list" id=<?php echo 'qty'.$cnt; ?> type="text" name="quantity" value="<?php echo $items['qty']; ?>" autocomplete="off" size="2" disabled>
                                    
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
            </div>
            

        </div>
    </section> <!--/#cart_items-->



<div>
    <h2>Dear Member</h2>
    <span>Your payment was successful, thank you for purchase.</span><br/>
    <span>Item Number : 
        <strong><?php echo $item_number; ?></strong>
    </span><br/>
    <span>TXN ID : 
        <strong><?php echo $txn_id; ?></strong>
    </span><br/>
    <span>Amount Paid : 
        <strong>$<?php echo $payment_amt.' '.$currency_code; ?></strong>
    </span><br/>
    <span>Payment Status : 
        <strong><?php echo $status; ?></strong>
    </span><br/>
</div>