<?php
 
$errors = array();

$slots = $_POST['slots'] ?? "";
$slotname = $_POST['slot_name'] ?? null;
$date = $_POST['date'] ?? "";
$time = $_POST['time'] ?? "";
$numberofslots = $_POST['number_slots'] ?? "";

if (isset($_POST['save'])) {

    if (empty($slots)) {
        $errors['slots'] = true;
    }

    $slotname = filter_var($slotname, FILTER_SANITIZE_STRING);
    if (!isset($slotname) || strlen($slotname) === 0) {
        $errors['slotname'] = true;
    }

    if ($date == ""){
        $errors['date'] = true;
    }

    if ($time == ""){
        $errors['time'] = true;
    }


}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $page_title = "Fields";
        include 'includes/metadata.php';
        ?>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <section>
            <div class="steps">
                <nav>
                    <ul>
                        <li><a href="schedule.php">1. Sheet Information</a></li>
                        <li><a href="fields.php">2. Sheet Fields</a></li>
                        <li><a href="publish.php">3. Publish</a></li>
                    </ul>
                </nav>
            </div>
            <div class="form">
                <h1>Your Sheet</h1>
                <form id="requestform" action="<?=htmlentities($_SERVER['PHP_SELF']);?>" method="post" novalidate>
                    <div class="addition">
                        <fieldset>
                            <legend>How are you adding slots?</legend>
                                <div>
                                    <input for="one_time" name="slots" type="radio"
                                    value="A" checked />
                                    <label for="one_time">One at a time, providing name, date and time</label>
                                </div>
                                <div>
                                    <input for="at_once" name="slots" type="radio"
                                    value="B" />
                                    <label for="at_once">Add a number of slots at a time, with start and end time</label>
                                </div>
                        </fieldset>
                    </div>
                    <div class="slots">
                        <table>
                            <thead>
                            <tr>
                                <th>Slot Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Slots</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input for="slot_name" name="slot_name" type="text"
                                        placeholder="Name(required)" required />
                                    </td>
                                    <td>
                                        <input for="date" name="date" type="date"
                                        min="2021-07-27T00-00" max="2022-07-28T00-00" />
                                    </td>
                                    <td>
                                        <input for="time" name="time" type="time"
                                        min="00:00" max="23:00" />
                                    </td>
                                    <td>
                                        <select for="number_slots" name="number_slots" class="select-css" >
                                        <option value="">Choose One</option>
                                        <!-- <?php foreach ($stmt as $row): ?>
                                            <option value="<?=$row['ID']?>" <?=$number_slots == $row['ID']
                                            ? 'selected' : ''?>><?=$row['item']?></option>
                                            <?php endforeach?> -->
                                    </td>
                                    <td><i class="fa fa-minus-circle" aria-hidden="true"></i></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input for="slot_name" name="slot_name" type="text"
                                        placeholder="Name(required)" required />
                                    </td>
                                    <td>
                                        <input for="date" name="date" type="date"
                                        min="2021-07-27T00-00" max="2022-07-28T00-00" />
                                    </td>
                                    <td>
                                        <input for="time" name="time" type="time"
                                        min="00:00" max="23:00" />
                                    </td>
                                    <td>
                                        <select for="number_slots" name="number_slots" class="select-css" >
                                            <option value="">Choose One</option>
                                        <!--<?php foreach ($stmt as $row): ?>
                                            <option value="<?=$row['ID']?>" <?=$number_slots == $row['ID']
                                            ? 'selected' : ''?>><?=$row['item']?></option>
                                            <?php endforeach?> -->
                                    </td>
                                    <td><i class="fa fa-minus-circle" aria-hidden="true"></i></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input for="slot_name" name="slot_name" type="text"
                                        placeholder="Name(required)" required />
                                    </td>
                                    <td>
                                        <input for="date" name="date" type="date"
                                        min="2021-07-27T00-00" max="2022-07-28T00-00" />
                                    </td>
                                    <td>
                                        <input for="time" name="time" type="time"
                                        min="00:00" max="23:00" />
                                    </td>
                                    <td>
                                        <select for="number_slots" name="number_slots" class="select-css" >
                                            <option value="">Select</option>
                                            <!-- <?php for ($i = 2; $i <= 10; $i++){ ?>
                                                <option value="<?php echo $i;?>" <?=$numberofslots == $i
                                            ? 'selected' : ''?>><?php echo $i;?></option>
                                            <?php }?> -->
                                    </td>
                                    <td><i class="fa fa-minus-circle" aria-hidden="true"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="add">
                        <i class="fa fa-plus-circle" aria-hidden="true"> More Slots</i>
                        <!-- add javascript for add -->
                        <button id="save" name="save">Save Slots</button>
                    </div>
                </form>
            </div>
        </section>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>