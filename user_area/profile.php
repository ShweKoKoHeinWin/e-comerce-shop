
        <?php

        if (isset($_SESSION['userid']) && isset($_SESSION['username'])) {
            echo "<div class='card bg-warning p-2'>
            <img src='user_area/user_imgs/$user_img' class='card-img-top' alt='...'>
            <hr>
            <div class='card-body'>
                <h5 class='card-title'>$user_name</h5>
                <p class='card-text'>email : $user_email</p>
                <p class='card-text'>phone : $user_phone</p>
                <p class='card-text'>Address : $user_address</p>
                <div class='d-flex flex-column'>
                    <a href='profileController.php?orders' class='btn btn-primary mb-2'>Your Orders</a>
                    <a href='userController.php?edit' class='btn btn-info mb-2'>Edit Profile</a>
                    <a href='userController.php?delete' class='btn btn-danger mb-2'>Delete Account</a>
                    <a href='user_area/logout.php' class='btn btn-secondary'>Logout</a>
                </div>
            </div>
        </div>";
        } else {
            echo "<div class='card bg-warning p-2'>
            <img src='user_area/user_imgs/$user_img' class='card-img-top' alt='...'>
            <hr>
            <div class='card-body'>
                <h5 class='card-title'>$user_name</h5>
                <div class='d-flex flex-column'>
                    <a href='userController.php?login=1' class='btn btn-secondary'>Login</a>
                </div>
            </div>
        </div>";
        }

        ?>
