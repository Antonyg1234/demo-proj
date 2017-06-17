

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/form.css">

</head>
<body>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">Configuration page</h1>

    </div>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Configuration</h3>
        </div>
        <div class="form-horizontal">
            <?php echo form_open('admin/config/edit/'.$id); ?>
            <div class="box-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Configuration Key<span class="required">  *</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="conf_key" name="conf_key"  value="<?php echo $conf_key;?>" disabled>
                        <span class="required"> <?php echo form_error('conf_key'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Configuration Value<span class="required">  *</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="conf_value" name="conf_value"  value="<?php echo $conf_value;?>">
                        <span class="required"> <?php echo form_error('conf_value'); ?></span>
                    </div>
                </div>




                <div class="clearfix" style="margin-left: 175px;">
                    <button style="width: 75px;display: inline" class="btn btn-block btn-danger" onclick="location.href='<?php echo base_url();?>admin/config'" type="button" class="cancelbtn">Cancel</button>
                    <button style="width: 75px;display: inline;margin-top: 10px;" type="submit" class="btn btn-block btn-success">Update</button>
                </div>
            </div>

            </form>
        </div>
    </div>
</section>
</body>
</html>