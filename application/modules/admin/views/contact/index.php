<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">Message page</h1>
        
    </div>
</section>

<span class="valid" style="font-size:22px; margin-left: 16px;"><?php echo $this->session->flashdata('success'); ?></span>
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Message details</h3>
            
        </div>
        <div class="box-body">
            
            <table id="contactTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info" width="100%">
                <thead>
                <tr>
                    <th aria-controls="example2" rowspan="1" colspan="1">No. </th> 
                    <th aria-controls="example2" rowspan="1" colspan="1">Name </th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Email</th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Contact No</th>
                    <th>Action</th>
                </tr>
                </thead>
                
            </table>

            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Message</h4>
                        </div>
                        <div class="modal-body">
                          <p id="message">Some text in the modal.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                  </div>
                  
                </div>
            </div>
            

        </div>
        <!-- /.box -->
    </div>
</section>
<!-- /.content -->



<script>
    var datatable_url = '<?php echo base_url(); ?>admin/contact';
    var view_url = '<?php echo base_url(); ?>admin/contact/view/';
    var reply_url = '<?php echo base_url(); ?>admin/contact/reply/';
</script>
