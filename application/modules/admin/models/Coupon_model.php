<?php
/**
 * Coupon model contain coupon related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */

class Coupon_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    /*
     * function name :record_count
     *  To get no. of rows in product
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : number
     */
    public function record_count(){
        return $this->db->count_all("coupon");
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


    public function get_coupon()
    {
        $post = $this->input->post();

        $total_display_records = $this->record_count();
        $search = $post['search']['value'];
        $start = $post['start'];
        $limit = $post['length'];
        $order = $post['order'][0]['dir'];

        $this->db->select('id,code,percent_off,coupon,status');
        $this->db->from('coupon');
        $this->db->where("code LIKE '%$search%' ");
        $this->db->order_by("code $order");
        $this->db->limit($limit, $start);
        $result = $this->db->get()->result();

        $final_array = array();
        foreach ($result as $r) {
            $user_array = array();
            $user_array['id'] = $r->id;
            $user_array['code'] = $r->code;
            $user_array['percent_off'] = $r->percent_off;
            $user_array['coupon'] = $r->coupon;
            if($r->status==0){
                $user_array['status'] = 'inactive';
            }else{
                $user_array['status'] = 'active';
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
     * function name :insert_category
     *  To insert Category
     *
     * @author	Antony
     * @access	public
     * @param : array
     * @return : none
     */
    public function insert_coupon($data){
        $this->db->insert('coupon', $data);
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

    public function get_coupon_update($id){
        $this->db->select('id,code,percent_off,coupon,status');
        $this->db->from('coupon');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();
        //  echo $this->db->last_query();die;
        return $query;
    }
    /*
       * function name :update_update
       *  To update category details at id passed
       *
       * @author	Antony
       * @access	public
       * @param : array
       * @return : none
       */
    public function update_coupon($data,$id){
        $this->db->where('id', $id);
        $this->db->update('coupon', $data);

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

    public function delete_coupon($data){
        $this->db->where('id', $data);
        $this->db->delete('coupon');
        return true;
    }


}
