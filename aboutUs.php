<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "inc/head.inc.php";
    ?>
</head>

<body>
    <?php
    include "inc/nav.inc.php";
    ?>
    <main class="container">
    <section class="aboutUS">
            <h2>Our Product Range</h2>
            <p>From state-of-the-art smartphones to sleek laptops, smart home devices to powerful gaming consoles, and everything in between, Circuit Cart has it all. Whether you're a tech enthusiast looking for the latest releases or a casual user in need of everyday electronics, our extensive product range ensures that there's something for everyone.</p>
        </section>

        <section>
            <h2>Quality Assurance</h2>
            <p>At Circuit Cart, quality is our top priority. We source our products from reputable manufacturers and ensure that each item undergoes rigorous quality checks before it reaches your doorstep. Rest assured, when you shop with us, you're getting nothing but the best in terms of quality and reliability.</p>
        </section>

        <section>
            <h2>User-Friendly Experience</h2>
            <p>Navigating through Circuit Cart is a breeze. Our user-friendly website interface allows you to browse through various categories, compare products, read reviews, and make hassle-free purchases with just a few clicks. Whether you're shopping from your desktop or on the go with your mobile device, our platform is optimized for seamless shopping experiences across all devices.</p>
        </section>

        <section>
            <h2>Exceptional Customer Service</h2>
            <p>Our dedicated customer service team is here to assist you every step of the way. Have a question about a product? Need help with your order? No problem! Simply reach out to our friendly support staff, and we'll ensure that your queries are addressed promptly and satisfactorily.</p>
        </section>

        <section>
            <h2>Secure Payment and Fast Shipping</h2>
            <p>At Circuit Cart, we understand the importance of security when it comes to online shopping. That's why we offer secure payment options to protect your financial information. Once you've placed your order, our efficient logistics team works tirelessly to ensure swift order processing and delivery, so you can start enjoying your new gadgets in no time.</p>
        </section>

        <section>
            <h2>Stay Connected</h2>
            <p>Don't miss out on the latest updates, promotions, and tech news! Follow us on social media and subscribe to our newsletter to stay informed about the newest arrivals, exclusive deals, and exciting offers available only at Circuit Cart.</p>
        </section>
        <br>
        <section class="contact-form">
            <h2>Contact Us</h2>
            <form action="process_contact.php" method="post">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br>

                <label for="message">Message:</label><br>
                <textarea id="message" name="message" rows="4" required></textarea><br><br>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </section>
    </main>
    <br><br>
    <?php
    include "inc/footer.inc.php";
    ?>
</body>

</html>