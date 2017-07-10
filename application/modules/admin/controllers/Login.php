<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login controller contain login related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class Login extends MX_Controller{

    function __construct(){
        
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin/login_model');
    }
    
   /*
    * function name :index
    * To display login page
    *
    * @author	Antony
    * @access	public
    * @param :
    * @return : none
    */
    
    public function index(){
        $this->load->view('admin/login');
    }

    /*
    * function name :postLogin
    * To display success page after login
    *
    * @author	Antony
    * @access	public
    * @param :
    * @return : none
    */
    public function postLogin(){
           

           $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
           $this->form_validation->set_rules('password', 'Password', 'trim|required');

           if ($this->form_validation->run() == FALSE){
              $this->load->view('login');
           } else {
                 $email = trim($this->input->post('email'));
                 $str_password = trim($this->input->post('password'));
                 $password = md5($str_password);
                 $result = $this->login_model->processLogin($email, $password);
                
                  if($result){
                     $userdata = array(
                        'user' => array(
                        'id' => $result->id,
                        'firstname' => $result->firstname,
                        'lastname' => $result->lastname,
                        'email' => $result->email,
                     ));
                      
                   $this->session->set_userdata($userdata);
                   redirect('admin/user');
                      
                  } else {
                         $this->session->set_flashdata('error', 'Not a valid user');
                         $this->load->view('admin/login');
                  }

           }
    }

    /*
     * function name :logout
     * To logout session
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */
    
    function logout(){
        $this->load->driver('cache');
        $this->session->sess_destroy(); 
        $this->cache->clean(); 
        redirect('admin/login'); 
        ob_clean(); 
    }
    

}



