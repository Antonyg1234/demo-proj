<?php

/**
 *Cms contain cms related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class Cms extends Site_Controller{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('site/cms_model'); 
        
    }

    /*
     * function name :index
     * To display cms oages
     *
     * @author  Antony
     * @access  public
     * @param : variable
     * @return : none
     */

    public function index($title=0){
      //echo $title;die();

      $page_content=$this->cms_model->get_cms($title);
      $content=$page_content->content;
      $meta_title=$page_content->meta_title;
      $data['var_content']=str_replace('{title}',$meta_title,$content);
      $this->render('index',$data);
    }
}