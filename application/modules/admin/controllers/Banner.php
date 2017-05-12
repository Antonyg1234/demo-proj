<?php

/**
 * Created by PhpStorm.
 * User: webwerk
 * Date: 11/5/17
 * Time: 9:58 AM
 */
class Banner extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $name='antony';
        $data = array(
            'firstname' => $name,
        );
        $this->render('index',$data);
    }
}