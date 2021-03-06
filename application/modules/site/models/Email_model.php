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
      $config['smtp_port'] = "587";
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

//    public function email($data){
//        //	var_dump($data);die();
//        $to=$data['email'];
//        $subject=$data['subject'];
//        $html=$data['content'];
////        $config['protocol'] = "smtp";
////        $config['smtp_host'] = SMTP_HOST;
////        $config['smtp_port'] = "25";
////        $config['smtp_user'] = SMTP_USER;
////        $config['smtp_pass'] = SMTP_PASS;
////        $config['charset'] = "utf-8";
////        $config['mailtype'] = "html";
////        $config['newline'] = "\r\n";
////        $this->email->initialize($config);
//
//        $from='antony.george@neosofttech.com';
//        //$this->email->from(SMTP_USER, 'E-Shopper');
//        //$this->email->to($email);
//        //$this->email->subject($subject);
//        //$this->email->message($content);
//        $this->Sengrid_Mail->send($to, $subject, $text=NULL, $html=NULL, $from, $toname=NULL, $xsmtpapi=NULL, $bcc=NULL, $fromname=NULL, $replyto=NULL, $date=NULL, $files=NULL, $headers=array());
//    }
}