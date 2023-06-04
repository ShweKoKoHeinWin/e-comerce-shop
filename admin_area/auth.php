<?php include('../includes/connect.php');
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Cdn css -->
    <?php require "../css/stylelinks.html" ?>

    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <div class="container py-5">
        <form action="" method="post" class="p-4">
            <?php
            if (isset($_GET['logout'])) {
                session_destroy();

                header('Location:auth.php?login');
            } else if (isset($_GET['register'])) { ?>
                <?php
                if (isset($_POST['admin_register'])) {
                    $name = $_POST['admin_name'];
                    $email = $_POST['admin_email'];
                    $password = $_POST['admin_password'];
                    $comfirm_password = $_POST['admin_comfpassword'];

                    if ($password == $comfirm_password) {
                        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                        $admin_insert_qry = "INSERT INTO admins (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
                        if (mysqli_query($connect, $admin_insert_qry)) {
                            $id = mysqli_insert_id($connect);
                            $_SESSION['adminid'] = $id;
                            $_SESSION['adminname'] = $name;
                            echo "<script>alert('Admin Data Added Successfully!')</script>";
                            echo "<script>window.open('index.php', '_self');</script>";
                        } else {
                            echo "<script>alert('Something went wrong!')</script>";
                            echo "<script>window.open('auth.php?register', '_self');</script>";
                        }
                    } else {
                        echo "<script>alert('Password and Comfirm Password must be same!')</script>";
                        echo "<script>window.open('auth.php?register', '_self');</script>";
                    }
                }
                ?>
                <h2 class="text-center">Admin Register</h2>
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="admin_name" id="name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label class="h4" for="email">Email</label>
                    <input type="email" name="admin_email" id="email" class="form-control" placeholder="Enter Your Email" required>
                </div>

                <div class="form-group mb-3">
                    <label class="h4" for="password">Password</label>
                    <input type="password" name="admin_password" id="password" class="form-control" placeholder="Enter Password" required>
                </div>

                <div class="form-group mb-3">
                    <label class="h4" for="comfpassword">Comfirm Password</label>
                    <input type="password" name="admin_comfpassword" id="comfpassword" class="form-control" placeholder="Enter Comfirm Password" required>
                </div>

                <div class="d-flex justify-content-center">
                    <input class="btn btn-primary" type="submit" name="admin_register" value="Register">
                </div>
            <?php  } else if (isset($_GET['login'])) { ?>
                <?php if (isset($_POST['admin_login'])) {
                    $admin_email = $_POST['email'];
                    $admin_password = $_POST['password'];
                    $admin_qry = "SELECT * FROM admins WHERE email='$admin_email'";
                    $admin_result = mysqli_query($connect, $admin_qry);
                    if ($admin = mysqli_fetch_assoc($admin_result)) {
                        if (password_verify($admin_password, $admin['password'])) {
                            $_SESSION['adminid'] = $admin['id'];
                            $_SESSION['adminname'] = $admin['name'];

                            echo "<script>alert('Login Successfully')</script>";
                            echo "<script>window.open('index.php', '_self');</script>";
                        }
                    } else {
                        echo "<script>alert('Admin with this email not exist!')</script>";
                    }
                }


                ?>
                <h2 class="text-center">Admin Login</h2>
                <div class="form-group mb-3">
                    <label class="h4" for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email" required>
                </div>

                <div class="form-group mb-3">
                    <label class="h4" for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
                </div>

                <div class="d-flex justify-content-center">

                    <input class="btn btn-primary" type="submit" name="admin_login" value="Login">
                </div>
                <a href="auth.php?register" class="btn btn-secondary text-center">Not a admin? Click here to become an admin</a>
            <?php } else if (isset($_GET['edit']) && !empty($_GET['edit'])) { ?>
                <?php
                $edit_id = $_GET['edit'];
                $edit_name = $_SESSION['adminname'];
                $profile_data_query = "SELECT * FROM admins WHERE id='$edit_id' AND name='$edit_name'";
                $profile_data_result = mysqli_query($connect, $profile_data_query);
                $profile_data = mysqli_fetch_assoc($profile_data_result);

                if (isset($_POST['edit_profile'])) {
                    $updated_name = $_POST['edit_name'];
                    $updated_email = $_POST['edit_email'];
                    $updated_password = $_POST['edit_password'];
                    if (password_verify($updated_password, $profile_data['password'])) {
                        $updated_qry = "UPDATE admins SET name='$updated_name', email='$updated_email' WHERE id='$edit_id'";
                        if (mysqli_query($connect, $updated_qry)) {
                            $_SESSION['adminname'] = $updated_name;
                            echo "<script>alert('Update Profile Successfully')</script>";
                            echo "<script>window.open('index.php?profile', '_self');</script>";
                        } else {
                            echo "<script>alert('Something went wrong!')</script>";
                            echo "<script>window.open('index.php?profile', '_self');</script>";
                        }
                    } else {
                        echo "<script>alert('Wrong Password')</script>";
                    }
                }

                ?>
                <h2 class="text-center">Admin Profile Edit</h2>
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="edit_name" value="<?= $profile_data['name']; ?>" id="name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label class="h4" for="email">Email</label>
                    <input type="email" name="edit_email" value="<?= $profile_data['email']; ?>" id="email" class="form-control" placeholder="Enter Your Email" required>
                </div>

                <div class="form-group mb-3">
                    <label class="h4" for="password">Password</label>
                    <input type="password" name="edit_password" id="password" class="form-control" placeholder="Enter Password" required>
                </div>
                <div class="d-flex justify-content-center">

                    <input class="btn btn-primary" type="submit" name="edit_profile" value="Update">
                </div>

            <?php } else if (isset($_GET['delete']) && !empty($_GET['delete'])) {
                $id = $_GET['delete'];
                $delete_qry = "DELETE FROM admins WHERE id = $id";
                if (mysqli_query($connect, $delete_qry)) {
                    session_destroy();
                    echo "<script>window.open('index.php?profile', '_self');</script>";
                }
            } ?>
        </form>
    </div>
    <!-- cdn js -->
    <?php require "../js/scriptlinks.html" ?>
    <script>
        <?php include_once "../templates/templateFunctions.php";
        if (isset($_GET['register'])) {
            displayTitle('Admin Register');
        } else if (isset($_GET['login'])) {
            displayTitle('Admin Login');
        }

        ?>
    </script>
</body>

</html>