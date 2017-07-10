<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Banner controller contain banner related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class Reports extends Admin_Controller{
    
    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin/reports_model');
        if (!$this->session->userdata('user')){
            redirect('admin/login');
        }
    }

    /*
     * function name :sales_chart
     * To get sales detail for the date 
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

    public function sales_chart(){
         $data=$this->reports_model->get_sales_report();
         $data['data']= $data;
         $data['content']=array(
              'header'=> 'Sales Amount Bar Chart',
              'labelname'=>'Sales'
            );
         $data['js'] = 'admin/chart_table.js';
         $this->render('chart',$data);
         
     }

     /*
     * function name :user_chart
     * To get user registered for the date 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

     public function user_chart(){
         $data=$this->reports_model->get_user_report();
         $data['data']= $data;
         $data['content']=array(
              'header'=> 'User Registered Bar Chart',
              'labelname'=>'Users'
            );
         $data['js'] = 'admin/chart_table.js';
         $this->render('chart',$data);
         
     }

     /*
     * function name :coupons_chart
     * To get coupons used for the date 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

      public function coupons_chart(){
         $data=$this->reports_model->get_coupon_report();
         $data['data']= $data;
         $data['content']=array(
              'header'=> 'Coupons used Bar Chart',
              'labelname'=>'Coupons'
            );
         $data['js'] = 'admin/chart_table.js';
         $this->render('chart',$data);
         
     }


 }