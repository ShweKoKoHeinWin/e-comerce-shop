<div class="container">
    <h1 class="text-center text-secondary">Edit Account Form</h1>
    <form action="userController.php?edit" method="post" class="form text-secondary border bg-light my-4 p-4" enctype="multipart/form-data">

        <div class="form-group mb-3">
            <label class="h4" for="name">Name : </label>
            <input type="text" name="user_name" id="name" class="form-control" placeholder="Enter Name" value="<?php if (isset($user_cur_name)) {
                                                                                                                    echo $user_cur_name;
                                                                                                                } ?>" required>
        </div>

        <div class="form-group mb-3">
            <label class="h4" for="email">Email</label>
            <input type="email" name="user_email" id="email" class="form-control" placeholder="Enter Your Email" value="<?php if (isset($current_acc_email)) {
                                                                                                                            echo $current_acc_email;
                                                                                                                        } ?>" required>
        </div>
        <div class="form-group mb-3">
            <label class="h4" for="img">Image</label>
            <input type="file" name="user_img" id="img" class="form-control">
            <img style="width: 200px;height:200px;border: 3px solid #49a;margin: 1rem 2rem;" src="user_area/user_imgs/<?php if (isset($current_acc_email)) {
                                                                                                                            echo $current_acc_img;
                                                                                                                        } ?>" alt="<?php if (!empty($current_acc_img)) {
                                                                                                                                        echo "Current User Image";
                                                                                                                                    } else {
                                                                                                                                        echo "No image currently.";
                                                                                                                                    } ?>">
        </div>
        <div class="form-group mb-3">
            <label class="h4" for="password">New Password</label>
            <input type="password" name="user_password" id="password" class="form-control" placeholder="Enter New Password">
        </div>
        <div class="form-group mb-3">
            <label class="h4" for="passwordComfirm">New Comfirm Password</label>
            <input type="password" name="user_cofpassword" id="passwordComfirm" class="form-control" placeholder="Comfirm New Password">
        </div>
        <div class="form-group mb-3">
            <label class="h4" for="phone">Phone</label>
            <input type="number" name="user_phone" id="phone" class="form-control" placeholder="1232343" value="<?php if (isset($current_acc_phone)) {
                                                                                                                    echo $current_acc_phone;
                                                                                                                } ?>" required>
        </div>
        <div class="form-group mb-3">
            <label class="h4" for="address">Address</label>
            <textarea name="user_address" class="form-control" id="address" cols="30" rows="2" required>
                <?php if (isset($current_acc_address)) {
                    echo $current_acc_address;
                } ?>
                                                                                                                </textarea>
        </div>

        <div class="form-group mb-3">
            <label class="h4" for="curpassword">Current Password</label>
            <input type="password" name="user_cur_password" id="curpassword" class="form-control" placeholder="Enter Current Password" required>
        </div>

        <div class="d-flex justify-content-center">
            <input class="btn btn-primary" type="submit" name="edited" value="Edit Account">
        </div>
    </form>
</div>
<script>
    <?php include_once "templates/templateFunctions.php";
    removeSearch();
    displayTitle('Edit Profile'); ?>
</script>