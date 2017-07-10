<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/form.css">
    <script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
</head>
<body>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">Cms page</h1>

    </div>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
          <div class="box-header with-border">
             <h3 class="box-title">Add Cms</h3>
          </div>
     <div class="form-horizontal">
      <?php echo form_open_multipart('admin/cms/add','id="myCms"', 'name="myCms"'); ?>
        <div class="box-body">

            <div class="form-group">
               <label class="col-sm-2 control-label">Title<span class="required">  *</span></label>
               <div class="col-sm-10">
                  <input type="text" class="form-control " id="title" name="title" placeholder="Title"  value="<?php echo @$_POST['title']; ?>">
                   <span class="required"> <?php echo form_error('title'); ?></span>
               </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Content<span class="required">  *</span></label>
                <div class="col-sm-8">
                <textarea id="content" name="content" placeholder="Enter your content here...."></textarea>
                </div>
                <span class="required"> <?php echo form_error('content'); ?></span>
            </div>

          <div class="form-group">
               <label class="col-sm-2 control-label">Meta Title<span class="required">  *</span></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title" value="<?php echo @$_POST['meta_title']; ?>">
                  <span class="required"> <?php echo form_error('meta_title'); ?></span>
              </div>
          </div>

          <div class="form-group">
                <label class="col-sm-2 control-label">Meta Description<span class="required">  *</span></label>
                <div class="col-sm-10">
                   <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description" value="<?php echo @$_POST['meta_description']; ?>">
                   <span class="required"> <?php echo form_error('meta_description'); ?></span>
                </div>
          </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Meta Keyword<span class="required">  *</span></label>
                <div class="col-sm-10">
                   <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Meta Keyword" value="<?php echo @$_POST['meta_keyword']; ?>">
                   <span class="required"> <?php echo form_error('meta_keyword'); ?></span>
                </div>
          </div>

            <div class="form-group">
               <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                <button style="width: 75px;display: inline" class="btn btn-block btn-danger" onclick="location.href='<?php echo base_url();?>admin/cms'" type="button" class="cancelbtn">Cancel</button>
                <button style="width: 75px;display: inline;" type="submit" class="btn btn-block btn-success">Add</button>
                </div>
            </div>
      </div>

     </form>
     </div>
    </div>
</section>
<script>
   CKEDITOR.replace('content');
</script>
</body>
</html>