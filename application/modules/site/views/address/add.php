<?php
include(SIDENAV);
?>

      <div class="col-md-8">
         <div class="box">
           <div class="form-horizontal">
              <?php echo form_open('site/address/add'); ?>
                 <div class="box-body">

                  <div class="form-group">
                     <label class="col-sm-3 control-label">First Name<span class="required">  *</span></label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control capitalize" id="firstname" name="firstname" placeholder="First Name"  value="<?php echo @$_POST['firstname']; ?>">
                        <span class="required"> <?php echo form_error('firstname'); ?></span>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-sm-3 control-label">Last Name<span class="required">  *</span></label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control capitalize" id="lastname" name="lastname" placeholder="Last Name"  value="<?php echo @$_POST['lastname']; ?>">
                        <span class="required"> <?php echo form_error('lastname'); ?></span>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-sm-3 control-label">Contact No<span class="required">  *</span></label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control capitalize" id="contactno" name="contactno" placeholder="Contact No"  value="<?php echo @$_POST['contactno']; ?>">
                        <span class="required"> <?php echo form_error('contactno'); ?></span>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-sm-3 control-label">Address Line1<span class="required">  *</span></label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control capitalize" id="line1" name="line1" placeholder="Address Line1"  value="<?php echo @$_POST['line1']; ?>">
                        <span class="required"> <?php echo form_error('line1'); ?></span>
                     </div>
                  </div>

                  <div class="form-group">
                       <label class="col-sm-3 control-label">Address Line2</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control capitalize" id="line2" name="line2" placeholder="Address Line2" value="<?php echo @$_POST['line2']; ?>">
                          <span class="required"> <?php echo form_error('line2'); ?></span>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-3 control-label">City<span class="required">  *</span></label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo @$_POST['city']; ?>">
                          <span class="required"> <?php echo form_error('city'); ?></span>
                      </div>
                   </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Country<span class="required">  *</span></label>
                          <div class="col-sm-6">
                            <select id="country" name="country" class="country" class="form-control">
                                <option value="">--Select--</option>
                                <?php foreach ($country->result() as $row){?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                      <?php } ?>
                            </select>
                              <span class="required"> <?php echo form_error('country'); ?></span>
                          </div>
                     </div>

                    <div class="form-group">
                          <label class="col-md-3 control-label">State<span class="required">  *</span></label>
                          <div class="col-sm-6">
                              <select id="state" name="state" class="form-control">
                                  <option value="">--Select--</option>
                                  <?php
                                  foreach ($state->result() as $row)
                                  {
                                      ?>
                                      <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                  <?php } ?>
                              </select>
                              <span class="required"> <?php echo form_error('state'); ?></span>
                          </div>
                    </div>

                    <div class="form-group">
                           <label class="col-sm-3 control-label">Zipcode<span class="required">  *</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Zipcode" value="<?php echo @$_POST['zipcode']; ?>">
                                <span class="required"> <?php echo form_error('zipcode'); ?></span>
                            </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 control-label">Default</label>
                          <div class="checkbox col-sm-8">
                              <label>
                                 <input type="checkbox" name="default"  value="1">
                              </label>
                          </div>
                     </div>
           
                     <div class="clearfix" style="margin-left: 200px;">
                        <button type="submit" name="submit" class="btn btn-warning" style="display: inline;">Submit</button>
                        <button type="button" name="back" class="btn btn-danger" style="display: inline;margin-left: 4px;" onclick="location.href='<?php echo base_url(); ?>site/address'">Back</button>
                      </div>

                 </div>
              </form>
           <div>
         </div>
      </div>





    </div>
  </div>
</section>

