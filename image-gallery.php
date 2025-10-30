<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
$pathdb = '/includes/db.inc.php';
$patherror = '/includes/error.html.php';

// Download Image
if (isset($_GET['action']) and ($_GET['action'] == 'view' or $_GET['action'] == 'download') and isset($_GET['id']))
{
    include $_SERVER['DOCUMENT_ROOT'] . $pathdb;

    try
    {
        $sql = 'SELECT filename, mimetype, filepath
            FROM image
            WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_GET['id']);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Database error fetching requested file.';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    $file = $s->fetch();
    if (!$file)
    {
        $error = 'File with specified ID not found in the database!';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    $filename = $file['filename'];
    $mimetype = $file['mimetype'];
    $filepath = $file['filepath'];
    $filepath = substr($filepath, 1);
    $disposition = 'inline';

    if ($_GET['action'] == 'download')
    {
        $mimetype = 'application/octet-stream';
        $disposition = 'attachment';
    }

    // Content-type must come before Content-disposition
    header("Content-type: $mimetype");
    header("Content-Disposition: $disposition; filename=$filename");

    readfile($filepath);
    exit();
}

try
{
    $result = $pdo->query(
        'SELECT id, userid, imagedate, filename, imagetitle, filepath, mimetype, description FROM image');
}
catch (PDOException $e)
{
    $error = 'Database error fetching stored files.';
    include $_SERVER['DOCUMENT_ROOT'] . $patherror;
    exit();
}

$images = array();
foreach ($result as $row)
{
    $images[] = array(
        'id' => $row['id'],
        'userid' => $row['userid'],
        'imagedate' => $row['imagedate'],
        'filename' => $row['filename'],
        'imagetitle' => $row['imagetitle'],
        'filepath' => $row['filepath'],
        'mimetype' => $row['mimetype'],
        'description' => $row['description']);
}


include 'template/template.php';

include 'template/head.php';

include 'template/nav.php';

include 'content/image-gallery-content.php';

include 'template/footer.php';
