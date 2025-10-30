<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TilsPics: Manage Users</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<div id="wrapper">

<header>
    <h1>Manage Users</h1>

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

<main id="manage-users-main">
    <div id="edit-users">
        <p><a href="?add">Add new user</a></p>
        <table>
            <thead>
                <th>Users</th>
                <th></th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <form action="" method="post">
                        <td><?php htmlout($user['name']); ?></td>
                        <td><input type="hidden" name="id" value="<?php echo $user['id']; ?>"></td>
                        <td><input type="submit" name="action" value="Edit"></td>
                        <td><input type="submit" name="action" value="Delete" id="delete"></td>
                    </form>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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
