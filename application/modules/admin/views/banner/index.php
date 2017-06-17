<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">Banner Management page</h1>
        <div class="pull-right">
            <a href="<?php echo base_url();?>admin/banner/add" class="btn btn-primary">Add Banner</a>
        </div>
    </div>
</section>
<span class="valid" style="font-size:22px; margin-left: 16px;"><?php echo $this->session->flashdata('success'); ?></span>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Banner details</h3>

        </div>
        <div class="box-body">
           
            <table id="bannerTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info" width="100%">
                <thead>
                <tr>
                    <th aria-controls="example2" rowspan="1" colspan="1">No. </th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Banner Image </th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Banner Name</th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Status</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>

        </div>

    </div>
</section>
<span class="required"><?php echo $this->session->flashdata('error'); ?></span>




<script>
    var datatable_url = '<?php echo base_url(); ?>admin/banner';
    var edit_url = '<?php echo base_url(); ?>admin/banner/edit/';
    var image_url ='<?php echo base_url(); ?>public/assets/images/uploads/banner/';
</script>
