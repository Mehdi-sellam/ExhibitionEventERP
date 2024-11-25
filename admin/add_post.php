<?php
include 'partials/header.php';

//get the categories from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

// get back form data in case of error
$title = $_SESSION['add-post-data']['title'] ?? NULL;
$body = $_SESSION['add-post-data']['body'] ?? NULL;
$eventdt = $_SESSION['add-post-data']['eventdt'] ?? NULL;

unset($_SESSION['add-post-data']);

?>





<section class="section_form">
    <div class="container form_sect-container">
        <h2>Add Post</h2>

        <?php if (isset($_SESSION['add-post'])) : ?>
            <div class="message_popup error">
                <p>
                    <?= $_SESSION['add-post'];
                    unset($_SESSION['add-post']);
                    ?>
                </p>
            </div>
        <?php endif ?>

        <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea rows="10" name="body" placeholder="Body"><?= $body ?></textarea>
            <!-- Add date and time event -->
            <input type="datetime-local" name="eventdt" value="<?= $eventdt ?>" placeholder="Event Date">
            
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <div class="form_con inline">
                    <input type="checkbox" name="is_featured" value="1" id="is_event" checked>
                    <label for="is _event">Event</label>
                </div>
            <?php endif ?>
            <div class="form_con">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="button">Add Post</button>
        </form>
    </div>
</section>

<!-- ===================== END OF FORM ========================= -->

<?php
include '../partials/footer.php';
?>