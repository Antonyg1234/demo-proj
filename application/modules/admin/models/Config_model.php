<?php

/**
 * Login model contain login related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class Config_model extends CI_Model
{

    function __construct(){
        parent::__construct();
    }

    /*
     * function name :record_count
     *  To get no. of rows in user
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : number
     */

    public function record_count(){
        return $this->db->count_all("configuration");
    }
    
    /*
   * function name :get_user
   *  To get user in user table
   *
   * @author	Antony
   * @access	public
   * @param :
   * @return : number
   */

    public function get_config(){
        $post = $this->input->post();

        $total_display_records = $this->record_count();
        $search = $post['search']['value'];
        $start = $post['start'];
        $limit = $post['length'];
        $order = $post['order'][0]['dir'];

        $this->db->select('id,conf_key,conf_value,');
        $this->db->from('configuration');
        $this->db->where("conf_key LIKE '%$search%' OR conf_value LIKE '%$search%'");
        $this->db->order_by("conf_key $order,conf_value $order");
        $this->db->limit($limit, $start);
        $result = $this->db->get()->result();
        $final_array = array();
        foreach ($result as $r) {
            $user_array = array();
            $user_array['id'] = $r->id;
            $user_array['conf_key'] = $r->conf_key;
            $user_array['conf_value'] = $r->conf_value;
            $final_array[] = $user_array;
        }


        $finalJsonArray['draw'] = $post['draw'];
        $finalJsonArray['recordsTotal'] = $total_display_records;
        $finalJsonArray['recordsFiltered'] = $total_display_records;
        $finalJsonArray['data'] = $final_array;

        return $finalJsonArray;
    }
    
    /*
  * function name :delete_config
  * To delete data at id passed
  *
  * @author   Antony
  * @access   public
  * @param : number
  * @return : boolean
  */
    public function delete_config($data)
    {

        $this->db->where('id', $data);
        $this->db->delete('configuration');
        return true;
    }


    /*
     * function name :insert_user
     *  To insert Config
     *
     * @author	Antony
     * @access	public
     * @param : array
     * @return : none
     */
    
    public function insert_config($data){
        $this->db->insert('configuration', $data);
    }

    /*
     * function name :get_config_update
     *  To get configuration details
     *
     * @author	Antony
     * @access	public
     * @param : array
     * @return : none
     */
    
    public function get_config_update($id){
        $this->db->select('id,conf_key,conf_value');
        $this->db->from('configuration');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();
        //  echo $this->db->last_query();die;
        return $query;
    }
       /*
        * function name :get_config_update
        * To update configuration details
        *
        * @author	Antony
        * @access	public
        * @param : array
        * @return : none
        */
    public function update_config($data,$id){

        $this->db->where('id', $id);
        $this->db->update('configuration', $data);

    }
}