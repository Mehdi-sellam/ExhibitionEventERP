<?php
include 'partials/header.php';

?>

<div class="container_con">
    <div class="iten">
        <div class="contact">
            <!-- <div class="first-text">Let's get in touch</div> -->
            <img src="image/1714513_s.png" class="image">
        </div>
        <div class="submit-form">
            <h4 class="third-text">Contact Us</h4>
            <form action="/submit_form_endpoint" autocomplete="off"> <!-- Example action URL -->
                <div class="input-box">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="input" required>
                </div>
                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="input" required>
                </div>
                <div class="input-box">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" class="input" required>
                </div>
                <div class="input-box">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" class="input" required cols="30" rows="10"></textarea>
                </div>
                <input type="submit" class="category_button" value="Submit">
            </form>
        </div>
    </div>
</div>

<?php
include 'partials/footer.php';
?>