<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: logout.php");
}
$user = $_SESSION['username'];

require "includes/library.php";

// CONNECT TO DATABASE
$pdo = connectDB();

$query = "DELETE FROM project_users WHERE username = ?";
$pdo->prepare($query)->execute([$user]);

$errors = [];

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $pdo = connectDB();

    $query = "SELECT id,username, password FROM `project_users` WHERE username = ?";
    $statement = $pdo->prepare($query);

    $statement->execute([$username]);
    $results = $statement->fetch();

    
    if ($results === false) {
        $errors['user'] = true;
    }
}

session_destroy();

foreach ($_COOKIE as $cookie){
    setcookie($cookie, "", 1);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $page_title = "Account Deleted";
        include 'includes/metadata.php';
        ?>
        <script defer src="scripts/delete.js"></script>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <h1>*Account Successfully Deleted!*</h1>
        <section class="signup">
                <h2>Log In</h2>
                <form action="<?=htmlentities($_SERVER['PHP_SELF'])?>" method="POST" autocomplete="off">
                    <div>
                        <label for="username">Username:</label>
                        <input id="username" name="username" type="text"
                        placeholder="username" />
                    </div>

                    <div>
                        <label for="password">Password:</label>
                        <input id="password" name="password" type="password" placeholder="Password">
                    </div>
                    <div>
                        <span class="error <?=!isset($errors['user']) ? 'hidden' : "";?>">*That user doesn't exist</span>
                        <span class="error <?=!isset($errors['login']) ? 'hidden' : "";?>">*Incorrect login info</span>
                     </div>
                     <div class="account">
                        <button id="submit" name="submit">Log In</button>
                        <button id="newaccount" name="newaccount">Create Account</a></button>
                        <a href="">Forgot Password?</a>
                    </div>
                </form>
            </section>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>