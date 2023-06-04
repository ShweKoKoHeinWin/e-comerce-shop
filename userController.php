<?php
include_once 'templates/header.php';



if (isset($_GET['register'])) {
    if (isset($_POST['user_register']) && $_POST['user_register'] == "Register") {
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $user_cofpassword = $_POST['user_cofpassword'];
        $user_phone = $_POST['user_phone'];
        $user_address = $_POST['user_address'];

        $user_img = $_FILES['user_img']['name'];
        $user_img_temp = $_FILES['user_img']['tmp_name'];
        if ($user_password === $user_cofpassword) {
            $user_password = password_hash($user_password, PASSWORD_BCRYPT);
            $check_user_qry = "SELECT * FROM user_info WHERE user_email='$user_email' OR user_name='$user_name'";
            $check_user_result = mysqli_query($connect, $check_user_qry);

            if (mysqli_num_rows($check_user_result) == 0) {
                if (empty($user_img)) {
                    $user_img = 'default.jpg';
                } else {
                    move_uploaded_file($user_img_temp, "./user_area/user_imgs/" . $user_img);
                }


                $user_ip = Query::getIPAddress();

                $user_insert_qry = "INSERT INTO user_info(user_name, user_email, user_password, user_img, user_ip, user_address, user_phone) VALUES ('$user_name', '$user_email', '$user_password', '$user_img', '$user_ip', '$user_address', '$user_phone')";

                if ($insert_execute = mysqli_query($connect, $user_insert_qry)) {
                    $_SESSION['userid'] = mysqli_insert_id($connect);
                    $_SESSION['username'] = $user_name;
                    echo "<script>alert('Registered Successfully');</script>";
                    echo "<script>window.open('profileController.php?orders', '_self')</script>";
                } else {
                    echo "<script>alert('Something went wrong');</script>";
                }
            } else {
                echo "<script>alert('User with this name or email is already existed')</script>";
            }
        } else {
            echo "<script>alert('Password and Comfirm Password must be same.');</script>";
        }
    }

    include_once('user_area/register.php');
} else if (isset($_GET['login'])) {
    include_once 'user_area/login.php';

    if (isset($_POST['user_login']) && $_POST['user_login'] == "Login") {
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        $check_email_qry = "SELECT * FROM user_info WHERE user_email='$user_email'";
        $check_email_result = mysqli_query($connect, $check_email_qry);
        if (mysqli_num_rows($check_email_result) > 0) {
            $check_email_data = mysqli_fetch_assoc($check_email_result);
            if (password_verify($user_password, $check_email_data['user_password'])) {
                $_SESSION['userid'] = $check_email_data['user_id'];
                $_SESSION['username'] = $check_email_data['user_name'];

                echo "<script>alert('Login Successfully')</script>";
                echo "<script>window.open('profileController.php?orders', '_self')</script>";
            } else {
                echo "<script>alert('Invalid Password');</script>";
            }
        } else {
            echo "<script>alert('Invalid Email')</script>";
        }
    }
} else if (isset($_GET['edit'])) {
    if (isset($_SESSION['userid']) && isset($_SESSION['username'])) {
        $user_id = $_SESSION['userid'];
        $user_cur_name = $_SESSION['username'];
        $user_ip = Query::getIPAddress();
        $current_acc_query = "SELECT * FROM user_info WHERE user_id='$user_id' AND user_name='$user_cur_name' AND user_ip='$user_ip'";
        $current_acc_result = mysqli_query($connect, $current_acc_query);
        $current_acc = mysqli_fetch_assoc($current_acc_result);
        $current_acc_email = $current_acc['user_email'];
        $current_acc_phone = $current_acc['user_phone'];
        $current_acc_img = $current_acc['user_img'];
        $current_acc_address = $current_acc['user_address'];
        $current_acc_password = $current_acc['user_password'];

        include_once "user_area/edit.php";

        if (isset($_POST['edited'])) {
            $user_name = $_POST['user_name'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            $user_cofpassword = $_POST['user_cofpassword'];
            $user_phone = $_POST['user_phone'];
            $user_address = $_POST['user_address'];
            $user_cur_password = $_POST['user_cur_password'];
            if ($user_password === $user_cofpassword) {

                $check_email_query = "SELECT * FROM user_info WHERE user_email='$user_email' AND user_id<>'$user_id'";
                $check_email_result = mysqli_query($connect, $check_email_query);
                if (mysqli_num_rows($check_email_result) > 0) {
                    echo "<script>alert('There is User with this email address.')</script>";
                } else {

                    $user_img = $_FILES['user_img']['name'];
                    $user_img_temp = $_FILES['user_img']['tmp_name'];
                    if (password_verify($user_cur_password, $current_acc_password)) {
                        $_SESSION['userid'] = $user_id;
                        $_SESSION['username'] = $user_name;

                        if (empty($user_img)) {
                            $user_img = $current_acc_img;
                        }
                        move_uploaded_file($user_img_temp, "./user_area/user_imgs/" . $user_img);
                        if (empty($user_password)) {
                            $edit_acc_query = "UPDATE user_info SET user_name='$user_name', user_email='$user_email', user_img='$user_img', user_phone='$user_phone', user_address='$user_address' WHERE user_id='$user_id'";
                        } else {
                            $user_password = password_hash($user_password, PASSWORD_BCRYPT);
                            $edit_acc_query = "UPDATE user_info SET user_name='$user_name', user_email='$user_email', user_password='$user_password', user_img='$user_img', user_phone='$user_phone', user_address='$user_address' WHERE user_id='$user_id'";
                        }
                        $edit_acc_result = mysqli_query($connect, $edit_acc_query);


                        echo "alert('Account Edited Successfully')";
                        echo "<script>window.open('profileController.php?orders', '_self')</script>";
                    } else {
                        echo "<script>alert('Invalid Password');</script>";
                    }
                }
            } else {
                echo "<script>alert('Enter New Password and New Comfirm Password Must same');</script>";
                echo "<script>window.open('userController.php?edit', '_self')</script>";
            }
        }
    } else {
        header('Location:profileController?orders.php');
    }
} else if (isset($_GET['delete'])) {
    if (isset($_SESSION['userid']) && isset($_SESSION['username'])) {
        $user_id = $_SESSION['userid'];
        $user_cur_name = $_SESSION['username'];
        $user_ip = Query::getIPAddress();
        $user_delete_query = "DELETE FROM user_info WHERE user_id='$user_id' AND user_name='$user_cur_name' AND user_ip='$user_ip'";
        if ($user_delete_result = mysqli_query($connect, $user_delete_query)) {

            $order_delete_query = "DELETE FROM orders WHERE user_id='$user_id' AND order_status<>'pending'";
            $order_delete_result = mysqli_query($connect, $order_delete_query);

            $cart_delete_query = "DELETE FROM cart_details WHERE ip_address='$user_ip'";
            $cart_delete_result = mysqli_query($connect, $cart_delete_query);

            echo "<script>alert('User Account Deleted.');</script>";
            echo "<script>window.open('user_area/logout.php', '_self')</script>";
        }
    } else {
        header('Location:/');
    }
}

include_once 'templates/footer.php';
