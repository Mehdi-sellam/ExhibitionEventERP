<?php
require 'config/constants.php';

// keep back form data
$firsname = $_SESSION['register-data']['firsname'] ?? null;
$lastname = $_SESSION['register-data']['lastname'] ?? null;
$username = $_SESSION['register-data']['username'] ?? null;
$email = $_SESSION['register-data']['email'] ?? null;
$createpassword = $_SESSION['register-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['register-data']['confirmpassword'] ?? null;
// delite session
unset($_SESSION['register-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cryptographic Devices</title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>

<body>

    <section class="section_form">
        <div class="container form_sect-container">
            <h2>Register</h2>
            <?php if (isset($_SESSION['register'])) : ?>
                <div class="message_popup error">
                    <p>
                        <?= $_SESSION['register'];
                        unset($_SESSION['register']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="firsname" value="<?= $firsname ?>" placeholder="First Name">
                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name">
                <input type="text" name="username" value="<?= $username ?>" placeholder="Username">
                <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
                <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">
                <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">
                <div class="form_con">
                    <label for="avatar">User Avatar</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" name="submit" class="button">Register</button>
                <small>Already have an account? <a href="login.php">Login</a></small>
            </form>
        </div>
    </section>

</body>

</html>