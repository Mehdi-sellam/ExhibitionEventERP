<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //get updated data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firsname = filter_var($_POST['firsname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_SPECIAL_CHARS);

    // check valid input

    if (!$firsname || !$lastname) {
        $_SESSION['edit-user'] = "Invalid Form Input";
    } else {
        //updated user new data
        $query = "UPDATE users SET firsname = '$firsname', lastname = '$lastname', is_admin = $is_admin WHERE id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Fail to updated user data";
        } else {
            $_SESSION['edit-user-success'] = "Updated complitted succesfully!";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage_user.php');
die();
