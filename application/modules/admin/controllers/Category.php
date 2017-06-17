<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Category controller contain category related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */


class Category extends Admin_Controller{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin/category_model');

        if (!$this->session->userdata('user')){
            redirect('admin/login');
        }
    }

    /*
     * function name :index
     * To list category details
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

     public function index(){
         $data = array();
         if (!empty($this->input->post())){
             $data = $this->category_model->get_category();
             echo json_encode($data);
             exit();
         }
         $data['js'] = 'admin/category_table.js';
         $this->render('index',$data);
     }


     /*
      * function name :add
      * To add category
      *
      * @author	Antony
      * @access	public
      * @param :
      * @return : none
      */
      public function add(){
             $this->form_validation->set_rules('categoryname', 'Category Name', 'trim|required');
             $this->form_validation->set_rules('categorytype', 'Category Type', 'required');

             if ($this->form_validation->run() == FALSE){
                 $data['dropdown'] = $this->category_model->get_dropdown();
                 //var_dump($data['dropdown']);die();
                 $this->render('add',$data);
             } else {
                    $categoryname = $this->input->post('categoryname');
                    $categorytype = $this->input->post('categorytype');

                    $data = array(
                    'name' => $categoryname,
                    'parent_id' => $categorytype,
                    );
                 
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->category_model->insert_category($data);
                    $this->session->set_flashdata('success', 'Configuration added successfully');
                    redirect('admin/category');
             }

      }

    /*
     * function name :edit
     *  To edit category
     *
     * @author	Antony
     * @access	public
     * @param : id 
     * @return : none
     */

    public function edit($id = 0){
        // $data = array();
          $data['id'] =  $id;
          $this->form_validation->set_rules('categoryname', 'Category Name', 'trim|required');
          $this->form_validation->set_rules('categorytype', 'Category Type', 'required');

          if ($this->form_validation->run() == FALSE){
               $data['dropdown'] = $this->category_model->get_dropdown();
               $data['edit_data'] = $this->category_model->get_category_update($id);
               $this->render('edit',$data);
          } else {
                 $categoryname = $this->input->post('categoryname');
                 $categorytype = $this->input->post('categorytype');


                 $data = array(
                   'name' => $categoryname,
                   'parent_id' => $categorytype,
                 );
              
                 $this->db->set('modify_date', 'NOW()', FALSE);
                 $this->category_model->update_category($data,$id);
                 $this->session->set_flashdata('success', 'Configuration updated successfully');
                 redirect('admin/category');
          }
    }


    /*
     * function name :delete
     *  To delete category
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */
    
     public function delete(){
         $id= $this->input->get('id', TRUE);  //getting id from url
         $data=$id;
         $this->category_model->delete_category($data);
         $this->session->set_flashdata('success', 'Configuration deleted successfully');
         redirect('admin/category');
    }
    
}