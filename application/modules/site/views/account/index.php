<?php
include(SIDENAV);
?>
      <div class="col-sm-8">                 
          <h2 class="title text-center">Profile <strong>Details</strong></h2>                                  
       </div>
      <div class="col-md-8">
         <div class="box">
           <div class="form-horizontal">

              <?php echo form_open('account/edit/'.$account->id); ?>
                 <div class="box-body">
                  <div class="form-group">
                     <label class="col-sm-3 control-label">First Name<span class="required">  *</span></label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"  value="<?php echo $account->firstname;?>">
                        <span class="required"> <?php echo form_error('firstname'); ?></span>
                     </div>
                  </div>

                  <div class="form-group">
                       <label class="col-sm-3 control-label">Last Name<span class="required">  *</span></label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control " id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $account->lastname;?>">
                          <span class="required"> <?php echo form_error('lastname'); ?></span>
                      </div>
                  </div>

                    <div class="form-group">
                       <label class="col-sm-3 control-label">Email<span class="required">  *</span></label>
                      <div class="col-sm-8">
                          <input type="email" class="form-control" id="email" name="email" value="<?php echo $account->email;?>" disabled>
                          <span class="required"> <?php echo form_error('email'); ?></span>
                      </div>
                  </div>

                  <div class="form-group">
                       <label class="col-sm-3 control-label">Contact no.<span class="required">  *</span></label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No." value="<?php echo $account->contact_no;?>">
                          <span class="required"> <?php echo form_error('contact_no'); ?></span>
                      </div>
                  </div>
                 
                     <div class="clearfix" style="margin-left: 200px;">
                        <button type="submit" name="submit" class="btn btn-warning" style="display: inline;">Submit</button>
                        <button type="button" name="back" class="btn btn-danger" style="display: inline;margin-left: 4px;" onclick="location.href='<?php echo base_url(); ?>'">Back</button>
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

