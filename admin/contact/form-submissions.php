<!DOCTYPE html> 
<html lang="en-au">
<head>
    <meta charset="utf-8">
    <title>TilsPics: Form Submissions</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<div id="wrapper">

<header>
    <h1>Contact Form Submissions</h1>

    <nav>
        <ul>
            <li><a href="../">Admin Home</a></li>
            <li><a href="../images/">Manage Images</a></li>
            <li><a href="../users/">Manage Users</a></li>
            <li><a href="../contact/">Contact Submissions</a></li>
            <li><a href="../../" id="return-button">Exit Admin</a></li>
            <li><?php include '../logout.inc.html.php'; ?></li>
        </ul>
    </nav>

    <aside class="hamburger-button">
        <span></span>
        <span></span>
        <span></span>
    </aside>
</header>

<main id="form-submissions-main">
    <?php if(isset($submissions)) { 
        foreach ($submissions as $submission):
    ?>

    <form action="?deletejoke" method="post">
        <blockquote>
            <p>
                <input type="hidden" name="id" value="<?php echo $submission['id']; ?>">
                <span>First Name:</span>
                <?php echo htmlspecialchars($submission['firstName'], ENT_QUOTES, 'UTF-8'); ?>
                <br>

                <span>Last Name:</span>
                <?php echo htmlspecialchars($submission['lastName'], ENT_QUOTES, 'UTF-8'); ?>
                <br>

                <span>Email:</span>
                <?php echo htmlspecialchars($submission['email'], ENT_QUOTES, 'UTF-8'); ?>
                <br>

                <span>Contact Message:</span>
                <?php echo htmlspecialchars($submission['contactMessage'], ENT_QUOTES, 'UTF-8'); ?>
                <br>

                <input type="submit" value="Delete">
            </p>
        </blockquote>
    </form>
    
    <?php endforeach;}
        else {echo 'There are no form submissions';}
    ?>
</main>

<footer>
    <aside id="footer-navigation">
        <div>
        <h2>Page Navigation</h2>
        <ul>
            <li><a href="../../">Home</a></li>
            <li><a href="../../image-gallery.php">Images</a></li>
            <li><a href="../../contact.php">Contact Us</a></li>
            <li><a href="../../sitemap.php">Sitemap</a></li>
        </ul>
        </div>
    </aside>

    <aside id="footer-policies">
        <div>
        <h2>Our Polices</h2>
        <ul>
            <li><a href="../../terms-and-conditions.php">Terms And Conditions</a></li>
            <li><a href="../../code-of-ethics.php">Code Of Ethics</a></li>
            <li><a href="../../privacy-policy.php">Privacy Policy</a></li>
        </ul>
        </div>
    </aside>

    <aside id="footer-copyright-statement">
        <p>&copy; CaptureGallery <?php echo date("Y"); ?>, All Rights Reserved</p>
    </aside>
</footer>

<!-- Close Wrapper div -->
</div> 

<script src="../../js/main.js"></script>

</body>
</html>
