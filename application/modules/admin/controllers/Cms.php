<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Category controller contain category related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */


class Cms extends Admin_Controller{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin/cms_model');

        if (!$this->session->userdata('user')){
            redirect('admin/login');
        }
    }

    /*
     * function name :index
     * To list cms pages details
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

     public function index(){
  // $data = $this->cms_model->get_cms();
         if (!empty($this->input->post())){
             $data = $this->cms_model->get_cms();
             echo json_encode($data);
             exit();
         }
         $data['js'] = 'admin/cms_table.js';
         $this->render('index',$data);

     }

       /*
     * function name :add
     * To add cms
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
    
     public function add(){
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('meta_title', 'Meta Title', 'required');
        $this->form_validation->set_rules('meta_description', 'Meta Desciption', 'required');
        $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'required');
        if($this->form_validation->run() == FALSE){
        $this->render('add');
        }else{
            $title=$this->input->post('title');
            $content=$this->input->post('content');
            $meta_title=$this->input->post('meta_title');
            $meta_description=$this->input->post('meta_description');
            $meta_keyword=$this->input->post('meta_keyword');

            $data=array(
             'title'=>$title,
             'content'=>$content,
             'meta_title'=>$meta_title,
             'meta_discription'=>$meta_description,
             'meta_keywords'=>$meta_keyword,
            );
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->cms_model->insert_cms($data);
            $this->session->set_flashdata('success', 'Cms Added successfully');
            redirect('admin/cms');
        }
    }

      /*
     * function name :edit
     * To edit cms
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
    
     public function edit($id=0){
        //echo $id;die();
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('meta_title', 'Meta Title', 'required');
        $this->form_validation->set_rules('meta_description', 'Meta Desciption', 'required');
        $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'required');
        
        if($this->form_validation->run() == FALSE){
        $data['cms_edit']=$this->cms_model->get_cms_update($id);
        //show($data['cms_edit']);
        $this->render('edit',$data);
        }else{
            $title=$this->input->post('title');
            $content=$this->input->post('content');
            $meta_title=$this->input->post('meta_title');
            $meta_description=$this->input->post('meta_description');
            $meta_keyword=$this->input->post('meta_keyword');

            $data=array(
             'title'=>$title,
             'content'=>$content,
             'meta_title'=>$meta_title,
             'meta_discription'=>$meta_description,
             'meta_keywords'=>$meta_keyword,
            );

            $this->db->set('modify_date', 'NOW()', FALSE);
            $this->cms_model->update_cms($id,$data);
            $this->session->set_flashdata('success', 'Cms Updated successfully');
            redirect('admin/cms');
        }
    }

      /*
     * function name :delete
     * To delete cms
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
    
     public function delete(){
         $id= $this->input->get('id', TRUE);  //getting id from url
         $this->cms_model->delete_cms($id);
         $this->session->set_flashdata('success', 'Cms deleted successfully');
         redirect('admin/cms');
    }
 }