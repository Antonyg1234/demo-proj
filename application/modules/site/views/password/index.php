<?php
include(SIDENAV);
?>
      <div class="col-md-8">
         <div class="box">
           <div class="form-horizontal">

              <?php echo form_open('site/password'); ?>
                 <div class="box-body">
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Old Password<span class="required">  *</span></label>
                     <div class="col-sm-8">
                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password"  value="<?php echo @$_POST['old_password']; ?>">
                        <span class="required"> <?php echo form_error('old_password'); ?></span>
                     </div>
                  </div>

                  <div class="form-group">
                       <label class="col-sm-3 control-label">New Password<span class="required">  *</span></label>
                      <div class="col-sm-8">
                          <input type="password" class="form-control " id="new_password" name="new_password" placeholder="New Password" value="<?php echo @$_POST['new_password']; ?>">
                          <span class="required"> <?php echo form_error('new_password'); ?></span>
                      </div>
                  </div>

                    <div class="form-group">
                       <label class="col-sm-3 control-label">Confirm Password<span class="required">  *</span></label>
                      <div class="col-sm-8">
                          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?php echo @$_POST['confirm_password']; ?>">
                          <span class="required"> <?php echo form_error('confirm_password'); ?></span>
                      </div>
                  </div>
                 
                     <div class="clearfix" style="margin-left: 200px;">
                        <button type="submit" name="submit" class="btn btn-warning" style="display: inline;">Submit</button>
                        <button type="button" name="back" class="btn btn-danger" style="display: inline;margin-left: 4px;" onclick="location.href='<?php echo base_url(); ?>site/address'">Back</button>
                      </div>


                
                  
                  <div class="col-sm-6 col-sm-offset-3">
                  <span class="required"><?php echo $this->session->flashdata('error'); ?></span>
                  <span class="valid"><?php echo $this->session->flashdata('success'); ?></span>
                 </div> 



                 </div>
              </form>
           <div>
         </div>
      </div>





    </div>
  </div>
</section>

