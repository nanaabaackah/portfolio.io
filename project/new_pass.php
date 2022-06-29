<?php 
session_start();
$success = [];
$errors = array();

require "includes/library.php";
$pdo = connectDB();

$username = $_POST['username'] ?? null;
$new_password = $_POST['new_password'] ?? null;
$conf_password = $_POST['conf_password'] ?? null;

$query = "select username, password from project_users where username = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$username]);

$result = $stmt->fetch();
$username = $result['username'];

if (isset($_POST['submit'])) {
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
        $page_title = "Log In";
        include 'includes/metadata.php';
    ?>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <section class="edit">
            <h2>Change Password</h2>
            <form action="<?=htmlentities($_SERVER['PHP_SELF'])?>" method="POST" autocomplete="off">
                <div>
                    <label for="username">Username:</label>
                    <input id="username" name="username" type="text" />
                    <span class="errors <?=!isset($errors['username']) ? 'hidden' : "";?>"
                    >Please enter your username</span>
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
                    <span class="errors <?=!isset($errors['conf_password']) ? 'hidden' : "";?>"
                    >Passwords do not match</span>
                    <span class="errors <?=!isset($errors['short']) ? 'hidden' : "";?>"
                    >Password is too short</span>
                </div>
                <div>
                    <button id="submit" name="submit">Update Password</button>
                </div>  

            </form>
            </section>
        <?php include 'includes/footer.php';?>
    </body>
</html>