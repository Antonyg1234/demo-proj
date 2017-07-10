<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * System controller contain email template related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class System extends Admin_Controller{
    
    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin/system_model');
        if (!$this->session->userdata('user')){
            redirect('admin/login');
        }
    }

    /*
     * function name :index
     * To list email template details
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

     public function index(){
       
        if (!empty($this->input->post())){
            $data = $this->system_model->get_template();
            echo json_encode($data);
            exit();
        }
        $data['js'] = 'admin/template_table.js';
        $this->render('index', $data);
     }
    
    /*
     * function name :create
     * To create template
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

     public function create(){
     	$this->form_validation->set_rules('title','Title', 'required|is_unique[email_template.title]|alpha_dash');
     	$this->form_validation->set_rules('subject','Subject','required');
     	//$this->form_validation->set_rules('content','Content','required');
     	if($this->form_validation->run()==FALSE){
            echo "true";
     		$this->render('create');
     	}else{
            echo "pal";
     		$title=$this->input->post('title');
     		$subject=$this->input->post('subject');
     		$content=$this->input->post('content');
     		$data=array(
              'title'=>$title,
              'subject'=>$subject,
              'content'=>$content,
     		 );
            // show($data);
     		$this->db->set('created_date', 'NOW()', FALSE);
     		$this->system_model->create_template($data);
            $this->session->set_flashdata('success', 'Template added successfully');
            redirect('admin/system');

     	}
     }

    /*
     * function name :edit
     * To edit template
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

     public function edit($id=0){
     	$data['id'] =  $id;
     	$this->form_validation->set_rules('subject','Subject','required');
     	$this->form_validation->set_rules('content','Content','required');
     	if($this->form_validation->run()==FALSE){
     		$data['template']=$this->system_model->edit_template($id);
     		$this->render('edit',$data);
     	}else{
     		$title=$this->input->post('title');
     		$subject=$this->input->post('subject');
     		$content=$this->input->post('content');
            $data=array(
              'title'=>$title,
              'subject'=>$subject,
              'content'=>$content,
     		 );
     		$this->db->set('modify_date', 'NOW()', FALSE);
            $this->system_model->update_template($data,$id);
            $this->session->set_flashdata('success', 'Template updated successfully');
            redirect('admin/system');

     	}
     }

    /*
     * function name :delete
     * To delete template
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */
    
     public function delete(){
         $id= $this->input->get('id', TRUE);  //getting id from url
         $this->system_model->delete_template($id);
         $this->session->set_flashdata('success', 'Template deleted successfully');
         redirect('admin/system');
    }

}