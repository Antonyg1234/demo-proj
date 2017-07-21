<?php
/*
     * function name :show
     * To display errors
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */
if(!function_exists('show')){
    function show($array = array()){
        echo "<pre>";
        print_r($array);
        exit;
    }
}

    /*
     * function name :token
     * To genrate a random string for password reset
     *
     * @author  Antony
     * @access  public
     * @param : none
     * @return : string
     */
if(!function_exists('token')){
    function token($array = array()){
    	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array();
        $alpha_length = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alpha_length);
            $password[] = $alphabet[$n];
        }
        return implode($password);
    }
}

 /*
     * function name :is_added_cart
     * To check product added present in cart
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : variable
     */
if(!function_exists('is_added_cart')){
    function is_added_cart($product_id = 0){
        $_CI = & get_instance();
        $disabled = false;
        foreach ($_CI->cart->contents() as $items){
            if($items['id'] == $product_id){
                $disabled = true;
            }
        }
        return $disabled;
    }
}

/*
     * function name :is_added_wishlist
     * To check product present in wishlist
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : variable
     */

if(!function_exists('is_added_wishlist')){
    function is_added_wishlist($product_id ){
        $_CI = & get_instance();
        $disabled = false;
        $user_id=$_CI->session->userdata['site_user']['id'];
        $_CI->db->select('product_id');
        $whereCondition =array('product_id' =>$product_id,'user_id'=>$user_id);
        $_CI->db->where($whereCondition);
        $query=$_CI->db->get('user_wish_list');
        //echo $query->num_rows();die;
        if($query->num_rows()>0){
           $disabled = true;
        }
      
        return $disabled;
    }
}

    /*
     * function name :count_wishlist
     * To get the count of product in wishlist of logged user
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : variable
     */
if(!function_exists('count_wishlist')){
    function count_wishlist($user_id){
        $_CI = & get_instance();
        $count = "";
        $_CI->db->select('id');
        $_CI->db->where('user_id',$user_id);
        $query=$_CI->db->get('user_wish_list');
        if($query->num_rows()>0){
           $count = $query->num_rows();
        }
      
        return $count;
    }
}

 /*
     * function name :order_id_display
     * To pad order id with string
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : string
     */

if(!function_exists('order_id_display')){
    function order_id_display($order_id){
        return $order_id = "ORD-".str_pad($order_id, 3, '0', STR_PAD_LEFT);
    }
}

 /*
     * function name :is_status
     * To check status of and resturn string
     *
     * @author  Antony
     * @access  public
     * @param : none
     * @return : string
     */

if(!function_exists('is_status')){
    function is_status($status=0){
        
        if($status=='P') $order_status='Pending';
           elseif($status=='PO') $order_status='Processing';
           elseif($status=='S') $order_status='Shipped';
           elseif($status=='D') $order_status='Delivered';
      
        return $order_status;
    }
}

 /*
     * function name :is_status
     * To check status of and resturn string
     *
     * @author  Antony
     * @access  public
     * @param : none
     * @return : string
     */

// if(!function_exists('is_stock')){
//     function is_stock($product_id=0){
//         $_CI = & get_instance();
//         $count = "";
//         $_CI->db->select('quantity');
//         $_CI->db->where('id',$product_id);
//         $query=$_CI->db->get('product');
//         if($query->num_rows()>0){
//            $count = $query->num_rows();
//         }
        
//         return $order_status;
//     }
// }