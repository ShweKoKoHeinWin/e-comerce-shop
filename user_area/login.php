<?php Query::redirectHomeBySession(1); ?>

<div class="container text-secondary">
    <h2 class="h2 text-center">Login Form</h2>
    <form action="userController.php?login=1" method="post" class="bg-light border p-4 my-5">
        <div class="form-group mb-3">
            <label class="h4" for="email">Email</label>
            <input type="email" name="user_email" id="email" class="form-control" placeholder="Enter Your Email" required>
        </div>

        <div class="form-group mb-3">
            <label class="h4" for="password">Password</label>
            <input type="password" name="user_password" id="password" class="form-control" placeholder="Enter Password" required>
        </div>

        <div class="d-flex justify-content-center">

            <input class="btn btn-primary" type="submit" name="user_login" value="Login">
        </div>

        <div class="form-group mb-3 text-center">
            <span class="text-muted">Forgot Password?</span> <a href="">Reset Password</a> <br>
            <span class="text-muted">Haven't register? Click here to <a href="userController.php?register=1">Register</a></span>
            <span class="text-muted">Are You an Admin? <a href="admin_area/auth.php?login">Login as Admin</a></span>
        </div>
    </form>
</div>
<script>
    <?php include_once "templates/templateFunctions.php";
    removeSearch();
    displayTitle('Login'); ?>
</script>