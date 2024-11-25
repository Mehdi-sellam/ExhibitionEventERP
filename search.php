<?php
include 'partials/header.php';

if (isset($_GET['search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['search'], FILTER_SANITIZE_SPECIAL_CHARS);
    //$query = "SELECT * FROM post WHERE title LIKE '%$search%' ORDER BY date_time DESC";
    $query = "SELECT * FROM post WHERE title LIKE '%" . $search . "%' ORDER BY date_time DESC";

    $posts = mysqli_query($connection, $query);
    // Check for errors in the main posts query
    if (!$posts) {
        die("Query failed: " . mysqli_error($connection));
    }
} else {
    header('location: ' . ROOT_URL . 'devices.php');
    die();
}
?>

<!-- ===================== END OF HERO ========================= -->

<section class="post section1 section_extra-margin">
    <div class="container post_container">
        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                <div class="post_thumbail">
                    <img src="./image/<?= $post['thumbnail'] ?>">
                </div>
                <div class="post_info">
                    <?php
                    //get category from database
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id = $category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    // Check for errors in the category query
                    if (!$category_result) {
                        die("Category query failed: " . mysqli_error($connection));
                    }
                    $category = mysqli_fetch_assoc($category_result);
                    $category_title = $category['title'];
                    ?>

                    <a href="<?= ROOT_URL ?>category_post.php?id=<?= $post['category_id'] ?>" class="category_button"><?= $category_title ?></a>

                    <h3 class="post_title"><a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h3>
                    <p class="post_body"><?= substr($post['body'], 0, 150) ?>...</p>
                    <div class="post_autor">
                        <?php
                        //get post author
                        $author_id = $post['author_id'];
                        $author_query = "SELECT * FROM users WHERE id = $author_id";
                        $author_result = mysqli_query($connection, $author_query);
                        // Check for errors in the author query
                        if (!$author_result) {
                            die("Author query failed: " . mysqli_error($connection));
                        }
                        $author = mysqli_fetch_assoc($author_result);
                        ?>

                        <div class="post_autor-avatar">
                            <img src="./image/<?= $author['avatar'] ?>" alt="">
                        </div>
                        <div class="post_autor_info">
                            <h5>By: <?= "{$author['firsname']} {$author['lastname']}" ?></h5>
                            <small>
                                <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                            </small>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile ?>
    </div>
</section>

<!-- ===================== END OF BODY ========================= -->

<section class="category_buttons">
    <div class="category_buttons_container">
        <?php
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = mysqli_query($connection, $all_categories_query);
        // Check for errors in the all categories query
        if (!$all_categories) {
            die("All categories query failed: " . mysqli_error($connection));
        }
        ?>
        <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
            <a href="<?= ROOT_URL ?>category_post.php?id=<?= $category['id'] ?>" class="category_button_box"><?= $category['title'] ?></a>
        <?php endwhile ?>
    </div>
</section>

<!-- ===================== CATEGORY BUTTONS ========================= -->

<?php
include 'partials/footer.php';
?>
