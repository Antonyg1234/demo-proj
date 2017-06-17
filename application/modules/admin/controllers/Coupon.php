<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Coupon controller contain coupon related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class Coupon extends Admin_Controller
{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin/coupon_model');

        if (!$this->session->userdata('user')) {
            redirect('admin/login');
        }
    }

    /*
     * function name :index
     * To list coupon details
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

    public function index(){
        $data = array();
        if (!empty($this->input->post())) {
            $data = $this->coupon_model->get_coupon();
            echo json_encode($data);
            exit();
        }
        $data['js'] = 'admin/coupon_table.js';
        $this->render('index',$data);
    }

    /*
     * function name :add
     * To add coupon
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */
    
    public function add(){
        $this->form_validation->set_rules('code', 'Coupon code', 'trim|required|alpha_numeric');
        $this->form_validation->set_rules('percent_off', 'Percentage Off', 'trim|required|numeric');
        $this->form_validation->set_rules('quantity', 'quantity', 'trim|required|numeric');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->render('add');
        }else{
            $code = $this->input->post('code');
            $percent_off = $this->input->post('percent_off');
            $quantity = $this->input->post('quantity');
            $status = $this->input->post('status');

            $data = array(
                'code' => $code,
                'percent_off' => $percent_off,
                'coupon' => $quantity,
                'status' => $status,
            );

            $this->coupon_model->insert_coupon($data);
            $this->session->set_flashdata('success', 'Coupon added successfully');
            redirect('admin/coupon');
        }
    }
    
    public function edit($id=0){
        $data['id'] =  $id;
        $this->form_validation->set_rules('code', 'Coupon code', 'trim|required|alpha_numeric');
        $this->form_validation->set_rules('percent_off', 'Percentage Off', 'trim|required|numeric');
        $this->form_validation->set_rules('quantity', 'quantity', 'trim|required|numeric');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = $this->coupon_model->get_coupon_update($id);
            $this->render('edit',$data);
        }else{
            $code = $this->input->post('code');
            $percent_off = $this->input->post('percent_off');
            $quantity = $this->input->post('quantity');
            $status = $this->input->post('status');

            $data = array(
                'code' => $code,
                'percent_off' => $percent_off,
                'coupon' => $quantity,
                'status' => $status,
            );
    
            $this->db->set('modify_date', 'NOW()', FALSE);
            $this->coupon_model->update_coupon($data,$id);
            $this->session->set_flashdata('success', 'Coupon updated successfully');
            redirect('admin/coupon');
        }
    }

    /*
    * function name :delete
    *  To delete category
    *
    * @author	Antony
    * @access	public
    * @param :
    * @return : none
    */

    public function delete(){
        $id= $this->input->get('id', TRUE);  //getting id from url
        $data=$id;
        $this->coupon_model->delete_coupon($data);
        $this->session->set_flashdata('success', 'Coupon deleted successfully');
        redirect('admin/coupon');
    }
    
    
}
