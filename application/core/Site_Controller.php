<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site_Controller extends Base_Controller {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->driver('cache', array('adapter' => 'redis', 'backup' => 'file'));
    }

    /**
     * Default layout name.
     *
     * @var string
     */
    public $_default_layout = 'layouts/site';
}