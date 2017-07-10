<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Banner controller contain banner related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class Banner extends Admin_Controller{
    
    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin/banner_model');
        if (!$this->session->userdata('user')){
            redirect('admin/login');
        }
    }

    /*
     * function name :index
     * To list banner details
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

     public function index(){
        $data = array();
        if (!empty($this->input->post())){
            $data = $this->banner_model->get_banner();
            echo json_encode($data);
            exit();
        }
        $data['js'] = 'admin/banner_table.js';
        $this->render('index', $data);
     }

     /*
      * function name :add
      * To add banner
      *
      * @author	Antony
      * @access	public
      * @param :
      * @return : none
      */
    
     public function add(){
          $this->form_validation->set_rules('banner_name', 'Banner Name', 'required');
          $this->form_validation->set_rules('status', 'Status', 'required');
          if ($this->form_validation->run() == FALSE){
              $this->render('add');
          } else {
            
                if (!empty($_FILES)){
                  
                    $mimetype = mime_content_type($_FILES['uploadedimage']['tmp_name']);
                    if(in_array($mimetype, array('image/jpeg', 'image/gif', 'image/png'))){

                    $config['upload_path'] = './'.USER_UPLOAD_URL;
                    $config['allowed_types'] = 'jpg|png';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                       if (!$this->upload->do_upload('uploadedimage')){
                            $data['error'] = array('error' => $this->upload->display_errors());
                            $this->render('add');
                       } else { 
                               $uploadData = $this->upload->data();
                               $picture = $uploadData['file_name'];
                               $picture_path =  $picture;

                               $banner_name = $this->input->post('banner_name');
                               $status = $this->input->post('status');

                               $data = array(
                               'banner_name' => $banner_name,
                               'banner_path' => $picture,
                               'status' => $status
                                );
            
                               $this->banner_model->insert_banner($data);
                               $this->session->set_flashdata('success', 'Banner added successfully');
                               redirect('admin/banner');
                       }

                    } else {
                        $this->session->set_flashdata('error', 'Not a valid file, Only jpg and png allowed');
                          redirect('admin/banner/add');
                    }

                } else {
                       $this->session->set_flashdata('error', 'Not a valid file, Only jpg and png allowed');
                      redirect('admin/banner/add');
                }

           }
     }


    /*
     * function name :edit
     * To edit user
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */
     public function edit($id = 0){
          $data['id'] =  $id;
          $this->form_validation->set_rules('banner_name', 'Banner Name', 'trim|required');
          $this->form_validation->set_rules('status', 'Status', 'trim|required');

         if ($this->form_validation->run() == FALSE){
             $data = $this->banner_model->get_banner_update($id);
            // $dat = "Banner image required";
             $this->render('edit',$data);
         } else {
               
                 $banner_name = $this->input->post('banner_name');
                 $status = $this->input->post('status');

                 $data = array(
                     'banner_name' => $banner_name,
                     'status' => $status
                 );

                 if (!empty($_FILES['uploadedimage']['name'])){
                        $mimetype = mime_content_type($_FILES['uploadedimage']['tmp_name']);
                        if(in_array($mimetype, array('image/jpeg', 'image/gif', 'image/png'))){

                             $config['upload_path'] = './'.USER_UPLOAD_URL;
                             $config['allowed_types'] = 'jpg|png';
                             $this->load->library('upload', $config);
                             $this->upload->initialize($config);

                             if (!$this->upload->do_upload('uploadedimage')){
                                 $data['error'] = array('error' => $this->upload->display_errors());
                                 $data['image_error'] = "Banner image required";
                                 $this->render('edit', $data);
                             }

                             $uploadData = $this->upload->data();
                             $picture = $uploadData['file_name'];
                            
                             $data['banner_path'] = $picture;
                         } else {
                               $this->session->set_flashdata('error', 'Not a valid file, Only jpg and png allowed');
                               redirect('admin/banner/edit/'.$id);
                         }
                  } 

                 $this->banner_model->update_banner($data,$id);
                 //echo "im here";die();
                 $this->session->set_flashdata('success', 'Banner updated successfully');
                 redirect('admin/banner');

         }

     }


    
    /*
     * function name :delete
     * To delete banner
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

     public function delete(){
        $id= $this->input->get('id', TRUE);  
        $data=$id;
        $this->banner_model->delete_banner($data);
        $this->session->set_flashdata('success', 'Banner deleted successfully');
        redirect('admin/banner');
     }
}