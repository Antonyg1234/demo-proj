<table cellpadding="6" cellspacing="0" style="width:554px">
  <tbody>
    <tr>
      <td>
      <h1>THANK YOU FOR YOUR ORDER FROM &nbsp;Shopping cart.</h1>

      <p>Once your package ships we will send an email with a link to track your order. Your order summary is below. Thank you again for your business.</p>
      </td>
      <td>
      <p><strong>Call Us:</strong>&nbsp;<a href="tel:">+91 - 22 - 40500699</a><br />
      <strong>Email:</strong>&nbsp;info@shoppingcompany.com</p>
      </td>
    </tr>
  </tbody>
</table>

<p>&nbsp;product_details</p>

<table cellpadding="6" cellspacing="0" style="width:554px">
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
  </tbody>
</table>

<table cellpadding="0" cellspacing="0" style="width:590px">
  <tbody>
    <tr>
      <td>
      <p>Total: gtotal</p>

      <table cellpadding="10" cellspacing="0" style="width:590px">
        <tbody>
          <tr>
            <td>
            <p>&nbsp;</p>

            <p>BILL TO:</p>

            <p><br />
            &nbsp;</p>

            <table cellpadding="7" cellspacing="0" style="width:559px">
              <tbody>
                <tr>
                  <td>
                  <p>User Address:U_add</p>
                  </td>
                  <td>
                  <p>&nbsp;</p>
                  </td>
                </tr>
                <tr>
                  <td>
                  <p>Billing Address:B_add</p>
                  </td>
                  <td>
                  <p>&nbsp;</p>
                  </td>
                </tr>
                <tr>
                  <td>
                  <p>Shipping Address:S_add</p>
                  </td>
                  <td>
                  <p>&nbsp;</p>
                  </td>
                </tr>
              </tbody>
            </table>

            <p><br />
            &nbsp;</p>
            </td>
          </tr>
          <tr>
            <td>
            <p>PAYMENT METHOD:paymnt_met</p>
            </td>
          </tr>
        </tbody>
      </table>

      <p><br />
      &nbsp;</p>
      </td>
    </tr>
  </tbody>
</table>

<p>&nbsp;</p>