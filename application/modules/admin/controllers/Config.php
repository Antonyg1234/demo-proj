<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Config controller contain lconfiguration related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */


class Config extends Admin_Controller{
    
    function __construct(){
        
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin/config_model');

        if (!$this->session->userdata('user')){
            redirect('admin/login');
        }
    }

    /*
     * function name :index
     * To list configuration details
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

     public function index(){
            $data = array();
            if (!empty($this->input->post())){
            $data = $this->config_model->get_config();
            echo json_encode($data);
            exit();
            }
         
            $data['js'] = 'admin/config_table.js';
            $this->render('index', $data);
     }

    /*
     * function name :add
     * To add configuration details 
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */
    
      public function add(){
             $this->form_validation->set_rules('conf_key', 'Configuration Key', 'trim|required');
             $this->form_validation->set_rules('conf_value', 'Configuration Value', 'trim|required');
        
             if ($this->form_validation->run() == FALSE){
                 $this->render('add');
             } else {
                     $conf_key = $this->input->post('conf_key');
                     $conf_value = $this->input->post('conf_value');

                     $data = array(
                        'conf_key' => $conf_key,
                        'conf_value' => $conf_value,
                     );
                 
                     $this->db->set('created_date', 'NOW()', FALSE);
                     $this->config_model->insert_config($data);
                     $this->session->set_flashdata('success', 'Configuration added successfully');
                     redirect('admin/config');
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
            $this->form_validation->set_rules('conf_value', 'Configuration Value', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $data = $this->config_model->get_config_update($id);
                $this->render('edit',$data);
            } else {
                   $conf_value = $this->input->post('conf_value');

                   $data = array(
                     'conf_value' => $conf_value,
                   );
                
                   $this->db->set('modify_date', 'NOW()', FALSE);
                   $this->config_model->update_config($data,$id);
                   $this->session->set_flashdata('success', 'Configuration updated successfully');
                   redirect('admin/config');
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
        $this->config_model->delete_config($data);
        $this->session->set_flashdata('success', 'Configuration deleted successfully');
        redirect('admin/config');
    }
}