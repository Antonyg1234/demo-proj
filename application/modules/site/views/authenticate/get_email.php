<section id="form" style="margin-top: 0px;"><!--form-->
		<div class="container">
			<div class="row">
			<div class="col-sm-12">                 
              <h2 class="title text-center">Twitter <strong>Login</strong></h2>
             </div>
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form"><!--/Sign-up form-->
						<span class="required"><?php echo $this->session->flashdata('error'); ?></span>
						<span class="valid"><?php echo $this->session->flashdata('success'); ?></span>
					
                         <?php echo form_open('site/authenticate/twitter_email', 'id="twitterForm"', 'name="twitterForm"'); ?>
                           <label>Email Id<span class="required">  *</span></label>
                           <input type="text" name="email" placeholder="Enter Twitter Email Id" value="<?php echo @$_POST['email']; ?>"/>
                           <input type="hidden" name="firstname" placeholder="Enter Twitter Email Id" value="<?php echo $userData['firstname']; ?>"/>
                           <input type="hidden" name="lastname" placeholder="Enter Twitter Email Id" value="<?php echo $userData['lastname']; ?>"/>
                           <input type="hidden" name="twitter_token" placeholder="Enter Twitter Email Id" value="<?php echo $userData['twitter_token']; ?>"/>
                           <span class="required"> <?php echo form_error('email'); ?></span>
	                       <button type="submit" name="submit" class="btn btn-default" style="display: inline;">Submit</button>
	                       <button type="button" name="back" class="btn btn-danger" style="display: inline;margin-left: 4px;" onclick="location.href='<?php echo base_url(); ?>login'">Back</button>
						</form>
					</div><!--/Sign-up form-->
				</div>

			</div>
		</div>
	</section><!--/form-->