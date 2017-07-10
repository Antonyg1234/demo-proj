<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">Customer Registered Report</h1>
        <div class="pull-right">
            <a href="<?php echo base_url();?>admin/coupon/add" class="btn btn-primary">Download Report</a>
        </div>
    </div>
</section>
<span class="valid" style="font-size:22px; margin-left: 16px;"><?php echo $this->session->flashdata('success'); ?></span>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Coupon Used details</h3>
            
        </div>
        <div class="box-body">
            
            <table id="couponTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info" width="100%">
                <thead>
                <tr>
                    <th aria-controls="example2" rowspan="1" colspan="1">No. </th> 
                    <th aria-controls="example2" rowspan="1" colspan="1">Used Date </th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Coupon </th>
                    <th aria-controls="example2" rowspan="1" colspan="1">OrderID</th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Name</th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Email</th>
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
    var datatable_url = '<?php echo base_url(); ?>admin/reports/coupons_used';
   // var edit_url = '<?php echo base_url(); ?>admin/coupon/edit/';
</script>
