<?php
/**
 * AHome model contain address related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */ 


class Home_model extends CI_Model{

        public function get_banner(){
        $this->db->select('banner_path');
        $this->db->where('status', 1);
        $this->db->from('banners');
        $result = $this->db->get()->result();
        return $result;
    }

    /*
     * function name :get_categories
     * To get category details
     * @author  Antony
     * @access  public
     * @param :
     * @return : array
     */

    public function get_categories(){
        $query = $this->db->get('parent_category');
        $return = array();

        foreach ($query->result() as $category) {
            $return[$category->id] = $category;
            $return[$category->id]->subs = $this->get_sub_categories($category->id);
        }
        return $return;
    }

    /*
     * function name :get_sub_categories
     * To get sub category details
     * @author  Antony
     * @access  public
     * @param : number
     * @return : object
     */
    public function get_sub_categories($category_id){
        $this->db->where('parent_id', $category_id);
        $query = $this->db->get('category');
        // echo $this->db->last_query();die;
        return $query->result();
    }

    /*
     * function name :get_products
     * To get product details
     * @author  Antony
     * @access  public
     * @param : number
     * @return : object
     */
    public function get_products(){
        $this->db->select('id,product.name,price,quantity');
        $whereCondition =array('status'=>1,'is_featured'=>1);
        $this->db->order_by("id", "DESC");
        $this->db->where($whereCondition);
        $query = $this->db->get('product');
        $return = array();
        

        foreach ($query->result() as $product) {
            $return[$product->id] = $product;
            $return[$product->id]->subs = $this->get_sub_product($product->id);
        }
        return $return;
    }
 
    /*
     * function name :get_sub_product
     * To get product details
     * @author  Antony
     * @access  public
     * @param : number
     * @return : object
     */

    public function get_sub_product($product_id){
        $this->db->select('id,image_name');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('product_images');
        // echo $this->db->last_query();die;
        return $query->result();
    }

     /*
     * function name :get_mobile
     * To get product details
     * @author  Antony
     * @access  public
     * @param : number
     * @return : object
     */

    public function get_mobile($id){
        $this->db->select('product.id,product.name,price,image_name,category.parent_id,quantity');
        $this->db->join('product_categories', 'product_categories.product_id = product.id');
        $this->db->join('category','category.id=product_categories.category_id');
        $this->db->join('product_images', 'product_images.product_id = product.id');
        $this->db->where('category.parent_id',$id);
        $this->db->where('product.status',1);
        $this->db->group_by('product.name'); 
        $query = $this->db->get('product');
        // echo $this->db->last_query();die;
        return $query->result();
    }

    /*
     * function name :sub_category
     * To get product details
     * @author  Antony
     * @access  public
     * @param : number
     * @return : object
     */
    public function sub_category($id){
        $this->db->select('product.id,product.name as productname,price,category.name as subcategory_name,category.parent_id as categoryid,quantity');
        $this->db->join('product_categories', 'product_categories.product_id = product.id');
        $this->db->join('category','category.id=product_categories.category_id');
        $whereCondition=array('product_categories.category_id'=>$id,'product.status'=>1);
        $this->db->where($whereCondition);
        $query = $this->db->get('product');
        $return = array();
        

        foreach ($query->result() as $product) {
            $return[$product->id] = $product;
            $return[$product->id]->subs = $this->subcategory_product($product->id);
        }
        return $return;
    }
 
    /*
     * function name :get_sub_product
     * To get product details
     * @author  Antony
     * @access  public
     * @param : number
     * @return : object
     */

    public function subcategory_product($product_id){
        $this->db->select('id,image_name');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('product_images');
        return $query->result();
    }

     /*
     * function name :product_detail
     * To get product details
     * @author  Antony
     * @access  public
     * @param : number
     * @return : object
     */

    public function product_detail($id){
        $this->db->select('product.id,name,short_description,long_description,price,image_name,quantity');
        $this->db->join('product_images', 'product_images.product_id = product.id');
        $this->db->where('product.id', $id);
        $query = $this->db->get('product');
        // echo $this->db->last_query();die;
        return $query->result();
    }

    /*
     * function name :check_qty
     * To check product availability
     * @author  Antony
     * @access  public
     * @param : number
     * @return : object
     */
    public function get_qty($id){
        $this->db->select('quantity');
        $this->db->where('id', $id);
        $query = $this->db->get('product')->row();
       // echo $this->db->last_query();die;
        return $query;
    }

    /*
     * function name :update_quantity
     *  To update category details at id passed
     *
     * @author  Antony
     * @access  public
     * @param : array
     * @return : none
     */

    public function update_qty($quantity,$id){

        $this->db->set('quantity', $quantity);
        $this->db->where('id', $id);
        $this->db->update('product');

    }

    /*
     * function name :insert_wishid
     * To inser wishlist product
     *
     * @author  Antony
     * @access  variable
     * @param : array
     * @return : none
     */
    public function insert_wishid($data){
        $this->db->insert('user_wish_list',$data);

    }

    
    /*
     * function name :get_wishcart
     *  To get wishlist product of user
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : none
     */
    public function get_wishcart($user_id){
        
        $this->db->select('product.id,name,price,image_name,quantity');
        $this->db->join('product_images', 'product_images.product_id = product.id');
        $this->db->join('user_wish_list', 'user_wish_list.product_id = product.id');
        $this->db->where('user_wish_list.user_id', $user_id);
        $query = $this->db->get('product');
       
        return $query->result();
    }

    /*
     * function name :delete_wishcart
     *  To remove wishlist product of user 
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : boolean
     */
     public function delete_wishcart($id,$user_id){
        $whereCondition =array('product_id' =>$id,'user_id'=>$user_id);
        $this->db->where($whereCondition);
        $this->db->delete('user_wish_list');
        return true;
    }



}
