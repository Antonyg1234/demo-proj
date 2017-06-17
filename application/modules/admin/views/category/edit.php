

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
            <h3 class="box-title">Edit Category</h3>
        </div>
        <div class="form-horizontal">
            <?php echo form_open('admin/category/edit/'.$id); ?>
            <div class="box-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Category Name<span class="required">  *</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control capitalize" id="categoryname" name="categoryname" placeholder="First Name" value="<?php echo $edit_data->name;?>">
                        <span class="required"> <?php echo form_error('categoryname'); ?></span>
                    </div>
                </div>

                

                <div class="form-group">
                    <label class="col-md-2 control-label">Category Type<span class="required">  *</span></label>
                    <div class="col-sm-6">
                        <select id="role_select" name="categorytype" class="form-control">
                            <option value="<?php echo $edit_data->parent_id;?>"><?php echo $edit_data->parent_name;?></option>
                            <?php
                        foreach ($dropdown->result() as $row)
                        {
                            ?>
                            <option value="<?php echo $row->id;?>"><?php echo $row->parent_name;?></option>
                        <?php   } ?>
                        </select>
                        <span class="required"> <?php echo form_error('categorytype'); ?></span>
                    </div>
                </div>



                <div class="clearfix" style="margin-left: 175px;">
                    <button style="width: 75px;display: inline" class="btn btn-block btn-danger" onclick="location.href='<?php echo base_url();?>admin/category'" type="button" class="cancelbtn">Cancel</button>
                    <button style="width: 75px;display: inline;margin-top: 10px;" type="submit" class="btn btn-block btn-success">Update</button>
                </div>
            </div>

            </form>
        </div>
    </div>
</section>
</body>
</html>