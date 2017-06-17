<?php

/**
 * Address model contain address related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */ 

class Address_model extends CI_Model
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

    public function get_address($id){
        $this->db->select('user_address.id,firstname,lastname,contact_no,address_1,address_2,city,states.name as statename,countries.name as countryname,zipcode');
        $this->db->join('states', 'states.id = user_address.state');
        $this->db->join('countries', 'countries.id = user_address.country');
        $this->db->where('user_id', $id);
        $result = $this->db->get('user_address');
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
     * function name :insert_address
     *  To insert Address
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */
    public function insert_address($data){
        $this->db->insert('user_address', $data);
    }

     /*
     * function name :get_category_update
     *  To get address details to edit 
     *
     * @author  Antony
     * @access  public
     * @param : number
     * @return : object
     */
    
    public function get_address_update($id){
        $this->db->select('states.id as stateid,countries.id as countryid,firstname,lastname,contact_no,address_1,address_2,city,states.name as statename,countries.name as countryname,zipcode,default');
        $this->db->from('user_address');
        $this->db->join('states', 'states.id = user_address.state');
        $this->db->join('countries', 'countries.id = user_address.country');
        $this->db->where('user_address.id', $id);
        $query = $this->db->get()->row();
         // echo $this->db->last_query();die;
        return $query;
    }

     /*
     * function name :update_address
     * To update address details
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */

     public function update_address($data,$id){

        $this->db->where('id', $id);
        $this->db->update('user_address', $data);
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
    public function delete_address($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('user_address');
        return true;
        
    }


}