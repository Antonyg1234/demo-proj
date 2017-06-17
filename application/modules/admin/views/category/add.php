<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/form.css">

</head>
<body>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">Category page</h1>

    </div>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
          <div class="box-header with-border">
             <h3 class="box-title">Add Category</h3>
          </div>
     <div class="form-horizontal">
      <?php echo form_open('admin/category/add'); ?>
        <div class="box-body">

            <div class="form-group">
               <label class="col-sm-2 control-label">Category Name<span class="required">  *</span></label>
               <div class="col-sm-10">
                  <input type="text" class="form-control capitalize" id="categoryname" name="categoryname" placeholder="Category Name"  value="<?php echo @$_POST['categoryname']; ?>">
                  <span class="required"> <?php echo form_error('categoryname'); ?></span>
               </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Category Type<span class="required">  *</span></label>
                <div class="col-sm-6">
                    <select id="categorytype" name="categorytype" class="form-control">
                        <option value="">--Select--</option>
                        <?php
                        foreach ($dropdown->result() as $row)
                        {
                            ?>
                            <option value="<?php echo $row->id;?>"><?php echo $row->parent_name;?></option>
                        <?php	} ?>
                    </select>
                    <span class="required"> <?php echo form_error('categorytype'); ?></span>
                </div>
            </div>


            <div class="clearfix" style="margin-left: 175px;">
              <button style="width: 75px;display: inline" class="btn btn-block btn-danger" onclick="location.href='<?php echo base_url();?>admin/category'" type="button" class="cancelbtn">Cancel</button>
              <button style="width: 75px;display: inline;margin-top: 10px;" type="submit" class="btn btn-block btn-success">Add</button>
            </div>
      </div>

     </form>
     </div>
    </div>
</section>
</body>
</html>