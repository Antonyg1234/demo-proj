<?php

/**
 * Password model contain password related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
   class Password_model extends CI_Model{

   function __construct(){
        parent::__construct();
    }

    /*
     * function name :check_password
     * To check password present or not 
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : boolean
     */

    public function check_password($pass,$id){
        $this->db->select("password,id");
        $whereCondition = array('password' =>$pass,'id ='=>$id);
        $this->db->where($whereCondition);
        $this->db->from('user');
        $result = $this->db->get()->row();
         //echo $this->db->last_query();die;
       // print_r($result);die();
        if ($result){
            return true;
        }
        else{
            return false;
        }

    }

     /*
     * function name :update_password
     * To update password  
     * @author  Antony
     * @access  public
     * @param : array
     * @return : 
     */

    public function update_password($data,$id){
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    } 


}
