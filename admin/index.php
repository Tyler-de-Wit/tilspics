<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

if (!userIsLoggedIn())
{
	include 'login.html.php';
	exit();
}
?>

<!DOCTYPE html>
<html lang="en-au">
<head>
    <meta charset="utf-8">
    <title>TilsPics: Admin Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div id="wrapper">

<header>
    <h1>Admin Home</h1>

    <nav>
        <ul>
            <li><a href=".">Admin Home</a></li>
            <li><a href="images/">Manage Images</a></li>
            <li><a href="users/">Manage Users</a></li>
            <li><a href="contact/">Contact Submissions</a></li>
            <li><a href="../" id="return-button">Exit Admin</a></li>
            <li><?php include 'logout.inc.html.php'; ?></li>
        </ul>
    </nav>

    <aside class="hamburger-button">
        <span></span>
        <span></span>
        <span></span>
    </aside>
</header>

<main id="admin-home-page-main">

    <h2>Welcome To The Admin Area</h2>
    <p>Inside here you can manage the images inside the gallery, by either uploading new ones or deleting old ones.</p>
    <div><a href="images/">Manage Images</a></div>

    <p>You can manage the users which have access to the admin section. This includes adding and deleting users or changing their name, email, password, or permissions.</p>
    <div><a href="users/">Manage Users</a></div>

    <p>The last thing you can do is to view and delete each submission that comes through the contact form.</p>
    <div><a href="contact/">Manage Contacts</a></div>

</main>

<footer>
    <aside id="footer-navigation">
        <div>
        <h2>Page Navigation</h2>
        <ul>
            <li><a href="../">Home</a></li>
            <li><a href="../image-gallery.php">Images</a></li>
            <li><a href="../contact.php">Contact Us</a></li>
            <li><a href="../sitemap.php">Sitemap</a></li>
        </ul>
        </div>
    </aside>

    <aside id="footer-policies">
        <div>
        <h2>Our Polices</h2>
        <ul>
            <li><a href="../terms-and-conditions.php">Terms And Conditions</a></li>
            <li><a href="../code-of-ethics.php">Code Of Ethics</a></li>
            <li><a href="../privacy-policy.php">Privacy Policy</a></li>
        </ul>
        </div>
    </aside>

    <aside id="footer-copyright-statement">
        <p>&copy; CaptureGallery <?php echo date("Y"); ?>, All Rights Reserved</p>
    </aside>
</footer>

<!-- Close Wrapper div -->
</div> 

<script src="../js/main.js"></script>

</body>
</html>
