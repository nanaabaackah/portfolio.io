<?php 
session_start();
$success = [];
$errors = array();

require "includes/library.php";
$pdo = connectDB();

$username = $_SESSION['username'];
$query = "select username, email, password from project_users where username = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$username]);

$result = $stmt->fetch(PDO::FETCH_ASSOC);
$email = $result['email'];
$password = $result['password'];
// $query = "SELECT username,email FROM project_users WHERE username = $username";

// $stmt = $pdo->prepare($query)->execute([$email]);
// $user_email = $stmt->fetch(PDO::FETCH_ASSOC);

// $email = $user_email['email'];

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}
// $query = "SELECT email FROM project_users WHERE username = $username";
// $stmt = $pdo->query($query);
// if (!$stmt) {
//     die("Something went wrong");
// }

// $email = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['update_email'])) {
    $new_email = $_POST['email'] ?? null;
    $cur_email = $_POST['cur_email'] ?? null;

    $cur_email = filter_var($cur_email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($cur_email, FILTER_VALIDATE_EMAIL)) {
        $errors['format'] = true;
    }

    if(!isset($cur_email) || strlen($cur_email) === 0) {
        $errors['cur_email'] = true;
    }

    if($new_email === $email) {
        $errors['repeat_email'] = true;
    }


    $new_email = filter_var($new_email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $errors['format'] = true;
    }

    if(!isset($new_email) || strlen($new_email) === 0) {
        $errors['new_email'] = true;
    }

    if (count($errors) === 0){
        $query = "UPDATE `project_users` SET email = ? WHERE username = ?";
        $pdo->prepare($query)->execute([$new_email, $username]);

        $success['new_email'] = true;
    }
    
}

if (isset($_POST['update_pass'])) {
    
    $cur_password = $_POST['cur_password'] ?? null;
    $new_password = $_POST['new_password'] ?? null;
    $conf_password = $_POST['conf_password'] ?? null;

    if(!isset($cur_password) || strlen($cur_password) === 0) {
        $errors['cur_password'] = true;
    }

    if($cur_password === $new_password) {
        $errors['repeat'] = true;
    }

    if ($new_password != $conf_password) {
        $errors['conf_password'] = true;
    }

    if (strlen($new_password) < 8) {
        $errors['short'] = true;
    }

    if (count($errors) === 0) {
        $options = ['cost' => 12,];
        $new_password = password_hash($new_password, PASSWORD_DEFAULT, $options);
        $query = "UPDATE `project_users` SET password = ? WHERE username = ?";
        $pdo->prepare($query)->execute([$new_password, $username]);


        $success['new_password'] = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $page_title = "My Account";
        include 'includes/metadata.php';
        ?>
        <script defer src="scripts/delete.js"></script>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <section  class="sides">
            <div>
                <nav>
                    <ul>
                        <li><i class="fas fa-user"></i><a href="account.php">Account Details</a></li>
                        <li><i class="fas fa-sticky-note"></i><a href="mysheets.php">My Sheets</a></li>
                    </ul>
                </nav>
            </div>
            <div class="edit">
                <h2>Edit Account Details</h2>
                <form id="requestform" action="<?=htmlentities($_SERVER['PHP_SELF']);?>" method="post" novalidate>
                    <div>                        
                        <label for="cur_email">Current Email</label>
                        <input id="cur_email" name="cur_email" type="text" />
                        <span class="errors <?=!isset($errors['new_email']) ? 'hidden' : "";?>"
                        >Please enter an email</span>
                        <span class="errors <?=!isset($errors['format']) ? 'hidden' : "";?>"
                        >Incorrect Email Format</span>
                    </div>
                    <div>                        
                        <label for="email">New Email</label>
                        <input id="email" name="email" type="text" />
                        <span class="errors <?=!isset($errors['new_email']) ? 'hidden' : "";?>"
                        >Please enter an email</span>
                        <span class="errors <?=!isset($errors['format']) ? 'hidden' : "";?>"
                        >Incorrect Email Format</span>
                        <span class="errors <?=!isset($errors['repeat_email']) ? 'hidden' : "";?>"
                        >Cannot be the same as old email</span>
                    </div>
                    <div>
                        <label for="cur_password">Current Password:</label>
                        <input id="cur_password" name="cur_password" type="password" />
                        <span class="errors <?=!isset($errors['cur_password']) ? 'hidden' : "";?>"
                        >Please enter current password</span>
                    </div>
                    <div>
                        <label for="new_password">New Password:</label>
                        <input id="new_password" name="new_password" type="password" />
                        <span class="errors <?=!isset($errors['repeat']) ? 'hidden' : "";?>"
                        >Cannot be the same as old password</span>
                        <span class="errors <?=!isset($errors['conf_password']) ? 'hidden' : "";?>"
                        >Passwords do not match</span>
                        <span class="errors <?=!isset($errors['short']) ? 'hidden' : "";?>"
                        >Password is too short</span>
                    </div>
                    <div>
                        <label for="conf_password">Confirm New Password:</label>
                        <input id="conf_password" name="conf_password" type="password" />
                        <span class="errors <?=!isset($errors['conf_password']) ? 'hidden' : "";?>"
                        >Passwords do not match</span>
                    </div>
                    <div>                      
                        <span class="errors <?=!isset($success['new_email']) ? 'hidden' : "";?>"
                        >Email Updated Successfully to <?php echo $new_email; ?></span>
                        <span class="errors <?=!isset($success['new_password']) ? 'hidden' : "";?>"
                        >Password Updated Successfully</span>
                    </div>     
                    <div>
                        <button id="update_email" name="update_email">Update Email</button>
                        <button id="update_pass" name="update_pass">Update Password</button>
                    </div>
                </form>   
                <div class="delete">
                    <button id="delete" name="delete" >Delete Account</button>
                </div>     
            </div>
        </section>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>