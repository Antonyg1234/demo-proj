<?php
include(SIDENAV);
?>  <div class="col-sm-8">                 
          <h2 class="title text-center">Edit <strong>Address</strong></h2>                                  
        </div>
    
      <div class="col-md-8">
        <div class="box">
          <div class="form-horizontal">
            <?php echo form_open('address/edit/'.$id); ?>
              <div class="box-body">

               <div class="form-group">
                     <label class="col-sm-3 control-label">First Name<span class="required">  *</span></label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control capitalize" id="firstname" name="firstname" placeholder="First Name"  value="<?php echo $address_data->firstname;?>">
                        <span class="required"> <?php echo form_error('firstname'); ?></span>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-sm-3 control-label">Last Name<span class="required">  *</span></label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control capitalize" id="lastname" name="lastname" placeholder="Last Name"  value="<?php echo $address_data->lastname;?>">
                        <span class="required"> <?php echo form_error('lastname'); ?></span>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-sm-3 control-label">Contact No<span class="required">  *</span></label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control capitalize" id="contactno" name="contactno" placeholder="Contact No"  value="<?php echo $address_data->contact_no;?>">
                        <span class="required"> <?php echo form_error('contactno'); ?></span>
                     </div>
                  </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Address Line1<span class="required">  *</span></label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control capitalize" id="line1" name="line1" placeholder="Address Line1"  value="<?php echo $address_data->address_1;?>">
                   <span class="required"> <?php echo form_error('line1'); ?></span>
                  </div>
                </div>

                <div class="form-group">
                   <label class="col-sm-3 control-label">Address Line2</label>
                   <div class="col-sm-8">
                    <input type="text" class="form-control capitalize" id="line2" name="line2" placeholder="Address Line2" value="<?php echo $address_data->address_2;?>">
                    <span class="required"> <?php echo form_error('line2'); ?></span>
                   </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">City<span class="required">  *</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $address_data->city;?>">
                        <span class="required"> <?php echo form_error('city'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">Country<span class="required">  *</span></label>
                    <div class="col-sm-6">
                      <select id="country" name="country" class="country" class="form-control">
                        <option value="<?php echo $address_data->countryid;?>"><?php echo $address_data->countryname;?></option>
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
                        <select id="state" name="state" class="form-control state">
                          <option value="<?php echo $address_data->stateid;?>"><?php echo $address_data->statename;?></option>
                          <?php foreach ($state->result() as $row){?>
                          <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                          <?php } ?>
                        </select>
                      <span class="required"> <?php echo form_error('state'); ?></span>
                    </div>
                </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Zipcode<span class="required">  *</span></label>
                <div class="col-sm-8">
                   <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Zipcode" value="<?php echo $address_data->zipcode;?>">
                   <span class="required"> <?php echo form_error('zipcode'); ?></span>
                </div>
              </div>

               <div class="form-group">
                    <label class="col-sm-3 control-label">Default <span class="required"> *</span></label>
                    <div class="checkbox col-sm-8">

                        <label>
                            <input type="checkbox" name="default" <?php if($address_data->default == '1') echo "checked";?> value="1">
                        </label>
                    </div>
                </div>
           
             <div class="clearfix" style="margin-left: 200px;">
                <button type="submit" name="submit" class="btn btn-warning" style="display: inline;">Submit</button>
                <button type="button" name="back" class="btn btn-danger" style="display: inline;margin-left: 4px;" onclick="location.href='<?php echo base_url(); ?>site/address'">Back</button>
            </div>



              </div>
            </form>
          </div>
        </div>
      </div>       
    

    </div>
  </div>
</section>

    