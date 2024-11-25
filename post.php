<?php
include 'partials/header.php';

//get post from database
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM post WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'devices.php');
    die();
}
?>

<section class="one_post">
    <div class="container one_post_container">
        <h2><?= $post['title'] ?></h2>
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
            <div class="post_autor_info_v2">
                <h5>By: <?= "{$author['firsname']} {$author['lastname']}" ?></h5>
                <small>
                    <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                </small>
            </div>
        </div>
        <div class="one_post_thumbnail">
            <div class="post_thumbail post_thumbail_one">
                <img src="./image/<?= $post['thumbnail'] ?>">
                <?php if ($post['eventdt'] != '0000-00-00 00:00:00') : ?>
                    <p class="eventdate eventdate_one "><b>Event</b>
                        <?= date("M d, Y - H:i", strtotime($post['eventdt'])) ?>
                    </p>
                <?php else : ?>
                    <p class="eventdate eventdate_one flip"><b>Coming soon</b>
                    <?php endif ?>
            </div>
            <div>
                <p>
                    <?= $post['body'] ?>
                </p>

            </div>
        </div>
</section>

<!-- ===================== END OF POST ========================= -->

<?php
include 'partials/footer.php';
?>