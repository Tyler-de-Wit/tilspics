<?php

function userIsLoggedIn()//check if the login form has been submitted - Page 294
{
    if (isset($_POST['action']) and $_POST['action'] == 'login')
    {
        //make sure that the user has filled in a value for both the email address and password - Page 294
        if (!isset($_POST['email']) or $_POST['email'] == '' or !isset($_POST['password']) or $_POST['password'] == '')
        {
            $GLOBALS['loginError'] = 'Please fill in both fields';
            return FALSE;
        }
	    /*scramble the submitted password to match the scrambled version that will be stored in the database - Page 295 */
        $password = md5($_POST['password'] . 'cgdb');
	
	    //Query the database for a matching author record - Page 295
        if (databaseContainsAuthor($_POST['email'], $password))
        {
		    /* store the “flag” variable as well as the submitted email address and scrambled password in two additional session variables - Page 296 */
            session_start();
            $_SESSION['loggedIn'] = TRUE;
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $password;
            return TRUE;
        }
        else 
        {
            /* if the user submits a login form with incorrect values, we need to ensure the user is logged out, set an appropriate error message, and return FALSE: - Page 297 */
            session_start();
            unset($_SESSION['loggedIn']);
            unset($_SESSION['email']);
            unset($_SESSION['password']);
            $GLOBALS['loginError'] = 'The specified email address or password was incorrect.';
            return FALSE;
        }
    }
	//handle is the logout form - Page 298
    if (isset($_POST['action']) and $_POST['action'] == 'logout')
    {
        session_start();
        unset($_SESSION['loggedIn']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        header('Location: ' . $_POST['goto']);
        exit();
    }
	//check if the user is logged in using the session variables - Page 298
    session_start();
    if (isset($_SESSION['loggedIn']))
    {
        return databaseContainsAuthor($_SESSION['email'], $_SESSION['password']);
    }
}

function databaseContainsAuthor($email, $password)
{
    include 'db.inc.php';
	
    try
    {
        $sql = 'SELECT COUNT(*) FROM user
            WHERE email = :email AND password = :password';
        $s = $pdo->prepare($sql);
        $s->bindValue(':email', $email);
        $s->bindValue(':password', $password);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Error searching for user';
        include 'error.html.php';
        exit();
    }

    $row = $s->fetch();

    if ($row[0] > 0)
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function userHasRole($role)
{
    include 'db.inc.php';
  
	/* Need to check if the specified author has been assigned that role. This query will involve three database tables - Page 298 */
    try
    {
        $sql = "SELECT COUNT(*) FROM user
            INNER JOIN userrole ON user.id = userid
            INNER JOIN role ON roleid = role.id
            WHERE email = :email AND role.id = :roleId";
        $s = $pdo->prepare($sql);
        $s->bindValue(':email', $_SESSION['email']);
        $s->bindValue(':roleId', $role);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Error searching for user roles';
        include 'error.html.php';
        exit();
    }

    $row = $s->fetch();

    if ($row[0] > 0)
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}
