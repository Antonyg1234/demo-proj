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
                         <?php echo form_open('site/login/signUp', 'id="siteForm"', 'name="siteForm"'); ?>
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
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
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
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	