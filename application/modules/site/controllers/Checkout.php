<?php

/**
 *Checkout contain login related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class Checkout extends Site_Controller{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->library('paypal_lib');
        $this->load->model('site/checkout_model'); 
        $this->load->model('site/email_model'); 
    }

    /*
     * function name :index
     * To display checkout details 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    public function index(){
        if(!$this->session->userdata('site_user')){
        redirect('site/login');
        }else{
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('add_firstname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('add_lastname', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('line1', 'Address Line1', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('zipcode', 'Zipcode', 'required');
            
            if ($this->form_validation->run() == FALSE){
                $user_id=$this->session->userdata['site_user']['id'];    
                $data['address']=$this->checkout_model->get_address($user_id);
                $data['user']=$this->checkout_model->get_user($user_id);
                $data['country']=$this->checkout_model->get_country();
                $data['state']=$this->checkout_model->get_state();
                $this->render('index',$data);
            }else{
                $line1 = $this->input->post('line1');
                $line2 = $this->input->post('line2');
                $city = $this->input->post('city');
                $state = $this->input->post('state');
                $country = $this->input->post('country');
                $zipcode = $this->input->post('zipcode');
                $payment = $this->input->post('payment');
                $grandtotal = $this->input->post('grandtotal');
                $shipping = $this->input->post('ship_cost');
                $shipping_bill = $this->input->post('shipping_bill');
                $user_id=$this->session->userdata['site_user']['id'];
                $coupon = $this->input->post('coupon');
                $subtotal = $this->input->post('subtotal');

                if($subtotal<500){
                    $shipping=50;
                }else{
                    $shipping=0;
                }

                 if($coupon){
                      $check=$this->checkout_model->check_coupon($coupon);
                      
                      $discount_per=$check->percent_off;
                      $discout_amt=($subtotal*$discount_per)/100;

                      if($check){
                        $coupon_id=$check->id;
                      }else{
                        $coupon_id=0;
                      }
                 }else{
                    $coupon_id=0;
                 }
          
               
                 $data = array(
                  'user_id' => $user_id,
                  'billing_address_1' => $line1,
                  'billing_address_2' => $line2,
                  'billing_city' => $city,
                  'billing_state' => $state,
                  'billing_country' => $country,
                  'billing_zipcode' => $zipcode,
                  'coupon_id' => $coupon_id,
                  'grand_total' => $grandtotal,
                  'shipping_charges' => $shipping,
                  'payment_gateway_id' => $payment,
                  'order_status' => 'p',

                  'shipping_address_1' => $line1,
                  'shipping_address_2' => $line2,
                  'shipping_city' => $city,
                  'shipping_state' => $state,
                  'shipping_country' => $country,
                  'shipping_zipcode' => $zipcode,
                  
                  );
               
                $this->db->set('created_date', 'NOW()', FALSE);
                $orderid=$this->checkout_model->insert_user_order($data);
                
                    
                foreach ($this->cart->contents() as $items){
                    $data1[] = array(
                    'product_id' => $items['id'],
                    'amount' => $items['price'],
                    'quantity' => $items['qty'],
                    'user_id' => $user_id,
                    'order_id' => $orderid,
                    );
                }
                
                $this->checkout_model->insert_order_detail($data1);
               
                if($coupon_id>0){
                  $data2 = array(
                  'user_id' => $user_id,
                  'coupon_id' => $coupon_id,
                  'order_id' => $orderid,
                  );
                  $this->db->set('created_date', 'NOW()', FALSE);
                  $this->checkout_model->insert_coupon_used($data2);
                }

                if($payment==2){
                    $this->paypal($discout_amt,$shipping,$orderid,$discount_per);
                }else{
                    $this->success_cod($discount_per,$orderid);
                }
               
            }
        }
  }

     /*
     * function name :paypal
     * to call paypal transaction
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    function paypal($dis_amount,$shipping,$orderid){
        if(!$dis_amount){
        $dis_amount=0;
        }
        //echo $dis_amount;die();
        //Set variables for paypal form
        $returnURL = base_url().'site/checkout/success'; //payment success url
        $cancelURL = base_url().'site/sale/cart'; //payment cancel url
        //$notifyURL = base_url().'site/checkout/ipn'; //ipn url
        //get particular product data
       // $product = $this->product->getRows($id);
        $userID = 1; //current user id
        $logo = base_url().'uploads/logo.png';

        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);

        $this->paypal_lib->add_field('cmd','_cart');
        $this->paypal_lib->add_field('upload','1');
        $i=1;
        foreach ($this->cart->contents() as $items){
        
            //$this->paypal_lib->add_field('notify_url', $notifyURL);
            $this->paypal_lib->add_field('item_name_'.$i, $items['name']);
            $this->paypal_lib->add_field('custom_'.$i, $userID);
            $this->paypal_lib->add_field('item_number_'.$i, $items['id']);
            $this->paypal_lib->add_field('amount_'.$i, $items['price']); 
            $this->paypal_lib->add_field('quantity_'.$i, $items['qty']);
           $i++;
        } 
        $this->paypal_lib->add_field('discount_amount_cart', $dis_amount);
        $this->paypal_lib->add_field('shipping_1', $shipping); 
        $this->paypal_lib->add_field('custom', $orderid);
        $this->paypal_lib->add_field('custom_1', $dis_amount);  
        $this->paypal_lib->add_field('rm',2);
        // show($this->paypal_lib);     
        $this->paypal_lib->image($logo);
        
        $this->paypal_lib->paypal_auto_form();
    }

    /*
     * function name :success_cod
     * To display page on COD
     *
     * @author  Antony
     * @access  public
     * @param : variables
     * @return : none
     */   

    function success_cod($discount_per,$order_id){
        if(!$discount_per){
        $discount_per=0;
        }
     
        $user_id=$this->session->userdata['site_user']['id'];
        $data['cart']=$this->cart->contents();
        $this->cart->destroy();
        
        $data['user']=$this->checkout_model->get_user($user_id);
        $data['address']=$this->checkout_model->get_bill_address($order_id);
 

        foreach($data['cart'] as $items){
          $product_details.= '<table cellpadding="6" cellspacing="0" style="width:554px">'.
                  '<thead>'.
                     '<tr class="cart_menu">'.
                     '<td class="image">Item</td>'.
                     '<td class="description">Description</td>'.
                     '<td class="price">Price</td>'.
                     '<td class="quantity">Quantity</td>'.
                     '<td class="total">Sub-Total</td>'.
                     '</tr>'.
                  '</thead>'.
                  '<tbody>'.
                 '<tr>'.
                    '<td class="cart_product">'.
                    '<img src="'. base_url().USER_UPLOAD_PRODUCT_URL.$items['image_name'].'" alt="" style="height: 100px;width: 150px;">'.
                    '</td>'.
                    '<td class="cart_description">'.
                    '<h4><a href="">'. $items['name'] .'</a></h4>'.
                    '<p>Web ID: 1089772</p>'.
                    '</td>'.
                    '<td class="cart_price">'.
                    '<p>$'. $items['price'] .'</p>'.
                    '</td>'.
                    '<td class="cart_quantity">'.
                    '<p>'. $items['qty'] .'</p>'.
                    '</td>'.
                    '<td class="cart_total">'.
                    '<p class="cart_total_price" >$'. $items['subtotal'] .'</p>'.
                    '</td>'.
                 '</tr>'.
                '</tbody>'.
         '</table>';
        }

        $gtotal=$data['address']->grand_total;
        $billing_address='<span>'.
                         $data['address']->billing_address_1.',<br>'.$data['address']->billing_address_2.',<br>'.$data['address']->billing_city.',<br>'.$data['address']->statename.',<br>'.$data['address']->countryname.' - '.$data['address']->billing_zipcode.
                    '</span><br/>';

        $data1=array($product_details,$gtotal,$billing_address,$billing_address,$billing_address,'COD');
        $arr1=array('{product_details}','gtotal','U_add','B_add','S_add','paymnt_met');

        $admin_login=$this->email_model->template('order details');
        $subject=$admin_login->subject;
        $content=$admin_login->content;
        $var_content=str_replace($arr1,$data1,$content);
        //echo $var_content1;die();

         $order_email=array(
             'email'=>$data['user']->email,
             'subject'=>$subject,
             'content'=>$var_content,
              );
         
         $this->email_model->email($order_email);

         $admin_order_email=array(
             'email'=>ADMIN,
             'subject'=>$subject,
             'content'=>$var_content,
              );

        $this->email_model->email($admin_order_email);

        $data['success']=array(
          'amount'=> $grandtotal,
          'orderid'=> $order_id,
        );
        $data['per']=$discount_per;
        $data['pay']=1;
        $this->render('success', $data);
    }
    
    /*
     * function name :success
     * To lead to success page on payment through paypal
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
      function success(){

        //get the transaction data
        $paypalInfo = $this->input->post();
        //show($paypalInfo);
          
       // $data['item_number'] = $paypalInfo['item_number1']; 
        $data['txn_id'] = $paypalInfo["txn_id"];
        $data['payment_amt'] = $paypalInfo["payment_gross"];
        $data['custom'] = $paypalInfo["custom"];
        $data['per'] = $paypalInfo["custom1"];
        
        $order_id=$data['custom'];
        $user_id=$this->session->userdata['site_user']['id'];
        $data['cart']=$this->cart->contents();
        $this->cart->destroy();
        
        $data['user']=$this->checkout_model->get_user($user_id);
        $data['address']=$this->checkout_model->get_bill_address($order_id);
        $data['pay']=2;
        $data['success']=array(
          'orderid'=> $order_id,
        );
        $data1=array(
                'transaction_id' => $data['txn_id'],
                'order_status' => 'PO',
               );
        
        foreach($data['cart'] as $items){
          $product_details.= '<table cellpadding="6" cellspacing="0" style="width:554px">'.
                  '<thead>'.
                     '<tr class="cart_menu">'.
                     '<td class="image">Item</td>'.
                     '<td class="description">Description</td>'.
                     '<td class="price">Price</td>'.
                     '<td class="quantity">Quantity</td>'.
                     '<td class="total">Sub-Total</td>'.
                     '</tr>'.
                  '</thead>'.
                  '<tbody>'.
                 '<tr>'.
                    '<td class="cart_product">'.
                    '<img src="'. base_url().USER_UPLOAD_PRODUCT_URL.$items['image_name'].'" alt="" style="height: 100px;width: 150px;">'.
                    '</td>'.
                    '<td class="cart_description">'.
                    '<h4><a href="">'. $items['name'] .'</a></h4>'.
                    '<p>Web ID: 1089772</p>'.
                    '</td>'.
                    '<td class="cart_price">'.
                    '<p>$'. $items['price'] .'</p>'.
                    '</td>'.
                    '<td class="cart_quantity">'.
                    '<p>'. $items['qty'] .'</p>'.
                    '</td>'.
                    '<td class="cart_total">'.
                    '<p class="cart_total_price" >$'. $items['subtotal'] .'</p>'.
                    '</td>'.
                 '</tr>'.
                '</tbody>'.
         '</table>';
        }

        $gtotal=$data['address']->grand_total;
        $billing_address='<span>'.
                         $data['address']->billing_address_1.',<br>'.$data['address']->billing_address_2.',<br>'.$data['address']->billing_city.',<br>'.$data['address']->statename.',<br>'.$data['address']->countryname.' - '.$data['address']->billing_zipcode.
                    '</span><br/>';

        $dataa=array($product_details,$gtotal,$billing_address,$billing_address,$billing_address,'PAYPAL');
        $arr1=array('{product_details}','gtotal','U_add','B_add','S_add','paymnt_met');

        $admin_login=$this->email_model->template('order details');
        $subject=$admin_login->subject;
        $content=$admin_login->content;
        $var_content=str_replace($arr1,$dataa,$content);
        //echo $var_content1;die();

         $order_email=array(
             'email'=>$data['user']->email,
             'subject'=>$subject,
             'content'=>$var_content,
              );
         
         $this->email_model->email($order_email);

         $admin_order_email=array(
             'email'=>ADMIN,
             'subject'=>$subject,
             'content'=>$var_content,
              );

        $this->email_model->email($admin_order_email);

        $this->checkout_model->update_user_order($data1,$order_id);
        $this->render('success', $data);
     }

     
     
      /*
     * function name :cancel
     * To redirect to cancel page on failure
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
     function cancel(){
        $this->load->view('site/paypal/cancel');
     }

   

      /*
     * function name :get_state
     * To sort state detail on selecting country
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

     public function get_state(){
     $country_id = $this->input->post('country_id');
     //$country_id=101;
     $data=$this->checkout_model->get_state_select($country_id);
     foreach ($data as $key => $value) {
    
     $html.='<select class="state" name="state" id="state">'.'<option value="'.$value->id.'">'.$value->name.'</option></select>'; 

     }
     echo json_encode($html);
     //return $data;
     }

       /*
     * function name :coupon
     * To validate coupon and apply discount 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

     public function coupon(){
         $code = $this->input->post('code');
         $total = $this->input->post('total');
         //echo $code;die();
         $data=$this->checkout_model->check_coupon($code);
         //show($data);
         if($data){
         $quantity=$data->coupon;
         $dis_percent=$data->percent_off;
         $total=number_format($total,2);
         $discout_amt=number_format(($dis_percent*$total)/100,2);
             if($total<500){
                $ship_total=number_format($total+50,2);
                $shipping='$50';
             }else{
                $ship_total=$total+0;
                $shipping="Free";
             }
             $grand_total=number_format($ship_total-$discout_amt,2);
             
             if($quantity>0){
             $quantity=$quantity-1;
             $this->checkout_model->update_coupon($quantity,$code);


             $html.= '<tr>
                        <td>Cart Sub Total</td>
                        <td id="total">$'.$total.'</td>
                      </tr>
                      <tr>
                        <td>Discount %</td>
                        <td id="discount">'.$dis_percent.'</td>
                      </tr>
                      <tr>
                        <td>Discount Amount</td>
                        <td id="discount_amt">$'.$discout_amt.'</td>
                      </tr>
                      <tr class="shipping-cost">
                        <td>Shipping Cost</td>
                        <td>'.$shipping.'</td>                   
                      </tr>
                      <tr>
                        <td>Total</td>
                        <td id="gr_total"><span>$'.$grand_total.'</span></td>
                      </tr>
                      <input type = "hidden" id="grandtotal" name = "grandtotal" value = "'.$grand_total.'" />';
             echo json_encode($html);
            }else{
                echo 0;
            }
        }else{
           echo 0;
        }
         
     }

    /*
     * function name :coupon
     * To change coupon and apply discount 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

     public function coupon_change(){
         $code = $this->input->post('code');
         $data=$this->checkout_model->check_coupon($code);
         $quantity=$data->coupon;
         $quantity=$quantity+1;
         $this->checkout_model->update_coupon($quantity,$code);
         echo true;

     }

     /*
     * function name :order
     * To display order details 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    public function order(){
      $user_id=$this->session->userdata['site_user']['id'];
      $data['order']=$this->checkout_model->get_order($user_id);
      //var_dump($data);die();
      $this->render('order',$data);
    }

    /*
     * function name :order_view
     * To view particular order detail
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
      function order_view($id=0){
       // $id=$this->input->get('id');
        //echo $id;die();
        $user_id=$this->session->userdata['site_user']['id'];
        $data['order']=$this->checkout_model->get_order_detail($id);
        //show($data['order']);
        $data['address']=$this->checkout_model->get_bill_address($id);
        $data['user']=$this->checkout_model->get_user($user_id);
        $coupon_id=$data['order'][0]->coupon_id;
        $grandtotal=$data['order'][0]->grand_total;
        //show($data['order']);
        if($coupon_id>0){
            $check=$this->checkout_model->check_coupon_order($coupon_id);
            $percent_off=$check->percent_off;
        }else{
            $percent_off=0;
        }
             //echo $percent_off;die();

        $data['success']=array(
          'amount'=> $grandtotal,
          'orderid'=> $id,
          'status'=> $data['order'][0]->order_status,
          'percent'=>$percent_off,
         );
        //var_dump($data['success']);die();
        $this->render('order_view',$data);
        //get the transaction data
        
     }

     /*
     * function name :track
     * To track particular order detail
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : none
     */
      function track($id=0){
             $this->form_validation->set_rules('email', 'Email Id', 'trim|required');
             $this->form_validation->set_rules('orderid', 'Order Id', 'trim|required');
             if($this->form_validation->run() == FALSE){
                $this->render('track');
             }else{
                  $email = $this->input->post('email');
                  $orderid = $this->input->post('orderid');
                  $user_id=$this->checkout_model->check_mailid($email);
                  $userid=$user_id->id;
                  //show($userid);die();
                  if(!$user_id){
                    $this->session->set_flashdata('error_mail', 'Mail id does not exist');
                    redirect('track');
                  }else{
                      $start_id=substr($orderid,0,4);
                      $ord_id=substr($orderid,4);
                      $check_no= is_numeric($ord_id); 
                      $order=$this->checkout_model->check_orderid($ord_id,$userid);
                      //show($order);
                      if(($start_id!='ORD-')||(strlen($ord_id)!=3)||$check_no==false||(!$order)){

                        $this->session->set_flashdata('error', 'Not a valid OrderID');
                        redirect('track');
                      }else{
                         $status=is_status($order->order_status);
                        // echo $status;die();   
                        $msg='Your order status for OrderId: '.$orderid.' is '.$status;
                        $data=array(
                          'email'=>$email,
                          'orderid'=>$orderid,
                          'msg'=>$msg,
                            );
                        $this->render('track',$data);
                      }
                  }
             }
      
    } 

          
}