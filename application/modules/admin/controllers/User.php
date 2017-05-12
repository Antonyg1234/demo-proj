<?php
/**
 * Created by PhpStorm.
 * User: webwerk
 * Date: 11/5/17
 * Time: 12:36 PM
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

    public function index(){
        $data['list'] = $this->user_model->get_user();
        //$data['json']= json_encode($list,JSON_FORCE_OBJECT);

        //echo $data['json'] = json_decode($json, true);die();
        $data['js'] = 'admin/tables.js';
       $this->render('index',$data);
    }

    function logout(){
        $this->load->driver('cache'); # add
        $this->session->sess_destroy(); # Change
        $this->cache->clean();  # add
        redirect('login'); # Your default controller name
        ob_clean(); # add
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


}