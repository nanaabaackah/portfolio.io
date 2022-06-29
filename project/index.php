<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $page_title = "Time Slot Manager";
        include 'includes/metadata.php';
        ?>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
            <section  class="back">
            <h1>Welcome to scheduleD!</h1>
                <div>
                    <h2>Create a schedule for free in minutes..</h2>
                    <p>Make unique and custom sign up sheets in minutes. No design skills needed.</p>
                </div>
                <button onclick="window.location.href='schedule.php';" >Sign Up - It's Free</button>                               
            </section>
            <section class="main">
                <div>
                    <img src="img/create.png" alt="Create Icon" />
                    <h3>Customize Forms</h3>
                    <p>Design professional lookingforms with scheduleD. Customize with vrious styling options</p>
                </div>  
                <div>
                    <img src="img/save_icon.png" alt="Save Time Icon" />
                    <h3>Save Time and Effort</h3>
                    <p>Speed up and simplify your daily work by automating complex tasks with scheduleD.</p>
                </div>        
            </section>  
            <?php include 'includes/footer.php';?>  
    </body>
</html>