<section id="form" style="margin-top: 0px;"><!--form-->
		<div class="container">
			<div class="row">
			
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form"><!--/Sign-up form-->
						<h2>Create New Password!</h2>
                         <span class="valid"><?php echo $this->session->flashdata('success'); ?></span>
                         <?php echo form_open('reset_password/'.$key, 'id="createForm"', 'name="createForm"'); ?>
                           <label>New Password<span class="required">  *</span></label>
                           <input type="password" name="new_password" placeholder="New Password" value="<?php echo @$_POST['new_password']; ?>"/>
                           <span class="required"> <?php echo form_error('new_password'); ?></span>
                           
                           <label>Confirm Password<span class="required">  *</span></label>
                           <input type="password" name="confirm_password" placeholder="Confirm Password" value="<?php echo @$_POST['confirm_password']; ?>"/>
                           <span class="required"> <?php echo form_error('confirm_password'); ?></span>

                           <button type="submit" name="submit" class="btn btn-default" style="display: inline;">Submit</button>
	                       <button type="button" name="back" class="btn btn-danger" style="display: inline;margin-left: 4px;" onclick="location.href='http://10.0.11.84/ShopCart/login'">Back</button>
						
					</div><!--/Sign-up form-->
				</div>

			</div>
		</div>
	</section><!--/form-->