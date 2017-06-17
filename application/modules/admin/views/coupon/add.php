<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/form.css">
</head>
<body>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">Coupon page</h1>

    </div>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
          <div class="box-header with-border">
             <h3 class="box-title">Add Coupon</h3>
          </div>
     <div class="form-horizontal">
      <?php echo form_open_multipart('admin/coupon/add','id="myCoupon"', 'name="myCoupon"'); ?>
        <div class="box-body">

            <div class="form-group">
               <label class="col-sm-2 control-label">Coupon Code<span class="required">  *</span></label>
               <div class="col-sm-10">
                  <input type="text" class="form-control " id="code" name="code" placeholder="Coupon Code"  value="<?php echo @$_POST['code']; ?>">
                   <span class="required"> <?php echo form_error('code'); ?></span>
               </div>
            </div>

          <div class="form-group">
               <label class="col-sm-2 control-label">Percentage Off<span class="required">  *</span></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="percent_off" name="percent_off" placeholder="Percentage-off" value="<?php echo @$_POST['percent_off']; ?>">
                  <span class="required"> <?php echo form_error('percent_off'); ?></span>
              </div>
          </div>

          <div class="form-group">
                <label class="col-sm-2 control-label">Quantity<span class="required">  *</span></label>
                <div class="col-sm-10">
                   <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="<?php echo @$_POST['quantity']; ?>">
                   <span class="required"> <?php echo form_error('quantity'); ?></span>
                </div>
          </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Status <span class="required"> *</span></label>
                <div class="col-sm-10" >
                    <label class="radio-inline">
                        <input type="radio" name="status" value="1" checked="checked">Active
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" value="0">Inactive
                    </label>
                    <span class="required"> <?php echo form_error('status'); ?></span>
                </div>
            </div>

            <div class="clearfix" style="margin-left: 175px;">
              <button style="width: 75px;display: inline" class="btn btn-block btn-danger" onclick="location.href='<?php echo base_url();?>admin/product'" type="button" class="cancelbtn">Cancel</button>
              <button style="width: 75px;display: inline;margin-top: 10px;" type="submit" class="btn btn-block btn-success">Add</button>
            </div>
      </div>

     </form>
     </div>
    </div>
</section>
</body>
</html>