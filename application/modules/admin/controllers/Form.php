<?php
/**
 * Created by PhpStorm.
 * User: webwerk
 * Date: 11/5/17
 * Time: 12:36 PM
 */
class Form extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->load->model('admin/user_model');

        //if(!$this->session->userdata('user')){
            //redirect('login');
      //  }
    }

    public function index(){
        $this->render('index');
        
    }
}