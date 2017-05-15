<?php
/**
 * Login User contain user related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class User extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/user_model');

        if(!$this->session->userdata('user')){
            redirect('login');
        }
    }
    /*
        * function name :index
        *  To list user
        *
        * @author	Antony
        * @access	public
        * @param :
        * @return : none
        */

    public function index(){
        $data['list'] = $this->user_model->get_user();
        //$data['json']= json_encode($list,JSON_FORCE_OBJECT);

        //echo $data['json'] = json_decode($json, true);die();
        $data['js'] = 'admin/tables.js';
        $this->render('index',$data);
    }

    public function add(){
        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|alpha');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|alpha');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|alpha');
        if ($this->form_validation->run() == FALSE)
        {
            $this->render('add');
        }

        
    }

    public function edit($id=0){
        $this->render('edit');
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
        $this->user_model->delete_user($data);
        redirect('admin/user');
    }

    /*
      * function name :logout
      *  To logout session
      *
      * @author	Antony
      * @access	public
      * @param :
      * @return : none
      */
    function logout(){
        $this->load->driver('cache'); # add
        $this->session->sess_destroy(); # Change
        $this->cache->clean();  # add
        redirect('login'); # Your default controller name
        ob_clean(); # add
    }


}