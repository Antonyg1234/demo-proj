<?php

/**
 * Banner model contain banner related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */

class Cron_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    /*
     * function name :get_order_ondate
     *  To get order detail on current date
     *
     * @author	Antony
     * @access	public
     * @param : variable
     * @return : array
     */
     public function get_order_ondate($date){
         $this->db->select('user_order.id,firstname,lastname,email,order_status,grand_total');
         $this->db->join('user','user.id=user_order.user_id');
         $this->db->where('user_order.created_date', $date);
         $query = $this->db->get('user_order');
         return $query->result();
     }

     /*
     * function name :get_order_ondate
     *  To get wish list detail on weekly date
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : array
     */
     public function get_wishlist($start_date,$end_date){
         //echo $start_date; echo $end_date;die();
         $this->db->select('user_wish_list.user_id,firstname,lastname,email,name,price');
         $this->db->join('user','user.id=user_wish_list.user_id');
         $this->db->join('product','product.id=user_wish_list.product_id');
         $this->db->where('user_wish_list.created_date >=', $end_date);
         $this->db->where('user_wish_list.created_date <=', $start_date);
         $query = $this->db->get('user_wish_list');
         return $query->result();
     }
 }