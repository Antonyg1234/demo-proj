<?php

/**
 * Login model contain login related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class User_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    public function get_user(){
        $this->db->select('user.id,firstname,lastname,email,role_name');
        $this->db->from('user');
        $this->db->join('roles', 'roles.id = user.roles');
        $result = $this->db->get()->result();
        // echo $this->db->last_query();die;
        return $result;
    }

    /*
* function name :delete_product
* To delete data at id passed
*
* @author   Antony
* @access   public
* @param : number
* @return : boolean
*/
    public function delete_user($data)
    {

        $this->db->where('id', $data);
        $this->db->delete('user');
        return true;
    }

}