<?php

/**
 * System model contain email template related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */

class System_model extends CI_Model{
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
          return $this->db->count_all("email_template");
      }

    /*
     * function name :get_template 
     *  To get email template details 
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : number
     */

    public function get_template(){
        $post = $this->input->post();

        $total_display_records = $this->record_count();
        $search = $post['search']['value'];
        $start = $post['start'];
        $limit = $post['length'];
        $order = $post['order'][0]['dir'];

        $this->db->select('id,title,subject,content');
        $this->db->from('email_template');
        $this->db->where("title LIKE '%$search%' ");
        $this->db->order_by("title $order");
        $this->db->limit($limit, $start);
        $result = $this->db->get()->result();
        
        $final_array = array();
        foreach ($result as $r) {
            $user_array = array();
            $user_array['id'] = $r->id;
            $user_array['title'] = $r->title;
            $user_array['subject'] = $r->subject;
            $user_array['content'] = $r->content;
            $final_array[] = $user_array;
        }


        $finalJsonArray['draw'] = $post['draw'];
        $finalJsonArray['recordsTotal'] = $total_display_records;
        $finalJsonArray['recordsFiltered'] = $total_display_records;
        $finalJsonArray['data'] = $final_array;

        return $finalJsonArray;
    }

    /*
     * function name :create_template 
     *  To create email template details 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : number
     */
    public function create_template($data){
      $this->db->insert('email_template',$data);
    }

     /*
     * function name :get_template
     * To get template data at id passed
     *
     * @author   Antony
     * @access   public
     * @param : number
     * @return : array
     */
    
    public function edit_template($id){
        $this->db->select('id,title,subject,content');
        $this->db->from('email_template');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();
        //  echo $this->db->last_query();die;
        return $query;
    }

    /*
     * function name :update_template
     *  To update template details at id passed
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */
    public function update_template($data,$id){
        $this->db->where('id', $id);
        $this->db->update('email_template', $data);

    }

     /*
      * function name :delete_template
      * To delete data at id passed
      *
      * @author   Antony
      * @access   public
      * @param : number
      * @return : boolean
      */
   
    public function delete_template($data){
        $this->db->where('id', $data);
        $this->db->delete('email_template');
        return true;
    }

}