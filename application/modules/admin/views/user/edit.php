<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/form.css">

</head>
<body>

<h2>User Info</h2>

<form action="/action_page.php" style="border:1px solid #ccc">
    <div class="container">
        <label class="col-md-2"><b>First Name</b></label>
        <input type="text" placeholder="Enter First Name" name="firstname" required><br>

        <label class="col-md-2"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last Name" name="lastname" required><br>

        <label class="col-md-2"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required><br>

        <label class="col-md-2"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required><br>

        <label class="col-md-2"><b>Confirm Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required><br>

        
        <div class="clearfix">
            <button type="button" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn">Sign Up</button>
        </div>
    </div>
</form>

</body>
</html>