<?php
 class Password extends Site_Controller{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('site/password_model');
       //$data['sidenav']=$this->load->view('site/layouts/sidenav');
        if(!$this->session->userdata('site_user')){
            redirect('site/home');
        }
    }

    /*
     * function name :index
     * To get password entered and check
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    public function index(){
       // $id=$this->session->userdata['site_user']['id'];
       $this->form_validation->set_rules('old_password', 'Old Password ', 'trim|required|alpha_numeric|min_length[5]|max_length[12]');
       $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|alpha_numeric|min_length[5]|max_length[12]');
       $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');

        if ($this->form_validation->run() == FALSE){
            $this->render('index');
        }else{
             $this->changepassword();
        }
    }

    /*
     * function name :changepassword
     * To check password and update
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
   public function changepassword(){
    $id=$this->session->userdata['site_user']['id'];
    $checkpass= trim($this->input->post('old_password'));
    $pass=md5($checkpass);
   // echo $id;die();
    $result = $this->password_model->check_password($pass, $id);
   // var_dump($result);die();
    if($result==true){
      $newpass= trim($this->input->post('new_password'));
      $data = array(
            'password' => $newpass,
                  ); 
      $this->password_model->update_password($data,$id); 
      $this->session->set_flashdata('success', 'Password updated successfully. Login with new Password');
                  redirect('site/password');           
    }else{
        $this->session->set_flashdata('error', 'Old Password is not matching, Click on forgot password to retrieve');
        redirect('site/password');

    }

   }

}