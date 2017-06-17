<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User controller contain user related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class User extends Admin_Controller{
    
    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin/user_model');

        if(!$this->session->userdata('user')){
            redirect('admin/login');
        }
    }
    
    /*
     * function name :index
     * To list user details
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

     public function index(){
         $data = array();

         if(!empty($this->input->post())){
            $data = $this->user_model->get_user();
            echo json_encode($data);
            exit();
         }
         $data['js'] = 'admin/user_tables.js';
         $this->render('index',$data);
    }
           
    /*
     * function name :add
     *  To add user
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */
    
     public function add(){
           $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|alpha');
           $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|alpha');
           $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
           $this->form_validation->set_rules('password', 'Password', 'trim|required|alpha_numeric|min_length[5]|max_length[12]');
           $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|matches[password]');
           $this->form_validation->set_rules('role_select', 'Roles', 'required');

           if ($this->form_validation->run() == FALSE) {
                $data['dropdown'] = $this->user_model->get_dropdown();
                $this->render('add',$data);
           } else {
                  $firstname = $this->input->post('firstname');
                  $lastname = $this->input->post('lastname');
                  $email = $this->input->post('email');
                  $pass = trim($this->input->post('password'));
                  $password=md5($pass);
                  $role = $this->input->post('role_select');

                  $data = array(
                      'firstname' => $firstname,
                      'lastname' => $lastname,
                      'email' => $email,
                      'password' => $password,
                      'roles' => $role,
                  );
               
                  $this->db->set('created_date', 'NOW()', FALSE);
                  $this->user_model->insert_user($data);
                  $this->session->set_flashdata('success', 'User added successfully');
                  redirect('admin/user');
           }
     }

    /*
     * function name :edit
     *  To edit user details
     *
     * @author	Antony
     * @access	public
     * @param : id
     * @return : none
     */

    public function edit($id = 0){
            // $data = array();
            $data['id'] =  $id;
            $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|alpha');
            $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|alpha');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('role_select', 'Roles', 'required');

            if ($this->form_validation->run() == FALSE) {
                  $data['edit_user'] = $this->user_model->get_user_update($id);
                  $data['dropdown'] = $this->user_model->get_dropdown();
                  $this->render('edit',$data);
            
            } else {
                   $firstname = $this->input->post('firstname');
                   $lastname = $this->input->post('lastname');
                   $email = $this->input->post('email');
                   $role = $this->input->post('role_select');

                   $data = array(
                       'firstname' => $firstname,
                       'lastname' => $lastname,
                       'email' => $email,
                       'roles' => $role,
                   );

                   $this->user_model->update_user($data,$id);
                   $this->session->set_flashdata('success', 'User updated successfully');
                   redirect('admin/user');
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
         $this->user_model->delete_user($data);
         $this->session->set_flashdata('success', 'User deleted successfully');
         redirect('admin/user');
    }
}