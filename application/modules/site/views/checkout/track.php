<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-8 track_center">
         <div class="box">
           <div class="form-horizontal">
           <h2 class="track_head">Track your Order</h2>

              <?php echo form_open('track'); ?>
                 <div class="box-body">
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Email<span class="required">  *</span></label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email"  value="<?php echo $email; ?>">
                        <span class="required"> <?php echo form_error('email'); ?></span>
                        <span class="required"><?php echo $this->session->flashdata('error_mail'); ?></span>
                     </div>
                  </div>

                  <div class="form-group">
                       <label class="col-sm-2 control-label">Order Id<span class="required">  *</span></label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control " id="orderid" name="orderid" placeholder="eg. ORD-000" value="<?php echo $orderid; ?>">
                          <span class="required"> <?php echo form_error('orderid'); ?></span>
                          <span class="required"><?php echo $this->session->flashdata('error'); ?></span>
                      </div>
                  </div>
                  
                  <div class="form-group">
                       <label class="col-sm-2 control-label"></label>
                      <div class="col-sm-6">
                          <button type="submit" name="submit" class="btn btn-warning" style="display: inline;">Submit</button>
                        <button type="button" name="back" class="btn btn-danger" style="display: inline;margin-left: 4px;" onclick="location.href='<?php echo base_url(); ?>'">Back</button>
                      </div>
                  </div>
                  <?php if($msg){ ?>
                  <div class="form-group">
                       <label class="col-sm-2 control-label">Order Status :</label>
                      <div class="col-sm-8 order_msg" >
                         <span class="valid"><?php echo $msg; ?></span> 
                      </div>
                  </div>
                  <?php } ?>
                </div>
              </form>
           <div>
         </div>
      </div>



    </div>
  </div>
</section>

