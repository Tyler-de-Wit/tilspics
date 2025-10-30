<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

// Submit form fields to database
if (isset($_POST['action']) and $_POST['action'] == 'upload') 
{
    try
    {
        $sql = 'INSERT INTO contact SET
            firstname = :firstName,
            lastname = :lastName,
            email = :email,
            contactmessage = :contactMessage';
        $s = $pdo->prepare($sql);
        $s->bindValue(':firstName', $_POST['firstName']);
        $s->bindValue(':lastName', $_POST['lastName']);
        $s->bindValue(':email', $_POST['email']);
        $s->bindValue(':contactMessage', $_POST['textArea']);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Error adding data to database. ' . $e->getMessage();
        include 'includes/error.html.php';
        exit();
    }

    header('Location: contact.php');
    exit();
}

include 'template/template.php';

include 'template/head.php';

include 'template/nav.php';

include 'content/contact-content.php';

include 'template/footer.php';
