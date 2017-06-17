<?php

/**
 * Login model contain login related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class Sale extends Site_Controller{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
          $this->load->model('site/home_model');  
    }

    /*
     * function name :index
     * To insert product in cart 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    public function index(){
    
           $id = $this->input->post('id');
           $price = $this->input->post('price');
           $name = $this->input->post('name');
           $image_name = $this->input->post('image_name');
          // echo $name;die();
          // $this->load->library('cart');
           

           $data = array(
            'id'      => $id,
            'qty'     => 1,
            'price'   => $price,
            'name'    => $name,
            'image_name' => $image_name,
            );
    
          if($this->cart->insert($data)){
            $get_quantity= $this->home_model->get_qty($id);
            $get_quantity=$get_quantity->quantity-1;
            $this->home_model->update_qty($get_quantity,$id);
            $data['rows'] = count($this->cart->contents());
          }else{
            $data = array();
          }
          
          echo json_encode($data);

    }
    
    /*
     * function name :cart
     * To display cart page
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
    public function cart(){

        $this->render('cart');

    }

    /*
     * function name :update_cart
     * To display cart page
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
    public function remove_cart(){
           $id = $this->input->post('id');
           //$qty = $this->input->post('qty');
           $rowid = $this->input->post('rowid');
           $price = $this->input->post('price');
           $quantity = $this->input->post('qty_add');
          // show($id);
            $data = array(
                    'rowid' => $rowid,
                    'qty'   => 0,
            );
            $get_quantity= $this->home_model->get_qty($id);
            //show($get_quantity);
            $get_quantity=$get_quantity->quantity+$quantity;
           

            if($this->cart->update($data)){
              $this->home_model->update_qty($get_quantity,$id);
              echo count($this->cart->contents());
                //echo true;
            }
          
    }

    public function update_cart(){
           $id = $this->input->post('id');
           $qty = $this->input->post('qty');
           $rowid = $this->input->post('rowid');
           $price = $this->input->post('price');
          // show($id);
           $get_quantity= $this->home_model->get_qty($id);
           
       
      
          if($get_quantity->quantity>=$qty){
              $get_quantity=$get_quantity->quantity-1;
              //show($get_quantity);die();
              $this->home_model->update_qty($get_quantity,$id);

               $data = array(
                    'rowid' => $rowid,
                    'qty'   => $qty,
               );
             
               $this->cart->update($data);
               echo $subtotal=$qty*$price;
          }else{

              echo false;
          }        
    }


    public function decrease_cart(){
           $id = $this->input->post('id');
           $qty = $this->input->post('qty');
           $rowid = $this->input->post('rowid');
           $price = $this->input->post('price');
           //show($id);
           $get_quantity= $this->home_model->get_qty($id);
           
       
      
          if($get_quantity->quantity>=$qty){
              $get_quantity=$get_quantity->quantity+1;
              //show($get_quantity);die();
              $this->home_model->update_qty($get_quantity,$id);

               $data = array(
                    'rowid' => $rowid,
                    'qty'   => $qty,
               );
             
               $this->cart->update($data);
               echo $subtotal=$qty*$price;
          }else{

              echo false;
          }        
    }

    public function multi_cart(){
    
           $id = $this->input->post('id');
           $price = $this->input->post('price');
           $name = $this->input->post('name');
           $image_name = $this->input->post('image_name');
           $qty = $this->input->post('qty');

          $get_quantity= $this->home_model->get_qty($id);
          $get_quantity=$get_quantity->quantity-$qty;
          

           $data = array(
            'id'      => $id,
            'qty'     => $qty,
            'price'   => $price,
            'name'    => $name,
            'image_name' => $image_name,
            );
    
          if($this->cart->insert($data)){
            $this->home_model->update_qty($get_quantity,$id);
            $data['rows'] = count($this->cart->contents());
          }else{
              $data = array();
          }
          
          echo json_encode($data);

    }

     /*
     * function name :wishlist
     * To insert product to wishlist table 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
    public function wishlist(){
      $id = $this->input->post('id');
      if(!$this->session->userdata('site_user')){
        echo false;
      }else{
       
        $user_id=$this->session->userdata['site_user']['id'];
        //echo $product_id;die();
        $data = array(
           'user_id' => $user_id,
           'product_id' => $id,
                    );
        $wishlist= $this->home_model->insert_wishid($data);
        echo true;

      }

    }
    
    /*
     * function name :wishcart
     * To list wishlist product 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
    public function wishcart(){
        $user_id=$this->session->userdata['site_user']['id'];
        $data['data_id']=$this->home_model->get_wishcart($user_id);
        $count=count($data['data_id']);
        $this->render('wishlist',$data);
    }

    /*
     * function name :delete_wishcart
     * To remove wishlist product 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
    public function delete_wishcart(){
        $user_id=$this->session->userdata['site_user']['id'];
        $id_delete = $this->input->post('id');
        $data['delete']=$this->home_model->delete_wishcart($id_delete,$user_id);
        $data['data_id']=$this->home_model->get_wishcart($user_id);
        $count=count($data['data_id']);
        echo $count;
    }
}