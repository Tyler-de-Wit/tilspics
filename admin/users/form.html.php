<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
	
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php htmlout($pageTitle); ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<div id="wrapper">

<header>
    <h1><?php htmlout($pageTitle); ?></h1>

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

<main id="edit-users-main">
    <form action="?<?php htmlout($action); ?>" method="post">
        <!-- Name -->
        <div>
            <label for="name">Name: 
                <input type="text" name="name" id="name" value="<?php htmlout($name); ?>">
            </label>
        </div>

        <!-- Email -->
        <div>
            <label for="email">Email: 
                <input type="text" name="email" id="email" value="<?php htmlout($email); ?>">
            </label>
        </div>

        <!-- Password -->
        <div>
            <label for="password">Set password: 
                <input type="password" name="password" id="password">
            </label>
        </div>

        <!-- Roles -->
        <fieldset>
            <legend>Roles:</legend>
            <?php for ($i = 0; $i < count($roles); $i++): ?>
            <div>
                <label for="role<?php echo $i; ?>">
                    <input type="checkbox" 
                        name="roles[]" 
                        id="role<?php echo $i; ?>" 
                        value="<?php htmlout($roles[$i]['id']); ?>"
                        <?php if ($roles[$i]['selected']) {echo ' checked';}?>>
                        <?php htmlout($roles[$i]['id']); ?>
                </label>
                <p>
                    :
                    <?php htmlout($roles[$i]['description']); ?>
                </p>
            </div>
            <?php endfor; ?>
        </fieldset>

        <!-- Submit -->
        <div id="submit-button">
            <input type="hidden" name="id" value="<?php htmlout($id); ?>">
            <input type="submit" value="<?php htmlout($button); ?>">
        </div>
    </form>
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
