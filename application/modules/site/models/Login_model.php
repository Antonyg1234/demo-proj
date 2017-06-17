<?php

/**
 * Login model contain login related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class Login_model extends CI_Model{

   function __construct(){
        parent::__construct();
    }

/*
       * function name :create_user
       *  To insert User
       *
       * @author	Antony
       * @access	public
       * @param : array
       * @return : none
       */
    public function create_user($data)
    {
        $this->db->insert('user', $data);

    }

      /*
       * function name :processLogin
       *  To check login credentials
       *
       * @author  Antony
       * @access  public
       * @param : variable
       * @return : object
       */
 

     public function processLogin($email=NULL,$password){
        $this->db->select("id,firstname,lastname,email,password,roles");
        $whereCondition = $array = array('email' =>$email,'password'=>$password,'roles ='=>5);
        $this->db->where($whereCondition);
        $this->db->from('user');
        $result = $this->db->get()->row();
        // echo $this->db->last_query();die;
        return $result;
    }

      /*
       * function name :mailCheck
       *  To check mail credentials
       *
       * @author  Antony
       * @access  public
       * @param : variable
       * @return : boolean
       */
 

     public function mailCheck($email=NULL){
        $this->db->select("id,email,password,roles");
        $whereCondition = $array = array('email' =>$email,'roles ='=>5);
        $this->db->where($whereCondition);
        $this->db->from('user');
        $result = $this->db->get()->row();
        if ($result){
        return true;
        }
        else{
        return false;
        }

        }

      /*
       * function name :update_token
       * To update token 
       *
       * @author  Antony
       * @access  public
       * @param : array
       * @return : none
       */

    public function update_token($data,$email){
        $this->db->where('email', $email);
        $this->db->update('user', $data);

    }

     /*
       * function name :getMail
       * To check valid token 
       *
       * @author  Antony
       * @access  public
       * @param : array
       * @return : boolean
       */


    public function getMail($key){
      $this->db->select("id,firstname,lastname,email,password,roles");
      $this->db->where('token', $key);
      $this->db->from('user');
      $result = $this->db->get()->row();
      if ($result){
        return true;
        }
        else{
        return false;
        }
      }

      /*
       * function name :update_password
       * To change password 
       *
       * @author  Antony
       * @access  public
       * @param : array
       * @return : 
       */

    public function update_password($data,$key){
        $this->db->where('token', $key);
        $this->db->update('user', $data);
    }


 }