<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Address controller contain address related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class Account extends Site_Controller{

    function __construct(){
        parent::__construct();
         $this->load->model('site/account_model');
        if(!$this->session->userdata('site_user')){
            redirect('site/home');
        }
    }


    /*
     * function name :index
     * To get address details of user
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    public function index(){
         $id=$this->session->userdata['site_user']['id'];
        //echo $id;die();
        $data['account'] = $this->account_model->get_account($id);
        //print_r($data['account']);die();
        $this->render('index',$data);
    }

     /*
     * function name :edit
     * To edit user details
     *
     * @author  Antony
     * @access  public
     * @param : number
     * @return : none
     */
     


    public function edit($id){
    $id=$this->session->userdata['site_user']['id'];
   // echo $user_id;die();   
    $data['id'] =  $id;
    //echo $id;die();
    $this->form_validation->set_rules('firstname', 'First Name', 'required');
    $this->form_validation->set_rules('lastname', 'Last Name', 'required');
    $this->form_validation->set_rules('contact_no', 'Contact No', 'required|numeric|min_length[10]|max_length[10]');
    

    if ($this->form_validation->run() == FALSE){
        $data['account'] = $this->account_model->get_account($id);
        $this->render('index',$data);
    }else {
                    $firstname = $this->input->post('firstname');
                    $lastname = $this->input->post('lastname');
                    $contact_no = $this->input->post('contact_no');
                    

                    $data = array(
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'contact_no' => $contact_no,
                    );
                 
                   
                    $this->account_model->update_account($data,$id);
                    $this->session->set_flashdata('success', 'Profile updated successfully');
                    redirect('account');
             }
 
  }
}