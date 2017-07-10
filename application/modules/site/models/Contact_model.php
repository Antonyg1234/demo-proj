<?php

/**
 * Login model contain login related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class Contact_model extends CI_Model{

   function __construct(){
        parent::__construct();
    }

/*
       * function name :insert_message
       * To insert message query of users
       *
       * @author	Antony
       * @access	public
       * @param : array
       * @return : none
       */
    public function insert_message($data)
    {
        $this->db->insert('contact_us', $data);

    }
  }