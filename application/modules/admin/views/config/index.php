<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">Configuration page</h1>
        <div class="pull-right">
            <a href="<?php echo base_url();?>admin/config/add" class="btn btn-primary">Add Configuration</a>
        </div>
    </div>
</section>
<span class="valid" style="font-size:22px; margin-left: 16px;"><?php echo $this->session->flashdata('success'); ?></span>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Configuration details</h3>

        </div>
        <div class="box-body">
            <span class="success">
           <?php
           if (isset($this->session))
           {
               echo $this->session->flashdata('success');
           }
           ?>
           </span>
            <table id="configTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info" width="100%">
                <thead>
                <tr>
                    <th aria-controls="example2" rowspan="1" colspan="1">No. </th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Configuration Key</th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Configuration Value</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </div>
</section>
<!-- /.content -->




<script>
    var datatable_url = '<?php echo base_url(); ?>admin/config';
    var edit_url = '<?php echo base_url(); ?>admin/config/edit/';
</script>
