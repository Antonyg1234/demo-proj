<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Order controller contain order related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */


class Order extends Admin_Controller{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin/order_model');
        

        if (!$this->session->userdata('user')){
            redirect('admin/login');
        }
    }

    /*
     * function name :index
     * To list order details
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

     public function index(){
        //$data = $this->order_model->get_order();
        if (!empty($this->input->post())){
             $data = $this->order_model->get_order();
             echo json_encode($data);
             exit();
         }
         $data['js'] = 'admin/order_table.js';
         $this->render('order',$data);
     }

/*
     * function name :order_detail
     * To display order details in modal
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */
    public function order_detail($id = 0){
    
        $data['order'] = $this->order_model->get_order_detail($id);
        $data['total_cart'] = $this->order_model->order_total($id);
        $this->load->view('admin/order/order_detail',$data);
    } 
 }