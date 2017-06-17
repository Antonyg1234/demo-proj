<?php

/**
 * Product model contain product related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */

class Product_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

  

  /*
   * function name :get_category
   *  To get category list from category table
   *
   * @author    Antony
   * @access    public
   * @param :
   * @return : object
   */
    public function get_dropdown()
    {
        $this->db->select('name,id');
        $query = $this->db->get('category');
        //  echo $this->db->last_query();die;
        return $query;

    }

    /*
   * function name :insert_product
   * To insert product details in product table
   *
   * @author    Antony
   * @access    public
   * @param :  array
   * @return : variable
   */

    public function insert_product($data)
    {

        $this->db->insert('product', $data);
        $id = $this->db->insert_id();
        return $id;
    }

  /*
   * function name :insert_product_cat
   *  To insert product category details in product category table
   *
   * @author    Antony
   * @access    public
   * @param : array
   * @return : none
   */
    public function insert_product_cat($data1,$data2)
    {
        $this->db->insert_batch('product_categories', $data1);
       // $this->db->insert('product_categories', $data1);
        $this->db->insert('product_images', $data2);

    }


    /*
     * function name :record_count
     *  To get no. of rows in product
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : number
     */


    public function record_count()
    {
        return $this->db->count_all("product");
    }

    /*
   * function name :get_product
   *  To get user in product table
   *
   * @author	Antony
   * @access	public
   * @param :
   * @return : array
   */


    public function get_product()
    {
        $post = $this->input->post();
        $total_display_records = $this->record_count();
        $search = $post['search']['value'];
        $start = $post['start'];
        $limit = $post['length'];
        $order = $post['order'][0]['dir'];

        $this->db->select('product.id,name,price,special_price,quantity,image_name,product.status');
        $this->db->from('product');
        $this->db->join('product_images', 'product_images.product_id = product.id');
        $this->db->where("name LIKE '%$search%' OR price LIKE '%$search%' ");
        $this->db->order_by("name $order, price $order");
        $this->db->limit($limit, $start);
        $result = $this->db->get()->result();

        $final_array = array();
        foreach ($result as $r) {
            $user_array = array();
            $user_array['id'] = $r->id;
            $user_array['name'] = $r->name;
            $user_array['image_name'] = $r->image_name;
            $user_array['price'] = $r->price;
            $user_array['special_price'] = $r->special_price;
            $user_array['quantity'] = $r->quantity;
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
     * function name :get_product_update
     * To get product details
     *
     * @author	Antony
     * @access	public
     * @param : array
     * @return : none
     */

    public function get_product_update($id){
        $this->db->select('product.id,product.name,price,special_price,quantity,short_description,long_description,product.status,is_featured,category_id,image_name,category.name as catname');
        $this->db->from('product');
        $this->db->join('product_images', 'product_images.product_id = product.id');
        $this->db->join('product_categories', 'product_categories.product_id = product.id');
        $this->db->join('category', 'category.id = product_categories.category_id');
        $this->db->where('product.id', $id);
        $query = $this->db->get()->result_array();;
          //echo $this->db->last_query();die;
        return $query;
    }
    
    /*
     * function name :update_product
     * To update product details
     *
     * @author	Antony
     * @access	public
     * @param : array
     * @return : none
     */

    public function update_product($data,$id){
        $this->db->where('id', $id);
        $this->db->update('product', $data);
        
    }
 
    /*
     * function name :update_product_category
     * To update product category data
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */
    public function update_product_category($data1,$id){
        $this->db->where('product_id', $id);
        $this->db->delete('product_categories');
        $this->db->insert_batch('product_categories', $data1);
    }
    
      /*
     * function name :update_product_image
     * To update product image data
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */
    public function update_product_image($data2,$id){
        $this->db->where('product_id', $id);
        $this->db->update('product_images', $data2);
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

    public function delete_product($data){
        $this->db->where('id', $data);
        $this->db->delete('product');
        return true;
    }

    /*
    * function name :delete_product_cat
    * To delete data at id passed
    *
    * @author   Antony
    * @access   public
    * @param : number
    * @return : boolean
    */

    public function delete_product_cat($data){
        $this->db->where('product_id', $data);
        $this->db->delete('product_categories');
        return true;
    }

     /*
    * function name :delete_product_image
    * To delete data at id passed
    *
    * @author   Antony
    * @access   public
    * @param : number
    * @return : boolean
    */

    public function delete_product_image($data){
        $this->db->where('product_id', $data);
        $this->db->delete('product_images');
        return true;
    }

}
