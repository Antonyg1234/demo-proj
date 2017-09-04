<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login controller contain login related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class Login extends Site_Controller{

    function __construct(){
        
        // Call the Model constructor
        parent::__construct();
        $this->load->model('site/login_model');
        $this->load->model('site/email_model');
       // $this->load->library('facebook');
   }


    /*
     * function name :index
     * To display login page
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    public function index(){
        $this->render('index');
    }

      /*
     * function name :signUp
     * To add new user 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    public function signUp(){
           $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|alpha');
           $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|alpha');
           $this->form_validation->set_rules('contactno', 'Contact No', 'required|numeric|min_length[10]|max_length[10]');
           $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
           $this->form_validation->set_rules('password', 'Password', 'trim|required|alpha_numeric|min_length[5]|max_length[12]');
           $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|matches[password]');
          

           if ($this->form_validation->run() == FALSE) {
                $this->render('index');
           } else {
                  $firstname = $this->input->post('firstname');
                  $lastname = $this->input->post('lastname');
                  $contactno = $this->input->post('contactno');
                  $email = $this->input->post('email');
                  $pass = trim($this->input->post('password'));
                  $password=md5($pass);
                  

                  $data = array(
                      'firstname' => $firstname,
                      'lastname' => $lastname,
                      'contact_no' => $contactno,
                      'email' => $email,
                      'password' => $password,
                      'roles' => '5',
                  );

                  $title1='user login';
                  $data1=array($firstname,$lastname,$email,$pass);
                 // show($data1);
                  $arr1=array('{firstname}','{lastname}','{Email}','{Password}');
                  $user_login=$this->email_model->template($title1);
                  $subject=$user_login->subject;
                  $content=$user_login->content;
                  $var_content=str_replace($arr1,$data1,$content);
                 
                  $user_email=array(
                    'email'=>$email,
                    'subject'=>$subject,
                    'content'=>$var_content,
                    );
                  $this->email_model->email($user_email);

                  $title2='admin_login';
                  $data2=array($firstname,$lastname,$email);
                  $arr2=array('{firstname}','{lastname}','{Email}');
                  $admin_login=$this->email_model->template($title2);
                  $subject1=$admin_login->subject;
                  $content1=$admin_login->content;
                  $var_content1=str_replace($arr2,$data2,$content1);

                  $admin_email=array(
                    'email'=>'antony.george@neosofttech.com',
                    'subject'=>$subject1,
                    'content'=>$var_content1,
                    );
                  $this->email_model->email($admin_email);


                  $this->db->set('created_date', 'NOW()', FALSE);
                  $this->login_model->create_user($data);
                  $this->session->set_flashdata('login', 'User account created successfully. Login to continue shopping');
                  redirect('site/login');
           }
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
           

           $this->form_validation->set_rules('reg_email', 'Email', 'trim|required|valid_email');
           $this->form_validation->set_rules('reg_password', 'Password', 'trim|required');

           if ($this->form_validation->run() == FALSE){
              $this->render('index');
           } else {
                 $email = trim($this->input->post('reg_email'));
                 $str_password = trim($this->input->post('reg_password'));
                 $password = md5($str_password);
                 $result = $this->login_model->processLogin($email, $password);
          
                  if ($result){
                     $userdata = array(
                        'site_user' => array(
                        'id' => $result->id,
                        'firstname' => $result->firstname,
                        'lastname' => $result->lastname,
                        'email' => $result->email,
                     ));
                  
                   $this->session->set_userdata($userdata);
                   $this->session->set_flashdata('success', 'User logged in successfully');
                   redirect('site/home');
                      
                  } else {
                         $this->session->set_flashdata('error', 'Not a registered user. SignUp to create account.');
                         $this->render('index');
                  }

           }
    }
     /*
    * function name :forgotPassword
    * To retrieve password
    *
    * @author	Antony
    * @access	public
    * @param :
    * @return : none
    */
     public function forgotPassword(){
     	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE){
              $this->render('forgot');
        }else{
        	$email = trim($this->input->post('email'));
          $result = $this->login_model->mailCheck($email);
            if($result==true){
            $token= token();
        		 $key = md5($token);
             $data = array(
               'token' => $key,
               );
             $this->login_model->update_token($data,$email);
             $this->sendEmail($key,$email);
             $this->session->set_flashdata('success', 'Recovery mail has been successfully sent to your mail id');
             $this->render('forgot');
        	}else{
                $this->session->set_flashdata('error', 'Not a registered user. SignUp to create account.');
                $this->render('forgot');
        	}

        }
    }
   

   /*
    * function name :sendEmail
    * To send Email
    *
    * @author Antony
    * @access public
    * @param :
    * @return : none
    */
    public function sendEmail($key,$email){
      //echo "inside mail function";
      //echo $email;die();
      $config['protocol'] = "smtp";
      $config['smtp_host'] = SMTP_HOST;
      $config['smtp_port'] = "587";
      $config['smtp_user'] = SMTP_USER; 
      $config['smtp_pass'] = SMTP_PASS;
      $config['charset'] = "utf-8";
      $config['mailtype'] = "html";
      $config['newline'] = "\r\n";
      $this->email->initialize($config);

      $this->email->from(SMTP_USER, 'E-Shopper');
      $this->email->to($email);
    
      $this->email->subject('Password Recovery');
      //$this->email->message('Testing the email class.');
      $message = "<p>Dear Customer,</p>";
      $message .= "<p>This email has been sent as a request to reset your password</p>";
      $message .= "<p><a href='".base_url()."reset_password/$key'>Click here </a>if you want to reset your password, if not, then ignore</p>";
      $message .= "<p>Thanks</p>";
      $message .= "<p>ShopCart</p>";
      
      $this->email->message($message);
      $this->email->send();

     }

  /*
    * function name :reset_password
    * To reset password
    *
    * @author Antony
    * @access public
    * @param : variable
    * @return : none
    */
    public function reset_password($key){
      $result = $this->login_model->getMail($key);
      if($result==true){
         $data['key']=$key;
          $this->form_validation->set_rules('new_password', 'Password', 'trim|required|alpha_numeric|min_length[5]|max_length[12]');
          $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');

           if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('success', 'Create new password');
              $this->render('changepassword',$data);
           }else{
             $pass = trim($this->input->post('new_password'));
             $password=md5($pass);
             $data = array(
                      'password' => $password,
                      'token' => 0,
                  );
                
                  $this->login_model->update_password($data,$key);
                  $this->session->set_flashdata('success', 'Password updated successfully. Login with new Password');
                  redirect('site/login/index');
            }

      }else{
         $this->session->set_flashdata('error', 'Not a valid Key. Regenerate key');
         $this->render('forgot');
      }
    }

    /*
     * function name :logout
     * To logout session
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
    
    function logout(){
        $this->load->driver('cache'); 
        //$this->session->sess_destroy('site_user');
        $this->session->unset_userdata('site_user');
        $this->cache->clean();  
        redirect('site/home'); 
        ob_clean(); 
    }


    
}