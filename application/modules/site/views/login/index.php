<section id="form" style="margin-top: 0px;"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--/Sign-up form-->
				     <span class="valid" style="align-text: center; font-size: 18px;">
                            <?php
                             echo $this->session->flashdata('login');
                             ?>
                       </span> 
						<h2>New User Signup!</h2>
                         <?php echo form_open('signUp', 'id="siteForm"', 'name="siteForm"'); ?>
                           <label>First Name<span class="required">  *</span></label>
                           <input type="text" class="capitalize" name="firstname" placeholder="First Name" value="<?php echo @$_POST['firstname']; ?>"/>
                           <span class="required"> <?php echo form_error('firstname'); ?></span>

                           <label>Last Name<span class="required">  *</span></label>
                           <input type="text" class="capitalize" name="lastname" placeholder="Last Name" value="<?php echo @$_POST['lastname']; ?>"/>
                           <span class="required"> <?php echo form_error('lastname'); ?></span>
                           
                           <label>Contact No<span class="required">  *</span></label>
                           <input type="text" name="contactno" placeholder="Contact No" value="<?php echo @$_POST['contactno']; ?>"/>
                            <span class="required"> <?php echo form_error('contactno'); ?></span>

	                       <label>Email<span class="required">  *</span></label>
	                       <input type="email" name="email" placeholder="Email Address" value="<?php echo @$_POST['email']; ?>"/>
	                       <span class="required"> <?php echo form_error('email'); ?></span>

	                       <label>Password<span class="required">  *</span></label>
	                       <input type="password" name="password" placeholder="Password" value="<?php echo @$_POST['password']; ?>"/>
	                       <span class="required"> <?php echo form_error('password'); ?></span>

	                       <label>Confirm Password<span class="required">  *</span></label>
	                       <input type="password" name="password_confirm" placeholder="Confirm Password" value="<?php echo @$_POST['password_confirm']; ?>"/>
	                       <span class="required"> <?php echo form_error('password_confirm'); ?></span>
	                       
	                       <button type="submit" name="submit" class="btn btn-default">Signup</button>
	                      

	                       
                        </form>
					</div><!--/Sign-up form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4" >
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						    
						<?php echo form_open('site/login/postLogin' , 'id="regForm"', 'name="regForm"'); ?>

						    <label>Email Address<span class="required">  *</span></label>
							<input type="email" name="reg_email" placeholder="Email Address" />
							<span class="required"> <?php echo form_error('reg_email'); ?></span>
							<label>Password<span class="required">  *</span></label>
							<input type="password" name="reg_password" placeholder="Password" />
							<span class="required"> <?php echo form_error('reg_password'); ?></span>
							
							<button type="submit" name="submit" class="btn btn-default">Login</button>
							<br>
							<a href="<?php echo base_url(); ?>forgotPassword">Forgot Password</a>
							<div style="align-text: center"><span class="required" style="align-text: center; font-size: 18px;">
                            <?php
                             echo $this->session->flashdata('error');
                             ?>
                            
                            </span>
                            <span class="valid" style="align-text: center; font-size: 18px;">
                            <?php
                             echo $this->session->flashdata('success');
                             ?>
                             </span>
                            </div>
                            
                            <?php 
                              $auth_url=$this->facebook->login_url();
                            ?>
                           
                            <a href="<?php echo $auth_url; ?>"><img src="<?php echo base_url(); ?>public/assets/images/home/fb_login.png" alt="" class="img_width"/></a><br>

                           <?php 
                           include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
                           include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php"; 

                           $clientId = '1003259849340-1iu7s4d3ovescu9fn0so9odslspj6v7u.apps.googleusercontent.com';
                           $clientSecret = '2IRYfM0A7kucin0xH7Y0bH9O';
                           $redirectUrl = base_url() . 'site/authenticate/googleLogin';
                            $gClient = new Google_Client();
				            $gClient->setApplicationName('Web client 1');
				            $gClient->setClientId($clientId);
				            $gClient->setClientSecret($clientSecret);
				            $gClient->setRedirectUri($redirectUrl);
				            $google_oauthV2 = new Google_Oauth2Service($gClient);

                            $google_auth_url=$gClient->createAuthUrl();

                            ?>

                            <a href="<?php echo $google_auth_url; ?>"><img src="<?php echo base_url(); ?>public/assets/images/home/google.png" alt="" class="google_width"/></a><br>

                            <?php 
                            include_once APPPATH."libraries/twitter-oauth-php-codexworld/twitteroauth.php";
        
					        //Twitter API Configuration
					        $consumerKey = 'qC31LcpEVUeF0Dlna6gveN64M';
					        $consumerSecret = 'afRat8HVLr0BtIL2JVnOE6b7lkSjwjH07Uv6dyNMSk8ozH8oGP';
					        $oauthCallback = base_url().'site/authenticate/twitterLogin';

					        $this->session->unset_userdata('token');
            $this->session->unset_userdata('token_secret');
            
            //Fresh authentication
            $connection = new TwitterOAuth($consumerKey, $consumerSecret);
            $requestToken = $connection->getRequestToken($oauthCallback);
            
            //Received token info from twitter
            $this->session->set_userdata('token',$requestToken['oauth_token']);
            $this->session->set_userdata('token_secret',$requestToken['oauth_token_secret']);
            
            //Any value other than 200 is failure, so continue only if http code is 200
            if($connection->http_code == '200'){
                //redirect user to twitter
                $twitterUrl = $connection->getAuthorizeURL($requestToken['oauth_token']);
                $data['oauthURL'] = $twitterUrl;
                //show($twitterUrl);
            }else{
                $data['oauthURL'] = base_url().'site/authenticate/logout';
                $data['error_msg'] = 'Error connecting to twitter! try again later!';
            }
                            ?>


                            <a href="<?php echo $twitterUrl; ?>"><img src="<?php echo base_url(); ?>public/assets/images/home/twitter.jpg" alt="" class="google_width"/></a>
						</form>
					</div><!--/login form-->
				</div>
				
			</div>
		</div>
	</section><!--/form-->
	