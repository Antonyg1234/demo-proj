<section id="form" style="margin-top: 0px;"><!--form-->
		<div class="container">
			<div class="row">
			<div class="col-sm-12">                 
              <h2 class="title text-center">Forgot <strong>Password</strong></h2>
             </div>
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form"><!--/Sign-up form-->
						<span class="required"><?php echo $this->session->flashdata('error'); ?></span>
						<span class="valid"><?php echo $this->session->flashdata('success'); ?></span>
					
                         <?php echo form_open('forgotPassword', 'id="forgotForm"', 'name="forgotForm"'); ?>
                           <label>Email Id<span class="required">  *</span></label>
                           <input type="text" name="email" placeholder="Enter Registered Email Id" value="<?php echo @$_POST['email']; ?>"/>
                           <span class="required"> <?php echo form_error('email'); ?></span>
	                       <button type="submit" name="submit" class="btn btn-default" style="display: inline;">Submit</button>
	                       <button type="button" name="back" class="btn btn-danger" style="display: inline;margin-left: 4px;" onclick="location.href='<?php echo base_url(); ?>login'">Back</button>
						</form>
					</div><!--/Sign-up form-->
				</div>

			</div>
		</div>
	</section><!--/form-->