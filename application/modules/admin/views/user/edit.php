

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/form.css">

</head>
<body>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">User page</h1>

    </div>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit User</h3>
        </div>
        <div class="form-horizontal">
            <?php echo form_open('admin/user/edit/'.$id); ?>
            <div class="box-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">First Name<span class="required">  *</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control capitalize" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $edit_user->firstname;?>">
                        <span class="required"> <?php echo form_error('firstname'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Last Name<span class="required">  *</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control capitalize" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $edit_user->lastname;?>">
                        <span class="required"> <?php echo form_error('lastname'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email<span class="required">  *</span></label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $edit_user->email;?>">
                        <span class="required"> <?php echo form_error('email'); ?></span>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-md-2 control-label">Select Role<span class="required">  *</span></label>
                    <span class="required"> <?php echo form_error('role_select'); ?></span>
                    <div class="col-sm-6">
                        <select id="role_select" name="role_select" class="form-control">
                            <option value="<?php echo $edit_user->roles;?>"><?php echo $edit_user->role_name;?></option>
                           <?php foreach ($dropdown->result() as $row){ ?>
                            <option value="<?php echo $row->id;?>"><?php echo $row->role_name;?></option>
                           <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="clearfix" style="margin-left: 175px;">
                    <button style="width: 75px;display: inline" class="btn btn-block btn-danger" onclick="location.href='<?php echo base_url();?>admin/user'" type="button" class="cancelbtn">Cancel</button>
                    <button style="width: 75px;display: inline;margin-top: 10px;" type="submit" class="btn btn-block btn-success">Update</button>
                </div>
            </div>

            </form>
        </div>
    </div>
</section>
</body>
</html>