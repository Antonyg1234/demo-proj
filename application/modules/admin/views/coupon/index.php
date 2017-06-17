<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">Coupon page</h1>
        <div class="pull-right">
            <a href="<?php echo base_url();?>admin/coupon/add" class="btn btn-primary">Add Coupon</a>
        </div>
    </div>
</section>
<span class="valid" style="font-size:22px; margin-left: 16px;"><?php echo $this->session->flashdata('success'); ?></span>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Coupon details</h3>
            
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
            <table id="couponTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info" width="100%">
                <thead>
                <tr>
                    <th aria-controls="example2" rowspan="1" colspan="1">No. </th> 
                    <th aria-controls="example2" rowspan="1" colspan="1">Coupon Code </th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Percentage-Off</th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Quantity</th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Status</th>
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
    var datatable_url = '<?php echo base_url(); ?>admin/coupon';
    var edit_url = '<?php echo base_url(); ?>admin/coupon/edit/';
</script>
