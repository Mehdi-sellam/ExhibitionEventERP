<?php
include 'partials/header.php';
require_once 'function.php';





<section class="dashboard">

    <?php if (isset($_SESSION['add-post-success'])) : ?>
        <div class="message_popup pass container">
            <p>
                <?= $_SESSION['add-post-success'];
                unset($_SESSION['add-post-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-post-success'])) : ?>
        <div class="message_popup pass container">
            <p>
                <?= $_SESSION['edit-post-success'];
                unset($_SESSION['edit-post-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-post'])) : ?>
        <div class="message_popup error container">
            <p>
                <?= $_SESSION['edit-post'];
                unset($_SESSION['edit-post']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-post-success'])) : ?>
        <div class="message_popup pass container">
            <p>
                <?= $_SESSION['delete-post-success'];
                unset($_SESSION['delete-post-success']);
                ?>
            </p>
        </div>
    <?php endif ?>




    <body>
        <div class="circular_bar">
            <?php
            // Ensure $connection to database is established before this part
            $comments = [
                "<span>Total<br>Users<br></span> " . getCount('users', $connection),
                "<span>Total<br>Post<br></span> " . getCount('post', $connection),
                "<span>Total<br>Categories<br></span> " . getCount('categories', $connection)
            ];

            foreach ($comments as $i => $comment) {
                $type = ['users', 'post', 'categories'][$i];
                $count = getCount($type, $connection);
                $offset = 450 * ($count / 10);  // Example calculation
            ?>
                <div class="skill" style="--offset<?php echo $i; ?>: <?php echo $offset; ?>;">
                    <div class="outer">
                        <div class="inner">
                            <div class="number"><?php echo $comment; ?></div>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="160px" height="160px">
                        <defs>
                            <linearGradient id="GradientColor<?php echo $i; ?>">
                                <stop offset="0%" stop-color="#DA22FF" />
                                <stop offset="100%" stop-color="#9733EE" />
                            </linearGradient>
                        </defs>
                        <circle cx="80" cy="80" r="70" stroke-linecap="round" stroke="url(#GradientColor<?php echo $i; ?>)" fill="none" stroke-width="10" data-index="<?php echo $i; ?>"></circle>
                    </svg>
                </div>
            <?php } ?>
        </div>
    </body>











    <div class=" container dashboard_container">
        <button id="show_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-left"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="add_post.php"><i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php" class="active"><i class="uil uil-tachometer-fast-alt"></i>
                        <h5>Manage Post</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li>
                        <a href="add_user.php"><i class="uil uil-user-plus"></i>
                            <h5>Add User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage_user.php"><i class="uil uil-user-exclamation"></i>
                            <h5>Manage User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add_category.php"><i class="uil uil-edit"></i>
                            <h5>Add Category</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage_category.php"><i class="uil uil-edit-alt"></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Post</h2>
            <?php if (mysqli_num_rows($posts) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Edit</th>
                            <th>Delite</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                            <!-- get category title for each post -->
                            <?php
                            $category_id = $post['category_id'];
                            $category_query = "SELECT title FROM categories WHERE id = $category_id";
                            $category_result = mysqli_query($connection, $category_query);
                            $category = mysqli_fetch_assoc($category_result);
                            ?>
                            <tr>
                                <td><?= $post['title'] ?></td>
                                <td><?= $category['title'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit_post.php?id=<?= $post['id'] ?>" class="button sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="button sm danger">Delite</a></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="message_popup error"><?= "No post found" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>

<!-- ===================== END OF DASHBOARD ========================= -->

<?php
include '../partials/footer.php';
?>