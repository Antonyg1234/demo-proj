<?php

/**
 * Category model contain category related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class Cms_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    /*
     * function name :record_count
     *  To get no. of rows in cms table
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : number
     */

    public function record_count(){
        return $this->db->count_all("cms");
    }

     /*
     * function name :record_count
     *  To get no. of rows in category
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : number
     */

    public function get_cms(){

        $post = $this->input->post();

        $total_display_records = $this->record_count();
        $search = $post['search']['value'];
        $start = $post['start'];
        $limit = $post['length'];
        $order = $post['order'][0]['dir'];

        $this->db->select('id,title,content,meta_title,meta_discription,meta_keywords');
        $this->db->from('cms');
        $this->db->where("title LIKE '%$search%' ");
        $this->db->order_by("title $order");
        $this->db->limit($limit, $start);
        $result = $this->db->get()->result();
      // var_dump($result);die();
        $final_array = array();
        foreach ($result as $r) {
            $user_array = array();
            $user_array['id'] = $r->id;
            $user_array['title'] = $r->title;

            $user_array['content'] = substr($r->content,50,120).'..........';
            $user_array['meta_title'] = $r->meta_title;
            $user_array['meta_discription'] = $r->meta_discription;
            $user_array['meta_keywords'] = $r->meta_keywords;
            $final_array[] = $user_array;
        }


        $finalJsonArray['draw'] = $post['draw'];
        $finalJsonArray['recordsTotal'] = $total_display_records;
        $finalJsonArray['recordsFiltered'] = $total_display_records;
        $finalJsonArray['data'] = $final_array;

        return $finalJsonArray;
    }

     /*
     * function name :insert_cms
     * To insert cms data
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */
     public function insert_cms($data){
       $this->db->insert('cms',$data);
     }

    /*
     * function name :get_cms_update
     * To get cms data for update
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */
     public function get_cms_update($id){
       $this->db->select('id,title,content,meta_title,meta_discription,meta_keywords');
       $this->db->where('id',$id);
       $result = $this->db->get('cms')->row();
       return $result;
     }

      /*
     * function name :update_cms
     * To update cms data
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */
     public function update_cms($id,$data){
        $this->db->where('id',$id);
       $this->db->update('cms',$data);
     }

 /*
  * function name :delete_cms
  * To delete data at id passed
  *
  * @author   Antony
  * @access   public
  * @param : variable
  * @return : boolean
  */
   
    public function delete_cms($data){
        $this->db->where('id', $data);
        $this->db->delete('cms');
        return true;
    }
}