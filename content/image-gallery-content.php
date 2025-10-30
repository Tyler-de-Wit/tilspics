<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/includes/helpers.inc.php'; ?>

<!-- Main -->
<main id="images-page-main">

    <!-- Images Table -->
    <?php if (count($images) > 0): ?>
    <table id="images-table">
        <thead>
            <tr>
                <th id="thumbnail">Thumbnail</th>
                <th id="metadata">Metadata</th>
                <th id="properties">Image Properties</th>
            </tr>
        </thead>
        <tbody>
            <?php $id = 0; ?>
            <?php foreach($images as $i): ?>
            <?php $id = $id + 1; ?>
            <tr>
                <!-- Thumbnail -->
                <td>
                    <a href="<?php htmlout($i['filepath']); ?>">
                        <img src="<?php htmlout($i['filepath']); ?>" alt="<?php htmlout($i['description']); ?>">
                    </a>
                </td>

                <td>
                    <table>
                        <tr>
                            <!-- File Name -->
                            <th>File Name</th>
                            <td>
                                <a href="<?php htmlout($i['filepath']); ?>">
                                    <?php htmlout($i['filename']); ?>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <!-- File Type -->
                            <th>File Type</th>
                            <td>
                                <?php htmlout($i['mimetype']); ?>
                            </td>
                        </tr>
                        <tr>
                            <!-- Image Data -->
                            <th>Image Date</th>
                            <td>
                                <?php htmlout($i['imagedate']); ?>
                            </td>
                        </tr>
                    </table>
                </td>

                <td>
                    <table>
                        <tr>
                            <!-- Image Title -->
                            <th>Image Title</th>
                            <td>
                                <?php htmlout($i['imagetitle']); ?>
                            </td>
                        </tr>
                        <tr>
                            <!-- Description -->
                            <th>Description</th>
                            <td>
                                <?php htmlout($i['description']); ?>
                            </td>
                        </tr>
                        <tr>
                            <!-- Download -->
                            <th>Download</th>
                            <td>
                                <form action="" method="get">
                                    <div>
                                        <input type="hidden" name="action" value="download"/>
                                        <input type="hidden" name="id" value="<?php htmlout($i['id']); ?>"/>
                                        <input type="submit" value="Download" id="download-button"/>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </table>
                </td>

            <?php endforeach; ?>
        </tbody>
    </table>

    <?php endif; ?>

</main>
