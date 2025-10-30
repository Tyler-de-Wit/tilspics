<?php
$pathaccess = '/includes/access.inc.php';
$pathdb = '/includes/db.inc.php';
$patherror = '/includes/error.html.php';

require_once $_SERVER['DOCUMENT_ROOT'] . $pathaccess;

if (!userIsLoggedIn())
{
	include '../login.html.php';
	exit();
}

if (!userHasRole('Content Editor'))
{
	$error = 'Only Content Editors may access this page.';
	include '../accessdenied.html.php';
	exit();
}

// Upload to database
if (isset($_POST['action']) and $_POST['action'] == 'upload')
{
    include $_SERVER['DOCUMENT_ROOT'] . $pathdb;
    
    // Test if form fields are empty 
    if (!is_uploaded_file($_FILES['upload']['tmp_name']))
    {
        $error = 'There was no file selected!';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }
    elseif (empty($_POST['desc'])) 
    {
        $error = 'There was no file description set!';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }
    elseif (empty($_POST['title'])) 
    {
        $error = 'There was no image title set!';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    // Upload image to folder
    $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/images/uploads/';
    $targetFile = $targetDirectory . basename($_FILES['upload']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Remove spaces and commas in the image file name
    $targetFile = str_replace(' ', '-', $targetFile);
    $targetFile = str_replace(',', '', $targetFile);

    // Check if image file is a actual image or fake image
    if (isset($_POST['action']) and $_POST['action'] == 'upload') 
    {
        $check = getimagesize($_FILES['upload']['tmp_name']);
        if($check !== false) 
        {
            $uploadOk = 1;
        } 
        else 
        {
            $error = 'Uploaded file was not an image';
            include $_SERVER['DOCUMENT_ROOT'] . $patherror;
            exit();
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($targetFile)) 
    {
        $error = 'File already exists in database';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["upload"]["size"] > 50000000) 
    {
        $error = 'Sorry, your file is too large';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp" ) 
    {
        $error = 'Sorry, only JPG, JPEG, PNG WEBP and GIF files are allowed';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) 
    {
        $error = 'The image failed to upload';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
        // If there is no error try to upload file
    } 
    else 
    {
        if (!move_uploaded_file($_FILES["upload"]["tmp_name"], $targetFile)) 
        {
            $error = 'The image failed to upload';
            include $_SERVER['DOCUMENT_ROOT'] . $patherror;
            exit();
        } 
    }

    // Upload image information to database
    $uploadname = $_FILES['upload']['name'];
    // Remove spaces and commas in the image file name
    $uploadname = str_replace(' ', '-', $uploadname);
    $uploadname = str_replace(',', '', $uploadname);

    $uploadtype = $_FILES['upload']['type'];
    $uploaddesc = $_POST['desc'];

    // If date not set asign to current date
    $uploaddate = $_POST['date'];
    if($uploaddate == null) {
        $uploaddate = date("Y-m-d");
    }

    // Change $targetFile directory to relative instead of absolute address
    $targetFileStrPos = strpos($targetFile, '/images');
    $targetFile = substr($targetFile, $targetFileStrPos);

    // Upload image information to database
    try
    {
        $sql = 'INSERT INTO image SET
            imagetitle = :imagetitle,
            description = :description,
            imagedate = :imagedate,
            filename = :filename,
            filepath = :filepath,
            mimetype = :mimetype';
        $s = $pdo->prepare($sql);
        $s->bindValue(':imagetitle', $_POST['title']);
        $s->bindValue(':description', $uploaddesc);
        $s->bindValue(':imagedate', $uploaddate);
        $s->bindValue(':filename', $uploadname);
        $s->bindValue(':filepath', $targetFile);
        $s->bindValue(':mimetype', $uploadtype);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Database error storing file!';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    header('Location: .');
    exit();
}

// Download Image
if (isset($_GET['action']) and ($_GET['action'] == 'view' or $_GET['action'] == 'download') and isset($_GET['id']))
{
    include $_SERVER['DOCUMENT_ROOT'] . $pathdb;

    try
    {
        $sql = 'SELECT filename, mimetype, filedata
            FROM guitar
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
    $filedata = $file['filedata'];
    $disposition = 'inline';

    if ($_GET['action'] == 'download')
    {
        $mimetype = 'application/octet-stream';
        $disposition = 'attachment';
    }

    // Content-type must come before Content-disposition
    header('Content-length: ' . strlen($filedata));
    header("Content-type: $mimetype");
    header("Content-disposition: $disposition; filename=$filename");

    echo $filedata;
    exit();
}

// Delete Image
if (isset($_POST['action']) and $_POST['action'] == 'delete' and isset($_POST['id']))
{
    include $_SERVER['DOCUMENT_ROOT'] . $pathdb;

    // Select filename from database
    try
    {
        $sql = 'SELECT filename FROM image
            WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Database error requesting filename';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    // Delete file from filename
    try
    {
        $file = $s->fetch();
        $fileName = $file['filename'];
        unlink($_SERVER['DOCUMENT_ROOT'] . '/images/uploads/' . $fileName);
    }
    catch (Exception $e)
    {
        $error = 'Database error requesting filename' . $e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    // Delete Image from database
    try
    {
        $sql = 'DELETE FROM image
            WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Database error deleting requested file';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    header('Location: .');
    exit();
}

include $_SERVER['DOCUMENT_ROOT'] . $pathdb;

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

include 'form.html.php';
