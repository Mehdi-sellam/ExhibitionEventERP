<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //get user from database
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    //number of users returns
    if (mysqli_num_rows($result) == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../image/' . $avatar_name;

        //delite avatart image
        if ($avatar_path) {
            unlink($avatar_path);
        }
    }

    //delite post thumbnails
    $thumbnails_query = "SELECT thumbnail FROM post WHERE author_id = $id";
    $thumbnails_result = mysqli_query($connection, $thumbnails_query);
    if (mysqli_num_rows($thumbnails_result) > 0) {
        while ($thumbnail = mysqli_fetch_assoc($thumbnails_result)) {
            $thumbnail_path = '../image/' . $thumbnail['thumbnail'];
            //delete thumbnail
            if ($thumbnail_path) {
                unlink($thumbnail_path);
            }
        }
    }

    //delite user
    $delete_user_query =  "DELETE FROM users WHERE id = $id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);
    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "Not able to delete user: {$user['username']}";
    } else {
        $_SESSION['delete-user-success'] = "User {$user['username']} removed from the system succesfully!";
    }
}

header('location: ' . ROOT_URL . 'admin/manage_user.php');
die();
