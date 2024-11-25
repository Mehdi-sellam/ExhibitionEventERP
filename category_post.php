<?php
require 'partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM post WHERE category_id = $id ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . 'devices.php');
    die();
}

?>

<header class="cate_title">
    <h2>
        <?php
        //get category from database
        $category_id = $id;
        $category_query = "SELECT * FROM categories WHERE id=$id";
        $category_result = mysqli_query($connection, $category_query);
        $category = mysqli_fetch_assoc($category_result);
        $category_title = $category['title'];
        echo $category['title'];
        ?>
    </h2>
</header>

<!-- ===================== END OF HEADER ========================= -->

<?php if (mysqli_num_rows($posts) > 0) : ?>
    <section class="post section1">
        <div class="container post_container">
            <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                <article class="post">
                    <div class="post_thumbail post_thumbail_small trans">
                        <img src="./image/<?= $post['thumbnail'] ?>">
                        <?php if ($post['eventdt'] != '0000-00-00 00:00:00') : ?>
                            <p class="eventdate_small"><b>Event</b>
                                <?= date("M d, Y - H:i", strtotime($post['eventdt'])) ?>
                            </p>
                        <?php else : ?>
                            <p class="eventdate_small flip "><b>Coming soon</b>
                            <?php endif ?>
                    </div>


                    <div class="post_info">
                        <h3 class="post_title"><a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h3>
                        <p class="post_body"><?= substr($post['body'], 0, 150) ?>...</p>
                        <div class="post_autor">
                            <?php
                            //get post autor
                            $author_id = $post['author_id'];
                            $author_query = "SELECT * FROM users WHERE id = $author_id";
                            $author_result = mysqli_query($connection, $author_query);
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
                </article>
            <?php endwhile ?>
        </div>
    </section>
<?php else : ?>
    <div class="message_popup error lg">
        <p>No post found for this category.</p>
    </div>
<?php endif ?>

<!-- ===================== END OF BODY ========================= -->

<section class="category_buttons">
    <!-- <div class="container category_buttons_container"> -->
    <div class="category_buttons_container">
        <?php
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = mysqli_query($connection, $all_categories_query);
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