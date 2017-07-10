<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">Order page</h1>
        
    </div>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Message details</h3>
            
        </div>
        <div class="box-body">
            
            <table id="orderTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info" width="100%">
                <thead>
                <tr>
                    <th aria-controls="example2" rowspan="1" colspan="1">No. </th> 
                    <th aria-controls="example2" rowspan="1" colspan="1">OrderId </th> 
                    <th aria-controls="example2" rowspan="1" colspan="1">Name </th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Email</th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Contact No</th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Address</th>
                    <th>Product Detail</th>
                </tr>
                </thead>
                
            </table>

        </div>
        
    </div>
</section>
<!-- /.content -->




<script>
    var datatable_url = '<?php echo base_url(); ?>admin/order';
    var view_url = '<?php echo base_url(); ?>admin/order/order_detail/';
</script>
