<?php

/**
 * User model contain user related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class User_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }
    /*
     * function name :record_count
     * To get no. of rows in user table
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : variable
     */
    
    public function record_count(){
        return $this->db->count_all("user");
    }

  /*
   * function name :get_dropdown
   *  To get dropdown list of user role
   *
   * @author    Antony
   * @access    public
   * @param :
   * @return : array
   */

    public function get_dropdown()
    {
        $this->db->select('role_name,id');
        $query = $this->db->get('roles');
        return $query;

    }

  /*
   * function name :get_user
   * To get user in user table
   *
   * @author  Antony
   * @access  public
   * @param :
   * @return : array
   */

    public function get_user(){
        $post = $this->input->post();

        $total_display_records = $this->record_count();
        $search= $post['search']['value'];
        $start = $post['start'];
        $limit = $post['length'];
        $order = $post['order'][0]['dir'];

        $this->db->select('user.id,firstname,lastname,email,role_name');
        $this->db->from('user');
        $this->db->join('roles', 'roles.id = user.roles');
        $this->db->where("firstname LIKE '%$search%' OR email LIKE '%$search%'");
        $this->db->order_by("created_date", "DESC");
        $this->db->order_by("firstname $order,lastname $order");
        $this->db->limit($limit, $start);
        $result = $this->db->get()->result();
        $final_array = array();
        foreach ($result as $r){
            $user_array = array();
            $user_array['id'] = $r->id;
            $user_array['firstname']    =   $r->firstname;
            $user_array['lastname']    =   $r->lastname;
            $user_array['email']    =   $r->email;
            $user_array['role']    =   $r->role_name;
            $final_array[]  =   $user_array;
        }

        $finalJsonArray['draw'] = $post['draw'];
        $finalJsonArray['recordsTotal'] = $total_display_records;
        $finalJsonArray['recordsFiltered'] = $total_display_records;
        $finalJsonArray['data'] = $final_array;

        return $finalJsonArray;
    }

    /*
     * function name :delete_user
     * To delete data at id passed
     *
     * @author   Antony
     * @access   public
     * @param : nvariable
     * @return : boolean
     */
    public function delete_user($data){
        $this->db->where('id', $data);
        $this->db->delete('user');
        return true;
    }


    /*
       * function name :insert_user
       *  To insert User
       *
       * @author	Antony
       * @access	public
       * @param : array
       * @return : none
       */

    public function insert_user($data)
    {
        $this->db->insert('user', $data);

    }

    /*
     * function name :get_user_update
     * To get user details for update
     *
     * @author	Antony
     * @access	public
     * @param : variable
     * @return : array
     */

    public function get_user_update($id){

        $this->db->select('user.id,firstname,lastname,email,roles,role_name');
        $this->db->from('user');
        $this->db->join('roles', 'roles.id = user.roles');
        $this->db->where('user.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    /*
     * function name :update_user
     * To update user details
     *
     * @author	Antony
     * @access	public
     * @param : variable
     * @return : none
     */
    
    public function update_user($data,$id){
        $this->db->where('id', $id);
        $this->db->update('user', $data);

    }
}