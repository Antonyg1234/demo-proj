<?php

/**
 * Reports model contain reports related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class Reports_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    /*
     * function name :record_count
     *  To get no. of rows in category
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : number
     */


    public function get_user_report(){
        $this->db->select('COUNT(id) as user_registered,created_date');
        $this->db->group_by('created_date'); 
        $result=$this->db->get('user')->result();
        return $result;
    }

    public function get_coupon_report(){
        $this->db->select('COUNT(id) as user_registered,created_date');
        $this->db->group_by('created_date'); 
        $result=$this->db->get('coupons_used')->result();
        return $result;
    }

      public function get_sales_report(){
        $this->db->select('SUM(grand_total) as user_registered,created_date');
        $this->db->group_by('created_date'); 
        $result=$this->db->get('user_order')->result();
        return $result;
    }
}