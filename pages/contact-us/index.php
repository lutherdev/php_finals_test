<?php
$error = $_GET['error'] ?? '';
?>
<main class="contactus-container">

    <div class="location">
        <h1>Location of the Minekeeper</h1>

        <div class="medieval-map">
                <img src="/pages/contact-us/assets/img/mappp.png" alt="Mine Location Map">
            </a>
        </div>

        <div class="contact-info">
            <p><span class="label">Coordinates: </span>333 Sampaloc, Kingdom of Manila</p>
            <p><span class="label">Whispering Horn: </span>+63 987 654 3210</p>
            <p><span class="label">Pigeon Scroll: </span>mineforge333@gmail.com</p>
        </div>
    </div>

    <div class="comment">
        <h1>Send a Raven</h1>
        <form action="/handlers/contact.handler.php" method="POST">
            <div class="box-name">
                <input type="text" name="name" placeholder="Enter thy Name" required>
            </div>

            <div class="box-name">
                <input type="text" name="username" placeholder="Enter thy username" required>
            </div>

            <div class="box-email">
                <input type="email" name="email" placeholder="Enter thy Address" required>
            </div>

            <div class="box-message">
                <textarea name="message" placeholder="State thy Message" required></textarea>
            </div>

            <div class="box-button">
                <button type="submit">Dispatch Scroll</button>
            </div>
            <?php if (!empty($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </form>
    </div>

</main>
