<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Home controller Home Page related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class Home extends Site_Controller{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('site/home_model');
    }

    /*
     * function name :index
     * To display home page with products and category
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    public function index(){
       //$this->cart->destroy();

        
       // show($this->cart->contents());
        $data['slide']=$this->banner();

        $data['categories']=$this->category();
        $data['products']=$this->product();
       // show($data['categories']);
        $this->render('index',$data);
    }

     /*
     * function name :banner
     * To display banner details
     * @author  Antony
     * @access  public
     * @param :
     * @return : array
     */

    public function banner(){
        $data = $this->home_model->get_banner();
        return $data;
    }

    /*
     * function name :category
     * To get category details
     * @author  Antony
     * @access  public
     * @param :
     * @return : array
     */

    public function category(){
        $data= $this->home_model->get_categories();
        return $data;
    }

    /*
     * function name :product
     * To get product details
     * @author  Antony
     * @access  public
     * @param :
     * @return : array
     */

    public function product(){
        $data= $this->home_model->get_products();
        return $data;
    }

    /*
     * function name :category_product
     * To get product details
     * @author  Antony
     * @access  public
     * @param :
     * @return : array
     */

    public function category_product(){
        
       $id = $this->input->post('id');
       $data= $this->home_model->get_mobile($id);
     // var_dump($data);die();

      foreach ($data as $key => $value) {
        $is_added = is_added_cart($value->id);
        if($is_added){ 
          $disable="disabled";
          $added="Added to cart";
        }else{
          $disable="";
          $added="Add to cart";   
        }
          $html .= '<div class="col-sm-3">'.
                                    '<div class="product-image-wrapper">'.
                                        '<div class="single-products">'.
                                            '<div class="productinfo text-center">'.
                                            '<a href="'.base_url().'site/home/product_detail/'.$value->id.'">'.
                                                '<img style="height: 180px;" src="'.base_url().USER_UPLOAD_PRODUCT_URL. $value->image_name .'" alt="">'.
                                                    '<h2>$'.$value->price.'</h2>'.
                                                '<p>'.$value->name.'</p>'.

                                                '<a href="javascript:void(0)" class="btn btn-default add-to-cart add_cart"'.$disable.' data-id="'.$value->id.'" data-price="'.$value->price.'" data-name="'.$value->name.'" data-image="'.$value->image_name.'" ><i class="fa fa-shopping-cart"></i>'.$added.'</a>'.
                                                '<a>'.
                                            '</div>' .
                                        '</div>'.
                                    '</div>'.
                                '</div>';
      }
       echo json_encode($html);
       exit();
       return $html;
    }

    /*
     * function name :sub_category
     * To get product of sub category
     * @author  Antony
     * @access  public
     * @param :
     * @return : array
     */

    public function sub_category($id ,$name){
        $data['name']=$name;
        //show($data['name']);die();
         $data['slide']=$this->banner();
         //$data['name']=$name;
        $data['categories']=$this->category();
       // $data['products']=$this->product();
        
        $data['subproduct']= $this->home_model->sub_category($id);
        //show($data['subproduct']);
        if(!empty($data['subproduct'])){
         $this->render('sub_category',$data);   
     }else{
       $this->render('empty',$data); 
     }
        
        

    }

     /*
     * function name :sub_category
     * To get product of sub category
     * @author  Antony
     * @access  public
     * @param :
     * @return : array
     */

    public function product_detail($id){
        $data['id']=$id;
        //show($data['id']);
        $data['product_detail']= $this->home_model->product_detail($id);
       // show($data['product_detail']);
        $this->render('product_detail',$data);
    }



}

?>