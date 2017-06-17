<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Product controller contain product related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class Product extends Admin_Controller{
    
    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin/product_model');

        if (!$this->session->userdata('user')){
            redirect('admin/login');
        }
    }

    /*
     * function name :index
     * To list product details
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

     public function index(){
        $data = array();
        if (!empty($this->input->post())){
            $data = $this->product_model->get_product();
            echo json_encode($data);
            exit();
        }
        $data['js'] = 'admin/product_table.js';
        $this->render('index',$data);
     }

    /*
     * function name :add
     * To add product
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */
    
     public function add(){
           $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
           $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
           $this->form_validation->set_rules('special_price', 'Special Price', 'trim|required|numeric');
           $this->form_validation->set_rules('quantity', 'quantity', 'trim|required|numeric');
           //$this->form_validation->set_rules('category_select', 'category', 'required');
          
           if ($this->form_validation->run() == FALSE){
              $data['dropdown'] = $this->product_model->get_dropdown();
              $this->render('add',$data);
           } else {

                  if (!empty($_FILES)){
                      $mimetype = mime_content_type($_FILES['uploadedimage']['tmp_name']);
                      if(in_array($mimetype, array('image/jpeg', 'image/gif', 'image/png'))) {

                      $config['upload_path'] = './'.USER_UPLOAD_PRODUCT_URL;
                      $config['allowed_types'] = 'jpg|png';
                      $this->load->library('upload', $config);
                      $this->upload->initialize($config);

                      if (!$this->upload->do_upload('uploadedimage')) {
                           $data['error'] = array('error' => $this->upload->display_errors());
                           $this->render('add');
                      } else {
                             $uploadData = $this->upload->data();
                             $picture = $uploadData['file_name'];
                             // $picture_path = 'uploads/' . $picture;

                             $product_name = $this->input->post('product_name');
                             $price = $this->input->post('price');
                             $special_price = $this->input->post('special_price');
                             $quantity = $this->input->post('quantity');
                             $category_select = $this->input->post('category_select');
                             $short_description = $this->input->post('short_description');
                             $long_description = $this->input->post('long_description');
                             $status = $this->input->post('status');
                             $featured = $this->input->post('featured');

                             if($featured==1){
                                 $feature=1;
                             }else{
                                 $feature=0;
                             }
                   
                             $data = array(
                               'name' => $product_name,
                               'price' => $price,
                               'special_price' => $special_price,
                               'quantity' => $quantity,
                               'short_description' => $short_description,
                               'long_description' => $long_description,
                               'status' => $status,
                               'is_featured' => $feature
                             );
                        //  var_dump($data);die();
                             $table_id = $this->product_model->insert_product($data);
                             
                             foreach($category_select as $cat){
                               $data1[] = array(
                                   'category_id' => $cat,
                                   'product_id' => $table_id,
                               );
                             }
                          
                             $data2 = array(
                                'image_name' => $picture,
                                'product_id' => $table_id,
                             );
                          
                            $this->product_model->insert_product_cat($data1,$data2);
                            $this->session->set_flashdata('success', 'Product added successfully');
                            redirect('admin/product');
                      }
                  }else {
                        $this->session->set_flashdata('error', 'Not a valid file, Only jpg and png allowed');
                        redirect('admin/product/add');
                  } } else {
                         $this->session->set_flashdata('error', 'Not a valid file, Only jpg and png allowed');
                        redirect('admin/product/add');
                  }
           }
    }

    /*
     * function name :edit
     * To edit product details
     *
     * @author	Antony
     * @access	public
     * @param : is
     * @return : none
     */
    
    public function edit($id = 0){
          $data['id'] =  $id;
          $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
          $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
          $this->form_validation->set_rules('special_price', 'Special Price', 'trim|required|numeric');
          $this->form_validation->set_rules('quantity', 'quantity', 'trim|required|numeric');
          //$this->form_validation->set_rules('category_select', 'category', 'required');
        
          if ($this->form_validation->run() == FALSE) {
              $data['data'] = $this->product_model->get_product_update($id);
              //var_dump($data['data']);die();
              $data['dropdown'] = $this->product_model->get_dropdown();
              $this->render('edit',$data);
          } else {

              $product_name = $this->input->post('product_name');
              $price = $this->input->post('price');
              $special_price = $this->input->post('special_price');
              $quantity = $this->input->post('quantity');
              $category_select = $this->input->post('category_select');
              $short_description = $this->input->post('short_description');
              $long_description = $this->input->post('long_description');
              $status = $this->input->post('status');
              $featured = $this->input->post('featured');

              if($featured==1){
                  $feature=1;
              }else{
                  $feature=0;
              }

              $data = array(
                  'name' => $product_name,
                  'price' => $price,
                  'special_price' => $special_price,
                  'quantity' => $quantity,
                  'short_description' => $short_description,
                  'long_description' => $long_description,
                  'status' => $status,
                  'is_featured' => $feature
              );
     // var_dump($data);die();
              if(!empty($category_select)){
              foreach($category_select as $cat){
                  $data1[] = array(
                      'category_id' => $cat,
                      'product_id' => $id,
                  );
              }
                  $this->product_model->update_product_category($data1,$id);
              }
                 if (!empty($_FILES['uploadedimage']['name'])) {
                      $mimetype = mime_content_type($_FILES['uploadedimage']['tmp_name']);
                      if(in_array($mimetype, array('image/jpeg', 'image/gif', 'image/png'))) {

                     $config['upload_path'] = './'.USER_UPLOAD_PRODUCT_URL;
                     $config['allowed_types'] = 'jpg|png';
                     $this->load->library('upload', $config);
                     $this->upload->initialize($config);

                     if (!$this->upload->do_upload('uploadedimage')) {
                         $data['error'] = array('error' => $this->upload->display_errors());
                         $this->render('edit');
                     }

                     $uploadData = $this->upload->data();
                     $picture = $uploadData['file_name'];
                     // $picture_path = 'uploads/' . $picture;

                     $data2 = array(
                         'image_name' => $picture,
                     );
                     $this->product_model->update_product_image($data2,$id);
                 }else{
                    $this->session->set_flashdata('error', 'Not a valid file, Only jpg and png allowed');
                    redirect('admin/product/edit/'.$id);
                  }}

                      $this->product_model->update_product($data,$id);

                    // $this->product_model->update_product_image($data2,$id);
                     $this->session->set_flashdata('success', 'Product updated successfully');
                    redirect('admin/product');


          }
    }

    /*
    * function name :delete
    *  To delete product
    *
    * @author	Antony
    * @access	public
    * @param :
    * @return : none
    */

    public function delete(){
        $id= $this->input->get('id', TRUE);  //getting id from url
        $data=$id;
        $this->product_model->delete_product($data);
        $this->product_model->delete_product_cat($data);
        $this->product_model->delete_product_image($data);
        $this->session->set_flashdata('success', 'Product deleted successfully');
        redirect('admin/product');
    }
}


