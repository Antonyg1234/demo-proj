<?php

/**
 * Order model contain order related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */

class Order_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function record_count(){
          return $this->db->count_all("user_order");
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

    public function get_order(){
        $post = $this->input->post();
       // var_dump($post);die();
        $total_display_records = $this->record_count();
        $search = $post['search']['value'];
        $start = $post['start'];
        $limit = $post['length'];
        $order = $post['order'][0]['dir'];

        $this->db->select('user_order.id,firstname,lastname,grand_total,billing_address_1,billing_address_2,billing_city,states.name as statename,countries.name as countryname,email,billing_zipcode,email,contact_no');
        $this->db->from('user_order');
        $this->db->join('user', 'user.id = user_order.user_id');
        $this->db->join('states', 'states.id = user_order.billing_state');
        $this->db->join('countries', 'countries.id = user_order.billing_country');
       $this->db->where("firstname LIKE '%$search%' ");
       $this->db->order_by("firstname $order");
       $this->db->limit($limit, $start);
        $result = $this->db->get()->result();
        //var_dump($result);die();
        $final_array = array();
        foreach ($result as $r) {
            $user_array = array();
            $user_array['id'] = $r->id;
            $user_array['order_id'] = order_id_display($r->id);
            $user_array['firstname'] = $r->firstname;
            $user_array['lastname'] = $r->lastname;
            $user_array['contact_no'] = $r->contact_no;
            $user_array['email'] = $r->email;
            $user_array['billing_address_1'] = $r->billing_address_1;
            $user_array['billing_address_2'] = $r->billing_address_2;
            $user_array['billing_city'] = $r->billing_city;
            $user_array['statename'] = $r->statename;
            $user_array['countryname'] = $r->countryname;
            $user_array['billing_zipcode'] = $r->billing_zipcode;
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
     *  To the message of id passed 
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : variable
     */

    public function get_order_detail($id){
      $this->db->select('order_details.id,order_details.quantity,name,image_name,price');
      $this->db->join('product', 'product.id = order_details.product_id');
      $this->db->join('product_images', 'product_images.product_id = product.id');
      $this->db->where('order_details.order_id', $id);
      $query = $this->db->get('order_details');
      return $query->result();
    }

    public function order_total($id){
        //echo $id;die();
        $this->db->select('name,order_status,grand_total,shipping_charges');
        $this->db->join('payment_gateway', 'payment_gateway.id=user_order.payment_gateway_id');
        $this->db->where('user_order.id', $id);
        $query=$this->db->get('user_order')->row();
        return $query;
    }

}