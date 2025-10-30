<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/includes/helpers.inc.php'; ?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TilsPics: Manage Images</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<div id="wrapper">

<header>
    <h1>Manage Images</h1>

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

<main id="manage-images-page-main">

    <!-- Upload Image Form -->
    <div id="upload-image-form">
        <form action="" method="post" enctype="multipart/form-data" id="contentForm">
            <div>
                <label for="upload">Upload File:
                    <input type="file" id="upload" name="upload">
                </label>
            </div>
            <div>
                <label for="title">Image Title:
                    <input type="text" id="title" name="title">
                </label>
            </div>
            <div>
                <label for="desc">File Description:
                    <textarea type="text" id="desc" name="desc"></textarea>
                </label>
            </div>
            <div>
                <label for="date">Image Date:
                    <input type="date" id="date" name="date">
                </label>
            </div>
            <div>
                <p>Please fill out all fields</p>
            </div>
            <div>
                <input type="hidden" name="action" value="upload">
                <input type="submit" value="Upload">
            </div>
        </form>
    </div>

    <!-- Images Table -->
    <?php if (count($images) > 0): ?>
    <table id="images-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image Date</th>
                <th>Image Title</th>
                <th>Thumbnail</th>
                <th>File Name</th>
                <th>Description</th>
                <th>File Type</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $id = 0; ?>
            <?php foreach($images as $i): ?>
            <?php $id = $id + 1; ?>
            <tr>
                <!-- ID -->
                <td>
                    <?php htmlout($id); ?>
                </td>

                <!-- Image Date -->
                <td>
                    <?php htmlout($i['imagedate']); ?>
                </td>

                <!-- Image Title -->
                <td>
                    <?php htmlout($i['imagetitle']); ?>
                </td>

                <!-- Thumbnail -->
                <td>
                    <a href="<?php htmlout($i['filepath']); ?>" target="_blank">
                        <img src="<?php htmlout($i['filepath']); ?>">
                    </a>
                </td>

                <!-- Filename -->
                <td>
                    <a href="<?php htmlout($i['filepath']); ?>" target="_blank">
                        <?php htmlout($i['filename']); ?>
                    </a>
                </td>

                <!-- Description -->
                <td>
                    <?php htmlout($i['description']); ?>
                </td>

                <!-- File Type -->
                <td>   
                    <?php htmlout($i['mimetype']); ?>
                </td>

                <!-- Delete -->
                <td>
                    <form action="" method="post">
                        <div>
                            <input type="hidden" name="action" value="delete"/>
                            <input type="hidden" name="id" value="<?php htmlout($i['id']); ?>"/>
                            <input type="submit" value="Delete"/>
                        </div>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php endif; ?>

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
