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
        <h1 style="display: inline;">Template page</h1>

    </div>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
          <div class="box-header with-border">
             <h3 class="box-title">Add Template</h3>
          </div>
     <div class="form-horizontal">
      <?php echo form_open_multipart('admin/system/create', 'id="myTemplate"', 'name="myTemplate"'); ?>
        <div class="box-body">

            <div class="form-group">
               <label class="col-sm-2 control-label">Title<span class="required">  *</span></label>
               <div class="col-sm-10">
                  <input type="text" class="form-control capitalize" id="title" name="title" placeholder="Title"  value="<?php echo @$_POST['title']; ?>">
                   <span class="required"> <?php echo form_error('title'); ?></span>
               </div>
            </div>

          <div class="form-group">
               <label class="col-sm-2 control-label">Subject<span class="required">  *</span></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" value="<?php echo @$_POST['price']; ?>">
                  <span class="required"> <?php echo form_error('subject'); ?></span>
              </div>
          </div>

          
            <div class="form-group">
                <label class="col-sm-2 control-label">Content<span class="required">  *</span></label>
                <div class="col-sm-8">
                <textarea id="content" name="content" placeholder="Enter your content here...." value="<?php echo @$_POST['content']; ?>"></textarea>
                </div>

            </div>

            
            
            <div class="clearfix" style="margin-left: 175px;">
              <button style="width: 75px;display: inline" class="btn btn-block btn-danger" onclick="location.href='<?php echo base_url();?>admin/system'" type="button" class="cancelbtn">Cancel</button>
              <button style="width: 75px;display: inline;margin-top: 10px;" type="submit" class="btn btn-block btn-success" onclick="myfunction()">Add</button>
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