<?php
include 'partials/header.php';

//get data back
$firsname = $_SESSION['add-user-data']['firsname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;

//cleare sesion
unset($_SESSION['add-user-data']);
?>

<section class="section_form">
    <div class="container form_sect-container">
        <h2>Add User</h2>
        <?php if (isset($_SESSION['add_user'])) : ?>
            <div class="message_popup error">
                <p>
                    <?= $_SESSION['add_user'];
                    unset($_SESSION['add_user']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="firsname" value="<?= $firsname ?>" placeholder="First Name">
            <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name">
            <input type="text" name="username" value="<?= $username ?>" placeholder="Username">
            <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
            <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">
            <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">
            <select name="userrole">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <div class="form_con">
                <label for="avatar">User Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="button">Add User</button>
        </form>
    </div>
</section>

<!-- ===================== END OF FORM ========================= -->

<?php
include '../partials/footer.php';
?>