<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">User page</h1>
        <div class="pull-right">
            <a href="<?php echo base_url();?>admin/user/add" class="btn btn-primary">Add User</a>
        </div>
    </div>
</section>
<span class="valid" style="font-size:22px; margin-left: 16px;"><?php echo $this->session->flashdata('success'); ?></span>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">User details</h3>
            
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
            <table id="myTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info" width="100%">
                <thead>
                <tr>
                    <th aria-controls="example2" rowspan="1" colspan="1">No. </th> 
                    <th aria-controls="example2" rowspan="1" colspan="1">First Name </th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Last Name</th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Email</th>
                    <th aria-controls="example2" rowspan="1" colspan="1">Role </th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // $list = json_decode($json);
                /*foreach ($list as $row)
                {
                    */?><!--
                    <tr>
                        <td><?php /*echo $row->firstname; */?></td>
                        <td><?php /*echo $row->lastname; */?></td>
                        <td><?php /*echo $row->email; */?></td>
                        <td><?php /*echo $row->role_name; */?></td>
                        <td>
                            <div class="buttons">
                                <a class="fa fa-trash" onclick="deleteFunction(<?php /*echo $row->id; */?>)"></a>
                                <a class="fa fa-edit" href="<?php /*echo base_url('admin/user/edit/'.$row->id); */?>"></a>
                            </div>

                        </td>

                    </tr>
                    --><?php
/*                }*/
                ?>

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
    var datatable_url = '<?php echo base_url(); ?>admin/user';
    var edit_url = '<?php echo base_url(); ?>admin/user/edit/';
    //var no=0;
</script>
