<?php

/**
 * Address model contain address related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */ 

class Account_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * function name :get_address
     * To get user details
     *
     * @author	Antony
     * @access	public
     * @param : number
     * @return : array
     */

    public function get_account($id){
        $this->db->select('id,firstname,lastname,email,contact_no');
        $this->db->where('id', $id);
        $result = $this->db->get('user')->row();
        //  echo $this->db->last_query();die;
        return $result;
    }

      /*
     * function name :update_account
     * To update account details
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */

     public function update_account($data,$id){

        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
}