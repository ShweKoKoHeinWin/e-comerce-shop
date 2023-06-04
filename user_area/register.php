<div class="container">
    <h1 class="text-center text-secondary">Register Form</h1>
    <form action="" method="post" class="form text-secondary border bg-light my-4 p-4" enctype="multipart/form-data">

        <div class="form-group mb-3">
            <label class="h4" for="name">Name : </label>
            <input type="text" name="user_name" id="name" class="form-control" placeholder="Enter Name" value="<?php if (isset($user_name)) {
                                                                                                                    echo $user_name;
                                                                                                                } ?>" required>
        </div>

        <div class="form-group mb-3">
            <label class="h4" for="email">Email</label>
            <input type="email" name="user_email" id="email" class="form-control" placeholder="Enter Your Email" value="<?php if (isset($user_email)) {
                                                                                                                            echo $user_email;
                                                                                                                        } ?>" required>
        </div>
        <div class="form-group mb-3">
            <label class="h4" for="img">Image</label>
            <input type="file" name="user_img" id="img" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label class="h4" for="password">Password</label>
            <input type="password" name="user_password" id="password" class="form-control" placeholder="Enter Password" value="<?php if (isset($user_password)) {
                                                                                                                                    echo $user_password;
                                                                                                                                } ?>" required>
        </div>
        <div class="form-group mb-3">
            <label class="h4" for="passwordComfirm">Comfirm Password</label>
            <input type="password" name="user_cofpassword" id="passwordComfirm" class="form-control" placeholder="Comfirm Password" value="<?php if (isset($user_cofpassword)) {
                                                                                                                                                echo $user_cofpassword;
                                                                                                                                            } ?>" required>
        </div>
        <div class="form-group mb-3">
            <label class="h4" for="phone">Phone</label>
            <input type="number" name="user_phone" id="phone" class="form-control" placeholder="1232343" value="<?php if (isset($user_phone)) {
                                                                                                                    echo $user_phone;
                                                                                                                } ?>" required>
        </div>
        <div class="form-group mb-3">
            <label class="h4" for="address">Address</label>
            <textarea name="user_address" class="form-control" id="address" cols="30" rows="2" required>
                <?php if (isset($user_address)) {
                    echo $user_address;
                } ?>
                                                                                                                </textarea>
        </div>
        <div class="d-flex justify-content-center">
            <input class="btn btn-primary" type="submit" name="user_register" value="Register">
        </div>
    </form>
</div>
<script>
    <?php include_once "templates/templateFunctions.php";
    removeSearch();
    displayTitle('Register'); ?>
</script>