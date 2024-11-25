<?php
include 'partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $catergory = mysqli_fetch_assoc($result);
    }
} else {
    header('location: ' . ROOT_URL . 'admin/manage_category.php');
    die();
}

?>

<section class="section_form">
    <div class="container form_sect-container">
        <h2>Edit Category</h2>
        <form action="<?= ROOT_URL ?>admin/edit-category-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $catergory['id'] ?>">
            <input type="text" name="title" value="<?= $catergory['title'] ?>" placeholder="Title">
            <textarea rows="4" name="description" placeholder="Description"><?= $catergory['description'] ?></textarea>
            <button type="submit" name="submit" class="button">Update Category</button>
        </form>
    </div>
</section>

<!-- ===================== END OF FORM ========================= -->

<?php
include '../partials/footer.php';
?>