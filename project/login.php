<!DOCTYPE html>
<html lang="en">
    <head>
    <?php 
        $page_title = "Log In";
        include 'includes/metadata.php';?>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <section>
                <h2>Log In</h2>
                <form id="loginform" method="post" novalidate>
                    <div>
                        <label for="email">Email:</label>
                        <input id="email" name="email" type="email"
                        placeholder="janedoe@website.com" />
                    </div>

                    <div>
                        <label for="pword">Password:</label>
                        <input id="pword" name="pword" type="password" />
                    </div>

                    <div>
                        <button id="submit" name="submit">Log In</button>
                        <button id="submit" name="newaccount">Create Account</a></button>
                        <a href="">Forgot Password?</a>
                    </div>
                </form>
            </section>
        <?php include 'includes/footer.php';?>
    </body>
</html>