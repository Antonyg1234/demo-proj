<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/form.css">

</head>
<body>

<h2>User Info</h2>

<?php echo form_open('admin/user/add'); ?>
    <div class="container">
        <label class="col-md-2"><b>First Name</b><span class="required">  *</span></label>
        <span class="required"> <?php echo form_error('firstname'); ?></span>
        <input type="text" placeholder="Enter First Name" name="firstname" ><br>


        <label class="col-md-2"><b>Last Name</b><span class="required">  *</span></label>
        <span class="required"> <?php echo form_error('lastname'); ?></span>
        <input type="text" placeholder="Enter Last Name" name="lastname" ><br>

        <label class="col-md-2"><b>Email</b><span class="required">  *</span></label>
        <span class="required"> <?php echo form_error('email'); ?></span>
        <input type="text" placeholder="Enter Email" name="email" ><br>

        <label class="col-md-2"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" ><br>

        <label class="col-md-2"><b>Confirm Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" ><br>


        <div class="clearfix">
            <button type="button" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn">Sign Up</button>
        </div>
    </div>
</form>

</body>
</html>