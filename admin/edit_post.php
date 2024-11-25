<?php
include 'partials/header.php';

//get the category from database
$category_query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $category_query);

//get data from database
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM post WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/');
    die();
}

?>

<section class="section_form">
    <div class="container form_sect-container">
        <h2>Edit Post</h2>
        <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <input type="text" name="title" value="<?= $post['title'] ?>" placeholder="Title">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea rows="10" name="body" placeholder="Body"><?= $post['body'] ?></textarea>
            <input type="datetime-local" name="eventdt" value="<?= $post['eventdt'] ?>" placeholder="Event Date">
            <div class="form_con inline">
                <input type="checkbox" name="is_featured" id="is_event" value="1" checked>
                <label for="is _event">Event</label>
            </div>
            <div class="form_con">
                <label for="thumbnail">Update Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="button">Update Post</button>
        </form>
    </div>
</section>

<!-- ===================== END OF FORM ========================= -->

<?php
include '../partials/footer.php';
?>