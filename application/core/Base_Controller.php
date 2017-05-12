<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends MX_Controller {

    /**
     * Default layout name.
     * 
     * @var string 
     */
    public $_default_layout = 'layouts/site';
    
    /**
     * Custom function to manage the rendering of the view.
     * 
     * @param string $view_name
     * @param array $view_data
     */
    function render($view_name = '', $view_data = array()) {
        
        if($this->router->fetch_class())
           $controller_name = $this->router->fetch_class();
        $layout_data = array(
            'content' => $this->load->view("$controller_name/$view_name", $view_data, TRUE),
            'js' => array_key_exists('js', $view_data) ? $view_data['js'] : array(),
        );
       
        $this->load->view($this->_default_layout, $layout_data);
    }
    
}

