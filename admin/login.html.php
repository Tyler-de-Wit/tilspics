<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
	
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Log In</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main id="login-page-main">
        <div id="login-form">
            <h1>Login</h1>
            <p>Please log in to view the page that you requested</p>

            <?php if (isset($loginError)): ?>
                <p><?php htmlout($loginError); ?></p>
            <?php endif; ?>

            <form action="" method="post">
                <div>
                    <label for="email">Email 
                        <input type="text" name="email" id="email" placeholder="Type your email">
                    </label>
                </div>

                <div>
                    <label for="password">Password 
                        <input type="password" name="password" id="password" placeholder="Type your password">
                    </label>
                </div>

                <div>
                    <input type="hidden" name="action" value="login">
                    <input type="submit" value="LOGIN">
                </div>
            </form>
            <p><a href="../">Return to TilsPics</a></p>
        </div>
    </main>
</body>
</html>
