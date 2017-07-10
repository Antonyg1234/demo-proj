<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">CMS page</h1>
        <div class="pull-right">
            <a href="<?php echo base_url();?>admin/cms/add" class="btn btn-primary">Add Cms</a>
        </div>
    </div>
</section>
<span class="valid" style="font-size:22px; margin-left: 16px;"><?php echo $this->session->flashdata('success'); ?></span>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Category details</h3>
            
        </div>
        <div class="box-body">
            
            <table id="cmsTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info" width="100%">
                <thead>
                <tr>
                    <th aria-controls="example2" rowspan="1" colspan="1">No. </th> 
                    <th aria-controls="example2" rowspan="1" colspan="1">Title </th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Content </th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Meta Title </th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Meta Description </th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Meta Keyword </th>
                    <th>Action</th>
                </tr>
                </thead>
                
            </table>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </div>
</section>
<!-- /.content -->




<script>
    var datatable_url = '<?php echo base_url(); ?>admin/cms';
    var edit_url = '<?php echo base_url(); ?>admin/cms/edit/';
</script>
