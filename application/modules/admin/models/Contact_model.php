<?php

/**
 * Contact model contain contact related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */

class Contact_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function record_count(){
          return $this->db->count_all("contact_us");
      }

    /*
     * function name :get_contact
     *  To get details from contact us table
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : number
     */

    public function get_contact(){
        $post = $this->input->post();
       // var_dump($post);die();
        $total_display_records = $this->record_count();
        $search = $post['search']['value'];
        $start = $post['start'];
        $limit = $post['length'];
        $order = $post['order'][0]['dir'];

        $this->db->select('id,name,email,contact_no,message,flag');
        $this->db->from('contact_us');
        $this->db->where("name LIKE '%$search%' ");
        $this->db->order_by("created_date","DESC");
        $this->db->order_by("name $order");
        $this->db->limit($limit, $start);
        $result = $this->db->get()->result();
        //var_dump($result);die();
        $final_array = array();
        foreach ($result as $r) {
            $user_array = array();
            $user_array['id'] = $r->id;
            $user_array['name'] = $r->name;
            $user_array['contact_no'] = $r->contact_no;
            $user_array['email'] = $r->email;
            $user_array['message'] = $r->message;
            if($r->flag==1){
                $user_array['flag'] = 'disabled';
                $user_array['reply'] = 'Replied';

            }else{
                $user_array['flag'] = '';
                $user_array['reply'] = 'Reply';

            }

            $final_array[] = $user_array;
        }
        //var_dump($final_array);die();

  
        $finalJsonArray['draw'] = $post['draw'];
        $finalJsonArray['recordsTotal'] = $total_display_records;
        $finalJsonArray['recordsFiltered'] = $total_display_records;
        $finalJsonArray['data'] = $final_array;

        return $finalJsonArray;
    }

    /*
     * function name :get_msg
     *  To diplay the message of id passed and reply the message 
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : variable
     */

    public function get_msg($id){
      $this->db->select('id,message,name,note_admin,email');
      $this->db->where('id', $id);
      $query = $this->db->get('contact_us')->row();
      return $query;
    }

    /*
     * function name :
     *  To insert admin's note on mail   
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : 
     */

    public function reply_note($data,$id){
      $this->db->where('id', $id); 
      $this->db->update('contact_us',$data);
    }

}