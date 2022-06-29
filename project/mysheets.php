<?php
/****************************************
// ENSURES THE USER HAS ACTUALLY LOGGED IN
// IF NOT REDIRECT TO THE LOGIN PAGE HERE
 ******************************************/

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

require "includes/library.php";

// CONNECT TO DATABASE
$pdo = connectDB();

$query = "SELECT sheetid,sheetname,start,stop FROM project_sheetdata";
$stmt = $pdo->query($query);
$stmt->execute([]);
if (!$stmt) {
    die("Something went horribly wrong");
}

$sheets = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $page_title = "My Sheets";
        include 'includes/metadata.php';
        ?>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <h1>My Sheets</h1>
        <section class="sides">
            <div>
                <nav>
                    <ul>
                        <li><i class="fas fa-user"></i><a href="account.php">Account Details</a></li>
                        <li><i class="fas fa-sticky-note"></i><a href="mysheets.php">My Sheets</a></li>
                    </ul>
                </nav>
            </div>
            <div>
                <h3>Sheet Name</h3>
                <ol>
                    <?php echo $sheets; ?>
                    <!-- <?php foreach ($sheets as $row): ?>
                        <li><?=$row['sheetname']?></li>
                    <?php endforeach; ?> -->
                </ol>
            </div>
        </section>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>