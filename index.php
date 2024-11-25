<?php
include 'partials/header.php';

//get the post from database
$featured_query = "SELECT * FROM post WHERE is_featured = 1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

// get 6 post from database
$query = "SELECT * FROM post ORDER BY date_time DESC LIMIT 6";
$posts = mysqli_query($connection, $query);
?>

<?php if (mysqli_num_rows($featured_result) == 1) : ?>
    <section class="featured">
        <div class="container featured_container">
            <div class="post_info post_info_hero">

                <?php
                //get category from database
                $category_id = $featured['category_id'];
                $category_query = "SELECT * FROM categories WHERE id = $category_id";
                $category_result = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                ?>

                <!-- <a href="<?= ROOT_URL ?>category_post.php?id=<?= $featured['category_id'] ?>" class="category_button"><?= $category['title'] ?></a> -->
                <h1 class="post_title"><a href="post.html">Explore Cryptographic Events<span></span>: Uncover the Secrets of History <span></span> and Innovation.</a></h1>
            </div>
        </div>
        <div class="post_thumbail_hero_box">
            <img src="./image/ticket.webp">
        </div>


        <!-- SECTION TWO -->
        <div class="containertwo">
            <div class="post_info_hero_two">
                <h2 class="post_title_two"><a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
                <p class="post_body_two"><?= substr($featured['body'], 0, 400) ?>...</p>
            </div>
            <div class="post_autor two_autor">
                <?php
                //get post autor
                $author_id = $featured['author_id'];
                $author_query = "SELECT * FROM users WHERE id = $author_id";
                $author_result = mysqli_query($connection, $author_query);
                $author = mysqli_fetch_assoc($author_result);

                ?>
                <div class="post_autor-avatar">
                    <img src="./image/<?= $author['avatar'] ?>">
                </div>
                <div class="post_autor_info">
                    <h5>By: <?= "{$author['firsname']} {$author['lastname']}" ?></h5>
                    <small>
                        <?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?>
                    </small>
                </div>
            </div>

            <div class="post_thumbail_hero_two">
                <img src="./image/<?= $featured['thumbnail'] ?>">
                <p class="eventdate"><b>Event</b>
                    <?= date("M d, Y - H:i", strtotime($featured['eventdt'])) ?>
                </p>
            </div>

        </div>
    </section>
    <div class="containermap">
        <div class="flormap">
            <a href="venue.php"><img src="./image/floorplan.png"></a>
        </div>
    </div>

<?php else : ?>
    <section class="featured">
        <div class="container featured_container">
            <div class="post_info post_info_hero">
                <h1 class="post_title"><a href="post.php">Explore Cryptographic Events<span></span>: Uncover the Secrets of History <span></span> and Innovation.</a></h1>
            </div>
            <div class="post_thumbail_hero_box">
                <img src="./image/ticket.webp">
            </div>
        </div>
    </section>

<?php endif ?>

<!-- ===================== END OF HERO ========================= -->


<section class="post section1 <?= $featured ? '' : 'section_extra-margin' ?>">
    <h2 class="title">More to doscover</h2>
    <div class="container post_container">
        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>

            <article class="post">
                <div class="post_thumbail post_thumbail_small ">
                    <img src="./image/<?= $post['thumbnail'] ?>">
                    <?php if ($post['eventdt'] != '0000-00-00 00:00:00') : ?>
                        <p class="eventdate_small "><b>Event</b>
                            <?= date("M d, Y - H:i", strtotime($post['eventdt'])) ?>
                        </p>
                    <?php else : ?>
                        <p class="eventdate_small flip"><b>Coming soon</b>
                        <?php endif ?>
                </div>
                <div class="post_info">

                    <?php
                    //get category from database
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id = $category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                    $category_title = $category['title'];
                    ?>


                    <a href="<?= ROOT_URL ?>category_post.php?id=<?= $post['category_id'] ?>" class="category_button"><?= $category_title ?></a>

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
                </div>
            </article>
        <?php endwhile ?>
    </div>
</section>

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