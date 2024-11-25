<?php
session_start();
require 'config/database.php';

//go to register form data if submit button was cliked

if (isset($_POST['submit'])) {
    $firsname = filter_var($_POST['firsname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $creatpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];

    //Validation check
    if (!$firsname) {
        $_SESSION['add_user'] = "Please enter your First Name";
    } elseif (!$lastname) {
        $_SESSION['add_user'] = "Please enter your Last Name";
    } elseif (!$username) {
        $_SESSION['add_user'] = "Please enter your Username";
    } elseif (!$email) {
        $_SESSION['add_user'] = "Please enter a valid email";
    } elseif (strlen($creatpassword) < 6 || strlen($confirmpassword) < 6) {
        $_SESSION['add_user'] = "Password should be 6+ characters";
    } elseif (!$avatar['name']) {
        $_SESSION['add_user'] = "Please add your Avatar!";
    } else {
        //comparing password
        if ($creatpassword !== $confirmpassword) {
            $_SESSION['add_user'] = "Password not match, try again!";
        } else {
            $hashed_password = password_hash($creatpassword, PASSWORD_DEFAULT);

            //chek if username or email already in use

            $user_check_q = "SELECT * FROM users WHERE username='$username' OR email= '$email'";



            $user_check_r = mysqli_query($connection, $user_check_q);
            if (mysqli_num_rows($user_check_r) > 0) {
                $_SESSION['add_user'] = "User or Email already exist";
            } else {
                //Avatar
                //rename avatar
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../image/' . $avatar_name;

                //Is a file
                $allowed_file = ['png', 'jpg', 'jpeg', 'webp'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if (in_array($extention, $allowed_file)) {
                    //check size (1mb+)
                    if ($avatar['size'] < 1000000) {
                        //upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['add_user'] = "Reduce the file size";
                    }
                } else {
                    $_SESSION['add_user'] = "File extention not valid, use: png, jpg, jpeg or webp";
                }
            }
        }
    }

    //move back to register page in case of problem
    if (isset($_SESSION['add_user'])) {
        // pass form data back to regidtration page
        $_SESSION['add-user-data'] = $_POST;
        header('location: ' . ROOT_URL . '/admin/add_user.php');
        die();
    } else {
        //insert new user into data table
        $insert_user_query = "INSERT INTO users SET firsname = '$firsname', lastname = '$lastname', username = '$username', email = '$email', password = '$hashed_password', avatar = '$avatar_name', is_admin = '$is_admin'";

        $insert_user_query = mysqli_query($connection, $insert_user_query);


        if (!mysqli_errno($connection)) {

            //redirect to login page
            $_SESSION['add-user-success'] = "New User $username added!";
            header('location: ' . ROOT_URL . '/admin/manage_user.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add_user.php');
    die();
}
