<?php

/**
 * Login model contain login related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class Login_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }
    /*
     * function name :processLogin
     *  To verify and fetch data for valid user login
     *
     * @author	Antony
     * @access	public
     * @param : character
     * @return : array
     */
    
    function processLogin($email=NULL,$password){
        $this->db->select("id,firstname,lastname,email,password,roles");
        $whereCondition = $array = array('email' =>$email,'password'=>$password,'roles ='=>1);
        $this->db->where($whereCondition);
        $this->db->from('user');
        $result = $this->db->get()->row();
        // echo $this->db->last_query();die;
        return $result;
    }
}