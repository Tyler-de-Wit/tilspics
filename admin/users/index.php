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

if (!userHasRole('Account Administrator'))
{
    $error = 'Only Account Administrators may access this page.';
    include '../accessdenied.html.php';
    exit();
}

if (isset($_GET['add']))
{
    include $_SERVER['DOCUMENT_ROOT'] . $pathdb;

    $pageTitle = 'New User';
    $action = 'addform';
    $name = '';
    $email = '';
    $id = '';
    $button = 'Add user';

    // Build the list of roles
    try
    {
        $result = $pdo->query('SELECT id, description FROM role');
    }
    catch (PDOException $e)
    {
        $error = 'Error fetching list of roles.';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    foreach ($result as $row)
    {
        $roles[] = array(
            'id' => $row['id'],
            'description' => $row['description'],
            'selected' => FALSE);
    }

    include 'form.html.php';
    exit();
}

if (isset($_GET['addform']))
{
    include $_SERVER['DOCUMENT_ROOT'] . $pathdb;

    try
    {
        $sql = 'INSERT INTO user SET
            name = :name,
            email = :email';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_POST['name']);
        $s->bindValue(':email', $_POST['email']);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Error adding submitted user';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    $userid = $pdo->lastInsertId();

    if ($_POST['password'] != '')
    {
        $password = md5($_POST['password'] . 'cgdb');

        try
        {
            $sql = 'UPDATE user SET
                password = :password
                WHERE id = :id';
            $s = $pdo->prepare($sql);
            $s->bindValue(':password', $password);
            $s->bindValue(':id', $userid);
            $s->execute();
        }
        catch (PDOException $e)
        {
            $error = 'Error setting users password';
            include $_SERVER['DOCUMENT_ROOT'] . $patherror;
            exit();
        }
    }

    if (isset($_POST['roles']))
    {
        foreach ($_POST['roles'] as $role)
        {
            try
            {
                $sql = 'INSERT INTO userrole SET
                    userid = :userid,
                    roleid = :roleid';
                $s = $pdo->prepare($sql);
                $s->bindValue(':userid', $userid);
                $s->bindValue(':roleid', $role);
                $s->execute();
            }
            catch (PDOException $e)
            {
                $error = 'Error assigning selected role to user';
                include $_SERVER['DOCUMENT_ROOT'] . $patherror;
                exit();
            }
        }
    }

    header('Location: .');
    exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Edit')
{
    include $_SERVER['DOCUMENT_ROOT'] . $pathdb;

    try
    {
        $sql = 'SELECT id, name, email FROM user WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Error fetching user details.';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    $row = $s->fetch();

    $pageTitle = 'Edit User';
    $action = 'editform';
    $name = $row['name'];
    $email = $row['email'];
    $id = $row['id'];
    $button = 'Update user';

    // Get list of roles assigned to this user
    try
    {
        $sql = 'SELECT roleid FROM userrole WHERE userid = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $id);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Error fetching list of assigned roles.';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    $selectedRoles = array();
    foreach ($s as $row)
    {
        $selectedRoles[] = $row['roleid'];
    }

    // Build the list of all roles
    try
    {
        $result = $pdo->query('SELECT id, description FROM role');
    }
    catch (PDOException $e)
    {
        $error = 'Error fetching list of roles.';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    foreach ($result as $row)
    {
        $roles[] = array(
            'id' => $row['id'],
            'description' => $row['description'],
            'selected' => in_array($row['id'], $selectedRoles));
    }

    include 'form.html.php';
    exit();
}

if (isset($_GET['editform']))
{
    include $_SERVER['DOCUMENT_ROOT'] . $pathdb;

    try
    {
        $sql = 'UPDATE user SET
            name = :name,
            email = :email
            WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->bindValue(':name', $_POST['name']);
        $s->bindValue(':email', $_POST['email']);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Error updating submitted user';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    if ($_POST['password'] != '')
    {
        $password = md5($_POST['password'] . 'cgdb');

        try
        {
            $sql = 'UPDATE user SET
                password = :password
                WHERE id = :id';
            $s = $pdo->prepare($sql);
            $s->bindValue(':password', $password);
            $s->bindValue(':id', $_POST['id']);
            $s->execute();
        }
        catch (PDOException $e)
        {
            $error = 'Error setting user password';
            include $_SERVER['DOCUMENT_ROOT'] . $patherror;
            exit();
        }
    }

    try
    {
        $sql = 'DELETE FROM userrole WHERE userid = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Error removing obsolete user role entries.';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    if (isset($_POST['roles']))
    {
        foreach ($_POST['roles'] as $role)
        {
            try
            {
                $sql = 'INSERT INTO userrole SET
                    userid = :userid,
                    roleid = :roleid';
                $s = $pdo->prepare($sql);
                $s->bindValue(':userid', $_POST['id']);
                $s->bindValue(':roleid', $role);
                $s->execute();
            }
            catch (PDOException $e)
            {
                $error = 'Error assigning selected role to user';
                include $_SERVER['DOCUMENT_ROOT'] . $patherror;
                exit();
            }
        }
    }

    header('Location: .');
    exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Delete')
{
    include $_SERVER['DOCUMENT_ROOT'] . $pathdb;

    // Delete role assignments for this user
    try
    {
        $sql = 'DELETE FROM userrole WHERE userid = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Error removing user from roles.';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    // Delete the user
    try
    {
        $sql = 'DELETE FROM user WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Error deleting user';
        include $_SERVER['DOCUMENT_ROOT'] . $patherror;
        exit();
    }

    header('Location: .');
    exit();
}

// Display user list
include $_SERVER['DOCUMENT_ROOT'] . $pathdb;

try
{
    $result = $pdo->query('SELECT id, name FROM user');
}
catch (PDOException $e)
{
    $error = 'Error fetching users from the database!';
    include $_SERVER['DOCUMENT_ROOT'] . $patherror;
    exit();
}

foreach ($result as $row)
{
    $users[] = array('id' => $row['id'], 'name' => $row['name']);
}

include 'users.html.php';
