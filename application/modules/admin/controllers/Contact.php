<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Category controller contain category related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */


class Contact extends Admin_Controller{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin/contact_model');
        $this->load->model('site/email_model');
        

        if (!$this->session->userdata('user')){
            redirect('admin/login');
        }
    }

    /*
     * function name :index
     * To list category details
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

     public function index(){
     	
         $data = array();
         if (!empty($this->input->post())){
             $data = $this->contact_model->get_contact();
             //var_dump($data);die();
             echo json_encode($data);
             exit();
         }
         $data['js'] = 'admin/contact_table.js';
         //var_dump($data);die();
         $this->render('index',$data);
     }

       /*
     * function name :view
     * To view the message of customer 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

     public function view(){
     	$id=$this->input->post('id');

     	$data = $this->contact_model->get_msg($id);
     	$msg=$data->message;
     	echo $msg;
     }

    /*
     * function name :reply
     * To display name and query of customer while replying 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

     public function reply($id = 0){
        $data['reply'] = $this->contact_model->get_msg($id);
        $this->load->view('admin/contact/reply',$data);
     }

     /*
     * function name :reply
     * To reply the message of customer 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

     public function reply_mail($id = 0){
        $reply=$this->input->post('reply_msg');
        $data=array(
          'note_admin'=>$reply,
          'flag'=>1,
          );
        $this->db->set('reply_date', 'NOW()', FALSE);
        $this->load->contact_model->reply_note($data,$id);
        
        $update_reply = $this->contact_model->get_msg($id);
        $name=$update_reply->name;
        $email=$update_reply->email;
        $message=$update_reply->note_admin;

        $data1=array($name,$message);
        $arr1=array('{name}','{reply}');
        $contact_us=$this->email_model->template('admin resp');
        $subject=$contact_us->subject;
        $content=$contact_us->content;
        $var_content=str_replace($arr1,$data1,$content);

            $contact_us=array(
             'email'=>$email,
             'subject'=>$subject,
             'content'=>$var_content,
              );
            
        $this->email_model->email($contact_us);
        $this->session->set_flashdata('success', 'Message has been replied successfully');
        redirect('admin/contact');


     }

    
}