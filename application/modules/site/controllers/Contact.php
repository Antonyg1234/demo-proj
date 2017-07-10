<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Contact controller contain contact related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class Contact extends Site_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('site/contact_model');
       // $this->load->library('MCAPI');
        $this->load->model('site/email_model'); 
        }
    /*
     * function name :index
     * To display contact us form
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    public function index(){
    	  $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('contactno', 'Contact Us', 'required|numeric|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('message', 'Message', 'required');
        if ($this->form_validation->run() == FALSE){
    	  $this->render('index');
        }else{
        	$name = $this->input->post('name');
            $email = $this->input->post('email');
            $contactno = $this->input->post('contactno');
            $message = $this->input->post('message');
            $data=array(
              'name'=>$name,
              'email'=>$email,
              'contact_no'=>$contactno,
              'message'=>$message,
            	);
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->contact_model->insert_message($data);


            $data1=array($name,$email,$contactno,$message);
            $arr1=array('{name}','{email}','{contact no.}','{comment}');
            $contact_us=$this->email_model->template('contact us');
            $subject=$contact_us->subject;
            $content=$contact_us->content;
            $var_content=str_replace($arr1,$data1,$content);

            $contact_us=array(
             'email'=>'antony.george@neosofttech.com',
             'subject'=>$subject,
             'content'=>$var_content,
              );
            //var_dump($contact_us);die();
            $this->email_model->email($contact_us);

            $this->session->set_flashdata('success', 'Your message has been sent successfully');
            $this->render('index');
        }
    }

    public function newsletter(){
        
        $email = $this->input->post('newsletter');
        echo $emial;die();
        $list_id= LIST_KEY;
        

        if($this->mcapi->listSubscribe($list_id, $email)){
           //var_dump($response);die();
        }
        
     
     }
}