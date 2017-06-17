<?php

if(!function_exists('show')){
    function show($array = array()){
        echo "<pre>";
        print_r($array);
        exit;
    }
}

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