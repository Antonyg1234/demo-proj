<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Address controller contain address related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class Address extends Site_Controller{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('site/address_model');
       //$data['sidenav']=$this->load->view('site/layouts/sidenav');
        if(!$this->session->userdata('site_user')){
            redirect('site/home');
        }
    }


    /*
     * function name :index
     * To get address details of user
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    public function index(){
        $id=$this->session->userdata['site_user']['id'];
       // echo $id;die();
        $data['address'] = $this->address_model->get_address($id);
        $this->render('index',$data);
    }

    /*
     * function name :add
     * To add address of user
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    public function add(){
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('contactno', 'Contact No', 'trim|required|numeric|min_length[8]|max_length[10]');
        $this->form_validation->set_rules('line1', 'Address line 1', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('zipcode', 'Zipcode', 'required|numeric');

        if ($this->form_validation->run() == FALSE){
            $data['country'] = $this->address_model->get_country();
            $data['state'] = $this->address_model->get_state();
            $this->render('add',$data);
        }else {
                $id=$this->session->userdata['site_user']['id'];
                $firstname = $this->input->post('firstname');
                $lastname = $this->input->post('lastname');
                $contactno = $this->input->post('contactno');
                $line1 = $this->input->post('line1');
                $line2 = $this->input->post('line2');
                $city = $this->input->post('city');
                $state = $this->input->post('state');
                $country = $this->input->post('country');
                $zipcode = $this->input->post('zipcode');
                $default = $this->input->post('default');

                 if($default==1){
                  $default=1;
                 }else{
                  $default=0;
                 }

   
                $data = array(
                    'user_id' => $id,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'contact_no' => $contactno,
                    'address_1' => $line1,
                    'address_2' => $line2,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'zipcode' => $zipcode,
                    'default' => $default,
                );
             
                $this->db->set('created_at', 'NOW()', FALSE);
                $this->address_model->insert_address($data);
                $this->session->set_flashdata('success', 'Address added successfully');
                redirect('site/address');
        }
    }


    public function get_state(){
     $country_id = $this->input->post('country_id');
     //$country_id=101;
     $data=$this->checkout_model->get_state_select($country_id);
     foreach ($data as $key => $value) {
    
     $html.='<select class="state" name="state" id="state">'.'<option value="'.$value->id.'">'.$value->name.'</option></select>'; 

     }
     echo json_encode($html);
     //return $data;
     }

    /*
     * function name :add
     * To edit address of user
     *
     * @author  Antony
     * @access  public
     * @param : number
     * @return : none
     */


    public function edit($id=0){
    $user_id=$this->session->userdata['site_user']['id'];
        
    $data['id'] =  $id;
    //echo $id;die();
    $this->form_validation->set_rules('firstname', 'First Name', 'required');
    $this->form_validation->set_rules('lastname', 'Last Name', 'required');
    $this->form_validation->set_rules('lastname', 'Last Name', 'required');
    $this->form_validation->set_rules('contactno', 'Contact No', 'trim|required|numeric|min_length[8]|max_length[10]');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('state', 'State', 'required');
    $this->form_validation->set_rules('country', 'Country', 'required');
    $this->form_validation->set_rules('zipcode', 'Zipcode', 'required|numeric');

    if ($this->form_validation->run() == FALSE){
        $data['country'] = $this->address_model->get_country();
        $data['state'] = $this->address_model->get_state();
        $data['address_data'] = $this->address_model->get_address_update($id);
        $this->render('edit',$data);
    }else {          
                    $firstname = $this->input->post('firstname');
                    $lastname = $this->input->post('lastname');
                    $contactno = $this->input->post('contactno');
                    $line1 = $this->input->post('line1');
                    $line2 = $this->input->post('line2');
                    $city = $this->input->post('city');
                    $state = $this->input->post('state');
                    $country = $this->input->post('country');
                    $zipcode = $this->input->post('zipcode');
                    $default = $this->input->post('default');
                    
                    if($default==1){
                       $defaultn=1;
                    }else{
                       $defaultn=0;
                    }

                    $data = array(
                    'user_id' => $user_id,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'contact_no' => $contactno,
                    'address_1' => $line1,
                    'address_2' => $line2,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'zipcode' => $zipcode,
                    'default' => $defaultn,
                    );
                 
                    $this->db->set('updated_at', 'NOW()', FALSE);
                    $this->address_model->update_address($data,$id);
                    $this->session->set_flashdata('success', 'Address edited successfully');
                    redirect('site/address');
             }
  }

    /*
     * function name :delete
     *  To delete address 
     *
     * @author  Antony
     * @access  public
     * @param :
     * @return : none
     */

    public function delete(){
        $id= $this->input->get('id', TRUE);  
        $this->address_model->delete_address($id);
        redirect('site/address');
    }


}