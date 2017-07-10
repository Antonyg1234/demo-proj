<?php

/**
 * Category model contain category related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class Category_model extends CI_Model
{

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

    public function record_count(){
        return $this->db->count_all("category");
    }
    
    /*
   * function name :get_category
   *  To get category list from category table
   *
   * @author	Antony
   * @access	public
   * @param :
   * @return : number
   */
    public function get_dropdown()
    {
        $this->db->select('parent_name,id');
        $query = $this->db->get('parent_category');
        //  echo $this->db->last_query();die;
        return $query;

    }


    public function get_category()
    {
        $post = $this->input->post();

        $total_display_records = $this->record_count();
        $search = $post['search']['value'];
        $start = $post['start'];
        $limit = $post['length'];
        $order = $post['order'][0]['dir'];

        $this->db->select('category.id,name,parent_name');
        $this->db->from('category');
        $this->db->join('parent_category', 'parent_category.id = category.parent_id');
        $this->db->where("name LIKE '%$search%' ");
        $this->db->order_by("parent_id",'ASC');
        $this->db->order_by("name $order");
        $this->db->limit($limit, $start);
        $result = $this->db->get()->result();
       
        $final_array = array();
        foreach ($result as $r) {
            $user_array = array();
            $user_array['id'] = $r->id;
            $user_array['name'] = $r->name;
            $user_array['parent_name'] = $r->parent_name;
            $final_array[] = $user_array;
        }


        $finalJsonArray['draw'] = $post['draw'];
        $finalJsonArray['recordsTotal'] = $total_display_records;
        $finalJsonArray['recordsFiltered'] = $total_display_records;
        $finalJsonArray['data'] = $final_array;

        return $finalJsonArray;
    }
   
    /*
  * function name :delete_category
  * To delete data at id passed
  *
  * @author   Antony
  * @access   public
  * @param : number
  * @return : boolean
  */
   
    public function delete_category($data){
        $this->db->where('id', $data);
        $this->db->delete('category');
        return true;
    }

    /*
     * function name :insert_category
     *  To insert Category
     *
     * @author	Antony
     * @access	public
     * @param : array
     * @return : none
     */
    public function insert_category($data){
        $this->db->insert('category', $data);
    }

    /*
     * function name :get_category_update
     *  To get category details 
     *
     * @author	Antony
     * @access	public
     * @param : array
     * @return : none
     */
    
    public function get_category_update($id){
        $this->db->select('category.id,parent_id,name,parent_name');
        $this->db->from('category');
        $this->db->join('parent_category', 'parent_category.id = category.parent_id');
        $this->db->where('category.id', $id);
        $query = $this->db->get()->row();
        //  echo $this->db->last_query();die;
        return $query;
    }
    /*
     * function name :update_update
     * To update category details at id passed
     *
     * @author	Antony
     * @access	public
     * @param : array/variable
     * @return : none
     */
    
    public function update_category($data,$id){
        $this->db->where('id', $id);
        $this->db->update('category', $data);

    }
}