<?php
/**
 * Checkout model contain address related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */ 


class Checkout_model extends CI_Model{


	     /*
	     * function name :get_address
	     * To get user details
	     *
	     * @author	Antony
	     * @access	public
	     * @param : number
	     * @return : array
	     */

	    public function get_address($id){
        $this->db->select('states.id as stateid,countries.id as countryid,user_address.id,firstname,lastname,contact_no,address_1,address_2,city,states.name as statename,countries.name as countryname,zipcode');
        $this->db->join('states', 'states.id = user_address.state');
        $this->db->join('countries', 'countries.id = user_address.country');
        $whereCondition =array('user_id' =>$id,'default'=>1);
        $this->db->where($whereCondition);
        $result = $this->db->get('user_address')->row();
         // echo $this->db->last_query();die;
        return $result;
    }


         /*
         * function name :get_address
         * To get user details
         *
         * @author  Antony
         * @access  public
         * @param : number
         * @return : array
         */

        public function get_bill_address($id){
        $this->db->select('user_order.id,billing_address_1,billing_address_2,billing_city,states.name as statename,countries.name as countryname,billing_zipcode');
        $this->db->join('states', 'states.id = user_order.billing_state');
        $this->db->join('countries', 'countries.id = user_order.billing_country');
        $this->db->where('user_order.id',$id);
        $result = $this->db->get('user_order')->row();
         // echo $this->db->last_query();die;
        return $result;
    }

      /*
     * function name :get_user
     * To get user details
     *
     * @author	Antony
     * @access	public
     * @param : number
     * @return : array
     */

    public function get_user($id){
        $this->db->select('id,firstname,lastname,email');
        $this->db->where('id', $id);
        $result = $this->db->get('user')->row();
        //  echo $this->db->last_query();die;
        return $result;
    }

        /*
     * function name :get_country
     * To get country list
     *
     * @author  Antony
     * @access  public
     * @param : 
     * @return : object
     */

      public function get_country(){
        $this->db->select('name,id');
        $query = $this->db->get('countries');
        //  echo $this->db->last_query();die;
        return $query;

    }

    /*
     * function name :get_state
     * To get state list
     *
     * @author  Antony
     * @access  public
     * @param : 
     * @return : object
     */

       public function get_state(){
        $this->db->select('name,id');
        $query = $this->db->get('states');
        //  echo $this->db->last_query();die;
        return $query;

    }

      /*
     * function name :get_state
     * To get state list
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : object
     */

       public function get_state_select($id){
        $this->db->select('name,id');
        $this->db->where('country_id', $id);
        $query = $this->db->get('states')->result();
        //  echo $this->db->last_query();die;
        return $query;

    }

       /*
     * function name :get_state
     * To get state list
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : object
     */

       public function check_coupon($code){
        $this->db->select('code,id,coupon,percent_off');
        $this->db->where('code', $code);
        $query = $this->db->get('coupon')->row();
        //return $query;
       //return $query->num_rows();
          if($query){
            return $query;
         }else{
         	return false;
         }
       }

        /*
         * function name :update_coupon
         * To change coupon
         *
         * @author  Antony
         * @access  public
         * @param : variable
         * @return : none
         */

       public function update_coupon($quantity,$code){

        $this->db->set('coupon', $quantity);
        $this->db->where('code', $code);
        $this->db->update('coupon');

    }

    /*
     * function name :insert_user_order
     *  To insert user billing detail
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : variable
     */
    public function insert_user_order($data){
        $this->db->insert('user_order', $data);
        $id = $this->db->insert_id();
        return $id;
    }

    /*
     * function name :insert_order_detail
     *  To insert order details
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */
    public function insert_order_detail($data){
        $this->db->insert_batch('order_details', $data);
        
    }

     /*
     * function name :insert_coupon_used
     *  To insert coupons used
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */
    public function insert_coupon_used($data){
        $this->db->insert('coupons_used', $data);
        
    }

    /*
     * function name :get_wishcart
     *  To update category details at id passed
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : none
     */
    public function get_wishcart($user_id){
        
        $this->db->select('product.id,name,price,image_name,quantity');
        $this->db->join('product_images', 'product_images.product_id = product.id');
        $this->db->join('user_wish_list', 'user_wish_list.product_id = product.id');
        $this->db->where('user_wish_list.user_id', $user_id);
        $query = $this->db->get('product');
       
        return $query->result();
    }
}