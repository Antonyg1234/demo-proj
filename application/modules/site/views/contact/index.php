<section class="content">
  <div class="container">
    <div class="row">
       <div class="col-sm-12">                 
          <h2 class="title text-center">Contact <strong>Us</strong></h2>                                  
        </div>
      <div class="col-md-8 track_center">
         <div class="box">
           <div class="form-horizontal">
           
             <?php echo form_open('contact'); ?>
                 <div class="box-body">
                 <div class="form-group">
                     <label class="col-sm-2 control-label"></label>
                     <div class="col-sm-7">
                     <span class="valid"><?php echo $this->session->flashdata('success'); ?></span>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-sm-2 control-label">Name<span class="required">  *</span></label>
                     <div class="col-sm-7">
                        <input type="text" class="form-control capitalize" id="name" name="name" placeholder="Name"  value="<?php echo @$_POST['name']; ?>">
                        <span class="required"> <?php echo form_error('name'); ?></span>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-sm-2 control-label">Email<span class="required">  *</span></label>
                     <div class="col-sm-7">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email"  value="<?php echo @$_POST['email']; ?>">
                        <span class="required"> <?php echo form_error('email'); ?></span>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-sm-2 control-label">Contact No<span class="required">  *</span></label>
                     <div class="col-sm-7">
                        <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact No"  value="<?php echo @$_POST['contactno']; ?>">
                        <span class="required"> <?php echo form_error('contactno'); ?></span>
                     </div>
                  </div>

                  <div class="form-group">
                       <label class="col-sm-2 control-label">Message<span class="required">  *</span></label>
                      <div class="col-sm-7">
                          <textarea name="message" class="form-control capitalize" rows="3" placeholder="Enter your message"></textarea>
                          <span class="required"> <?php echo form_error('message'); ?></span>
                      </div>
                  </div>
                  
                  <div class="form-group">
                       <label class="col-sm-2 control-label"></label>
                      <div class="col-sm-7">
                        <button type="submit" name="submit" class="btn btn-warning" style="display: inline;">Submit</button>
                        <button type="button" name="back" class="btn btn-danger" style="display: inline;margin-left: 4px;" onclick="location.href='<?php echo base_url(); ?>'">Back</button>
                      </div>
                  </div>
               
                </div>
              </form>
           <div>
         </div>
      </div>



    </div>
  </div>
</section>

