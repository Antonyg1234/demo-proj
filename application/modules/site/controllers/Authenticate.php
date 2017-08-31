<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Authenticate extends Site_Controller
{
    function __construct() {
        parent::__construct();

        //Load user model
        $this->load->model('login_model');
    }

    public function index(){
       // echo "wwwwww";die();
        redirect('login');
    }

     /*
     * function name :facebookLogin
     * To login through facebook
     * @author  Antony
     * @access  public
     * @param :
     * @return : 
     */

    public function facebookLogin(){
        $userData = array();

        if($this->facebook->is_authenticated()){
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');

            $userData['fb_token'] = $userProfile['id'];
            $userData['firstname'] = $userProfile['first_name'];
            $userData['lastname'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];

            $userID = $this->login_model->facebookLogin($userData);

            // Check user data insert or update status
            if(!empty($userID)){
                    $userdata = array(
                        'site_user' => array(
                        'id' => $userID,
                        'firstname' => $userData['firstname'],
                        'lastname' => $userData['lastname'],
                        'email' => $userData['email'],
                     ));

                   $this->session->set_userdata($userdata);
                   redirect('site/home');
            }else{
                redirect('login');
            }



        }else{
            $this->session->set_flashdata('error', 'Could not verify credential. Sign up to login');
            redirect('login');
        }

    }

    /*
     * function name :googleLogin
     * To login/signup through google
     * @author  Antony
     * @access  public
     * @param :
     * @return : 
     */


    public function googleLogin(){
       
            // Include the google api php libraries
            include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
            include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
            
            // Google Project API Credentials
            $clientId = '1003259849340-1iu7s4d3ovescu9fn0so9odslspj6v7u.apps.googleusercontent.com';
            $clientSecret = '2IRYfM0A7kucin0xH7Y0bH9O';
            $redirectUrl = base_url() . 'site/authenticate/googleLogin';
            
            // Google Client Configuration
            $gClient = new Google_Client();
            $gClient->setApplicationName('Web client 1');
            $gClient->setClientId($clientId);
            $gClient->setClientSecret($clientSecret);
            $gClient->setRedirectUri($redirectUrl);
            $google_oauthV2 = new Google_Oauth2Service($gClient);

            if (isset($_REQUEST['code'])) {
                $gClient->authenticate();
                $this->session->set_userdata('token', $gClient->getAccessToken());
                redirect($redirectUrl);
            }

            $token = $this->session->userdata('token');
            if (!empty($token)) {
                $gClient->setAccessToken($token);
            }

            if ($gClient->getAccessToken()){
                $userProfile = $google_oauthV2->userinfo->get();
                // Preparing data for database insertion
               
                $userData['google_token'] = $userProfile['id'];
                $userData['firstname'] = $userProfile['given_name'];
                $userData['lastname'] = $userProfile['family_name'];
                $userData['email'] = $userProfile['email'];
             
                // Insert or update user data
                $userID = $this->login_model->facebookLogin($userData);

                if(!empty($userID)){
                    $userdata = array(
                        'site_user' => array(
                        'id' => $userID,
                        'firstname' => $userData['firstname'],
                        'lastname' => $userData['lastname'],
                        'email' => $userData['email'],
                     ));
                  
                   $this->session->set_userdata($userdata);
                   redirect('site/home');
            }else{
                redirect('login');
            }
            } else {
                $data['authUrl'] = $gClient->createAuthUrl();
               // show($data['authUrl']);die();
            }

            $this->load->view('user_authentication/index',$data);
        }

     /*
     * function name :twitterLogin
     * To login/signup through twitter
     * @author  Antony
     * @access  public
     * @param :
     * @return : 
     */

    public function twitterLogin(){
        $userData = array();
               
        //Include the twitter oauth php libraries
        include_once APPPATH."libraries/twitter-oauth-php-codexworld/twitteroauth.php";
        
        //Twitter API Configuration
        $consumerKey = 'qC31LcpEVUeF0Dlna6gveN64M';
        $consumerSecret = 'afRat8HVLr0BtIL2JVnOE6b7lkSjwjH07Uv6dyNMSk8ozH8oGP';
        $oauthCallback = base_url().'site/authenticate/twitterLogin';
        
        //Get existing token and token secret from session
        $sessToken = $this->session->userdata('token');
        $sessTokenSecret = $this->session->userdata('token_secret');
        
        //Get status and user info from session
        $sessStatus = $this->session->userdata('status');
        $sessUserData = $this->session->userdata('userData');
        
        if(isset($sessStatus) && $sessStatus == 'verified'){
            //Connect and get latest tweets
            $connection = new TwitterOAuth($consumerKey, $consumerSecret, $sessUserData['accessToken']['oauth_token'], $sessUserData['accessToken']['oauth_token_secret']); 
           

            //User info from session
            $userData = $sessUserData;
        }elseif(isset($_REQUEST['oauth_token']) && $sessToken == $_REQUEST['oauth_token']){
            //Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
            $connection = new TwitterOAuth($consumerKey, $consumerSecret, $sessToken, $sessTokenSecret); 
            $accessToken = $connection->getAccessToken($_REQUEST['oauth_verifier']);
            
            

            if($connection->http_code == '200'){
                //Get user profile info
                $userInfo = $connection->get('account/verify_credentials');

                //Preparing data for database insertion
                $name = explode(" ",$userInfo->name);
                $first_name = isset($name[0])?$name[0]:'';
                $last_name = isset($name[1])?$name[1]:'';
                
                
                $userData['twitter_token']=$userInfo->id;
                $userData['firstname']=$first_name;
                $userData['lastname']=$last_name;
               
            }else{
                $data['error_msg'] = 'Some problem occurred, please try again later!';
            }
        }
        
        $email=$this->twitter_email($userData);
    
    }

    /*
     * function name :twitter_email
     * To get twitter mail id
     * @author  Antony
     * @access  public
     * @param :
     * @return : 
     */
    public function twitter_email($userData){
        $data['userData']=$userData;
    
                $this->form_validation->set_rules('email', 'Email', 'required');
                if ($this->form_validation->run() == FALSE){

                $this->render('get_email',$data);
                }else{
                $email=$this->input->post('email');
                $firstname=$this->input->post('firstname');
                $lastname=$this->input->post('lastname');
                $twitter_token=$this->input->post('twitter_token');
                $userData=array(
                   'email'=>$email,
                   'firstname'=>$firstname,
                   'lastname'=>$lastname,
                   'twitter_token'=>$twitter_token,
                    );

                $userID = $this->login_model->facebookLogin($userData);

                if(!empty($userID)){
                    $userdata = array(
                        'site_user' => array(
                        'id' => $userID,
                        'firstname' => $userData['firstname'],
                        'lastname' => $userData['lastname'],
                        'email' => $userData['email'],
                     ));
                  
                   $this->session->set_userdata($userdata);
                   redirect('site/home');
              }else{
                   redirect('login');
            }
        }
               
    }

    public function logout() {
        $this->session->unset_userdata('token');
        $this->session->unset_userdata('token_secret');
        $this->session->unset_userdata('status');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        redirect('/user_authentication');
    }
    
    
}