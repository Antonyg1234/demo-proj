<?php

/**
 * Email model contain email related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class Email_model extends CI_Model{

   function __construct(){
        parent::__construct();
    }

function template($title){
      $this->db->select("id,title,subject,content");  
      $this->db->where('title',$title);
      $result = $this->db->get('email_template')->row();
       //echo $this->db->last_query();die;
      return $result;
    }

    /*
     * function name :email
     * To send all mail
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    public function email($data){
    //	var_dump($data);die();
      $email=$data['email'];
      $subject=$data['subject'];
      $content=$data['content'];
      $config['protocol'] = "smtp";
      $config['smtp_host'] = SMTP_HOST;
      $config['smtp_port'] = "25";
      $config['smtp_user'] = SMTP_USER; 
      $config['smtp_pass'] = SMTP_PASS;
      $config['charset'] = "utf-8";
      $config['mailtype'] = "html";
      $config['newline'] = "\r\n";
      $this->email->initialize($config);

      $this->email->from(SMTP_USER, 'E-Shopper');
      $this->email->to($email);
      $this->email->subject($subject);
      $this->email->message($content);
      $this->email->send();
    }
}