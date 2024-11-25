<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);


    //assigni categoty id to this post to uncategorized category
    $update_query = "UPDATE post SET category_id = 9 WHERE category_id = $id";
    $update_result = mysqli_query($connection, $update_query);

    if (!mysqli_errno($connection)) {
        //delite category
        $query = "DELETE FROM categories WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
        $_SESSION['delete-categorie-success'] = "Category deleted successfully";
    }
}
header('location: ' . ROOT_URL . 'admin/manage_category.php');
die();
