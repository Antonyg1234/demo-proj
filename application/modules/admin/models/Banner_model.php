<?php

/**
 * Banner model contain banner related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */

class Banner_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    /*
     * function name :insert_banner
     *  To insert banners details in table
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */
    
     public function insert_banner($data){
         $this->db->insert('banners', $data);
     }

    /*
     * function name :record_count
     * To get no. of rows in banner table
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : variable
     */

      public function record_count(){
          return $this->db->count_all("banners");
      }

    /*
     * function name :get_banner
     *  To get banner details from banner table
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : array
     */

    public function get_banner(){
        $post = $this->input->post();

        $total_display_records = $this->record_count();
        $search = $post['search']['value'];
        $start = $post['start'];
        $limit = $post['length'];
        $order = $post['order'][0]['dir'];

        $this->db->select('id,banner_name,banner_path,status');
        $this->db->from('banners');
        $this->db->where("banner_name LIKE '%$search%' ");
        $this->db->order_by("id", "DESC");
        $this->db->order_by("banner_name $order");
        $this->db->limit($limit, $start);
        $result = $this->db->get()->result();
        $final_array = array();
        foreach ($result as $r) {
            $user_array = array();
            $user_array['id'] = $r->id;
            $user_array['banner_path'] = $r->banner_path;
            $user_array['banner_name'] = $r->banner_name;
            if($r->status==1){
            $user_array['status'] = 'active';
            }else{
            $user_array['status'] = 'inactive';
            }
            $final_array[] = $user_array;
        }


        $finalJsonArray['draw'] = $post['draw'];
        $finalJsonArray['recordsTotal'] = $total_display_records;
        $finalJsonArray['recordsFiltered'] = $total_display_records;
        $finalJsonArray['data'] = $final_array;

        return $finalJsonArray;
    }

    /*
     * function name :delete_banner
     * To delete data at id passed
     *
     * @author   Antony
     * @access   public
     * @param : number
     * @return : boolean
     */
    
    public function delete_banner($data){
        $this->db->where('id', $data);
        $this->db->delete('banners');
        return true;
    }
    
    /*
     * function name :get_banner_update
     * To get data at id passed
     *
     * @author   Antony
     * @access   public
     * @param : variable
     * @return : array
     */
    
    public function get_banner_update($id){
        $this->db->select('id,banner_name,banner_path,status');
        $this->db->from('banners');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();
        return $query;
    }
    /*
     * function name :update_banner
     * To update data at id passed
     *
     * @author   Antony
     * @access   public
     * @param : array/variable
     * @return : array
     */

    public function update_banner($data,$id){
        $this->db->where('id', $id);
        $this->db->update('banners', $data);
    }
}
