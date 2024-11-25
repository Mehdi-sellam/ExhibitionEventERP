<?php

require 'config/database.php';

if (isset($_POST['submit'])) {
    //get data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$username_email) {
        $_SESSION['login'] = "Enter Username or Email";
    } elseif (!$password) {
        $_SESSION['login'] = "Enter your password";
    } else {
        //take user from database
        $get_user_data = "SELECT * FROM users WHERE username= '$username_email' OR email= '$username_email'";

        $get_user_result = mysqli_query($connection, $get_user_data);

        if (mysqli_num_rows($get_user_result) == 1) {
            $user_data = mysqli_fetch_assoc($get_user_result);
            $db_password = $user_data['password'];
            //check password
            if (password_verify($password, $db_password)) {
                //set action controll
                $_SESSION['user_id'] = $user_data['id'];
                //check if is admin
                if ($user_data['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }
                //log user in
                header('location: ' . ROOT_URL . 'admin./');
            } else {
                $_SESSION['login'] = "Please check your input";
            }
        } else {
            $_SESSION['login'] = "User not difined!";
        }
    }
    //redirect in case of issue

    if (isset($_SESSION['login'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'login.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'login.php');
    die();
}
