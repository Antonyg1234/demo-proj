

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/form.css">

</head>
<body>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">Banner page</h1>

    </div>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Banner</h3>
        </div>
        <div class="form-horizontal">
            <?php echo form_open_multipart('admin/banner/edit/'.$id); ?>
            <div class="box-body">
                
                <div class="form-group">
                    <label class="col-sm-2 control-label ">Banner Name<span class="required">  *</span></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control capitalize" id="banner_name" name="banner_name" placeholder="Banner Name" value="<?php echo $banner_name; ?>">
                        <span class="required"> <?php echo form_error('banner_name'); ?></span>
                    </div>
                </div>

                <span class="required" style="margin-left: 175px;"><?php echo $this->session->flashdata('error'); ?></span>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Upload Image<span class="required"> *</span></label>
                    <div class="col-sm-6">
                        <input name="uploadedimage" id="imgInp" type="file" placeholder="Change File" class="mandatory_fildes" value="upload">
                        <td style="text-align:center"><img src="<?php echo base_url();?>public/assets/images/uploads/banner/<?php echo $banner_path;?> " alt="" style="width:200px; height:auto;"></td><br>
                        <img id='img-upload' />
                    </div>
                </div>

                <?php echo form_error('uploadedimage'); ?>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Status <span class="required"> *</span></label>
                    <div class="col-sm-10">

                        <label class="radio-inline">
                            <input type="radio" name="status" value="1" <?php if($status == '1') echo "checked";?>> Active
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="0" <?php if($status == '0') echo "checked";?>> Inactive
                        </label>

                        <span class="required"> <?php echo form_error('status'); ?></span>
                    </div>
                </div>



                <div class="clearfix" style="margin-left: 175px;">
                    <button style="width: 75px;display: inline" class="btn btn-block btn-danger" onclick="location.href='<?php echo base_url();?>admin/banner'" type="button" class="cancelbtn">Cancel</button>
                    <button style="width: 75px;display: inline;margin-top: 8px;" type="submit" class="btn btn-block btn-success">Update</button>
                </div>
            </div>

            </form>
        </div>
    </div>
</section>
</body>
</html>