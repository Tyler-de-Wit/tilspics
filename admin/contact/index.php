<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

if (!userIsLoggedIn())
{
	include '../login.html.php';
	exit();
}

if (!userHasRole('Contacts Editor'))
{
	$error = 'Only Contacts Editors may access this page.';
	include '../accessdenied.html.php';
	exit();
}

// Delete database entry
if (isset($_GET['deletejoke']))
{
    try
    {
        $sql = 'DELETE FROM contact WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Error deleting entry: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    header('Location: .');
    exit();
}

// Select rows from database
try
{
    $sql = 'SELECT id, firstname, lastname, email, contactmessage FROM contact';
    $result = $pdo->query($sql);
}
catch (PDOException $e)
{
    $error = 'Error selecting fields from database: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}

// Build submissions array to display on page
while ($row = $result->fetch())
{
    $submissions[] = array(
        'id' => $row['id'],
        'firstName' => $row['firstname'],
        'lastName' => $row['lastname'],
        'email' => $row['email'],
        'contactMessage' => $row['contactmessage']);
}

include 'form-submissions.php';
