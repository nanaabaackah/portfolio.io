<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
        $page_title = "Sign Up";
        include 'includes/metadata.php'; ?>
    </head>
    <body>
        <?php include 'includes/header.php';?>
        <section>
                <h2>Sign Up</h2>
                <form>
                    <div>
                        <label for="fname">First Name: </label>
                        <input id="fname" name="fname" type="text" 
                        placeholder="Jane" />
                    </div>
                    <div>
                        <label for="lastname">Last Name: </label>
                        <input id="lastname" name="lastname" type="text" 
                        placeholder="Doe" />
                    </div>
                    <div>
                        <label for="email">Email: </label>
                        <input id="email" name="email" type="email" 
                        placeholder="janedoe@website.com" />
                    </div>
                    <div>
                        <label for="pword">Pasword: </label>
                        <input id="pword" name="pword" type="password" 
                        placeholder="********" />
                    </div>
                    <div class="account">
                        <button id="submit" name="submit">Create Account</button>
                        <a href="login.php">I already have an Account</a>
                    </div> 
                </form>
            </section>      
            <?php include 'includes/footer.php';?>
    </body>
</html>
