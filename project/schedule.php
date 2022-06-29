<?php

$errors = array();
$username = $_POST['username'] ?? null;
$sheetname = $_POST['sheetname'] ?? null;
$fullname = $_POST['fullname'] ?? null;
$email = $_POST['email'] ?? null;
$description = $_POST['description'] ?? null;
$changes = $_POST['changes'] ?? null;
$duplicate = $_POST['duplicate'] ?? null;
$stop_date = $_POST['stop'] ?? "";
$start_date = $_POST['start'] ?? null;
$timezone = $_POST['timezone'] ?? null;
$password = $_POST['password'] ?? "";

session_start();

require "includes/library.php";

$pdo = connectDB();

// if (!isset($_SESSION['username'])) {
//     header("Location:login.php");
//     exit();
// }

if (isset($_POST['next'])) {

    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $sheetname = filter_var($sheetname, FILTER_SANITIZE_STRING);
    if (!isset($sheetname) || strlen($sheetname) === 0) {
        $errors['sheetname'] = true;
    }
    $fullname = filter_var($fullname, FILTER_SANITIZE_STRING);
    if (!isset($fullname) || strlen($fullname) === 0) {
        $errors['fullname'] = true;
    }
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!isset($email) || strlen($email) === 0) {
        $errors['email'] = true;
    }
    if (empty($changes)) {
        $errors['changes'] = true;
    }
    if ($stop_date == ""){
        $errors['stop'] = true;
    }
    if ($start_date == ""){
        $errors['start'] = true;
    }
    if ($timezone == ""){
        $errors['timezone'] = true;
    }

    if (count($errors) === 0) {
        $query = "insert into project_alldata values (NULL, NULL,?,?,?,?,?,?,?,?,?,?, NOW())";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $email, $password, $sheetname,
        $description, $changes, $duplicate, $start_date, $stop_date, 
        $timezone]);

        
        header("Location:fields.php");
        exit();
    }
}



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $page_title = "Build your sheet";
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
                <h1>Build a Sign up Sheet</h1>
                <form id="requestform" action="<?=htmlentities($_SERVER['PHP_SELF']);?>" method="post" novalidate>
                    <div>
                        <label for="sheetname">Sheet Name: </label>
                        <input id="sheetname" name="sheetname" type="text" />
                        <span class="error <?=!isset($errors['sheetname']) ? 'hidden' : "";?>"
                        >Please enter a Sheet Name</span>
                    </div>
                    <div>
                        <label for="description">Description: </label>
                        <textarea name="description" id="description" cols="100" rows="10"></textarea>
                    </div>
                    <div>
                        <label for="fullname">Your Name: </label>
                        <input id="fullname" name="fullname" type="text" 
                        placeholder="Jane Doe"/>
                        <span class="error <?=!isset($errors['fullname']) ? 'hidden' : "";?>"
                        >Please enter Your Name</span>
                    </div>
                    <div>
                        <label for="email">Email: </label>
                        <input id="email" name="email" type="text" 
                        placeholder="janedoe@website.com"/>
                        <span class="error <?=!isset($errors['email']) ? 'hidden' : "";?>"
                        >Please enter your email</span>
                    </div>
                    <div class="radio">
                        <fieldset>
                            <legend>Allow users to change results</legend>
                            <div>
                                <input id="yes" name="changes" type="radio" 
                                value="Y"/>
                                <label for="yes">Yes </label>
                            </div>
                            <div>
                                <input id="no" name="changes" type="radio" 
                                value="N"/>
                                <label for="no">No</label>
                            </div>
                        </fieldset>
                        <span class="error <?=!isset($errors['changes']) ? 'hidden' : "";?>"
                        >Please make a choice</span>
                    </div>
                    <div>
                        <fieldset>
                            <legend for="duplicate">Duplicate signups</legend>
                            <div>
                                <input id="duplicate" name="duplicate" type="checkbox"
                                value="D" checked />
                                <label for="duplicate">Only allow one email per signup</label>
                            </div>
                        </fieldset>
                    </div>
                    <div  class="dates">
                        <fieldset>
                            <div>
                                <legend for="start">Accept results on: </legend>
                                    <input id="start" name="start" type="datetime-local" 
                                    min="27-07-2021T00-00" max="28-07-20122T00-00"/>
                            </div>
                        </fieldset>
                            <span class="error <?=!isset($errors['start']) ? 'hidden' : "";?>"
                            >Please select a date and time</span>
                    </div>
                    <div class="dates">
                        <fieldset>
                            <div>
                            <legend for="stop">Stop accepting results on: </legend>
                                <input id="stop" name="stop" type="datetime-local" 
                                min="27-07-2021T00-00" max="28-07-20122T00-00"/>
                            </div>
                        </fieldset>
                        <span class="error <?=!isset($errors['stop']) ? 'hidden' : "";?>"
                        >Please select a date and time</span>
                    </div>
                    <div>
                        <label for="timezone">Your Timezone</label>
                        <select name="timezone" id="timezone" class="select-css">
                            <option value="">Choose One</option>
                            <option timeZoneId="1" gmtAdjustment="GMT-12:00" useDaylightTime="0" value="-12">(GMT-12:00) International Date Line West</option>
                            <option timeZoneId="2" gmtAdjustment="GMT-11:00" useDaylightTime="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
                            <option timeZoneId="3" gmtAdjustment="GMT-10:00" useDaylightTime="0" value="-10">(GMT-10:00) Hawaii</option>
                            <option timeZoneId="4" gmtAdjustment="GMT-09:00" useDaylightTime="1" value="-9">(GMT-09:00) Alaska</option>
                            <option timeZoneId="5" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                            <option timeZoneId="6" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
                            <option timeZoneId="7" gmtAdjustment="GMT-07:00" useDaylightTime="0" value="-7">(GMT-07:00) Arizona</option>
                            <option timeZoneId="8" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                            <option timeZoneId="9" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                            <option timeZoneId="10" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="-6">(GMT-06:00) Central America</option>
                            <option timeZoneId="11" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                            <option timeZoneId="12" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                            <option timeZoneId="13" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="-6">(GMT-06:00) Saskatchewan</option>
                            <option timeZoneId="14" gmtAdjustment="GMT-05:00" useDaylightTime="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                            <option timeZoneId="15" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                            <option timeZoneId="16" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="-5">(GMT-05:00) Indiana (East)</option>
                            <option timeZoneId="17" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                            <option timeZoneId="18" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
                            <option timeZoneId="19" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="-4">(GMT-04:00) Manaus</option>
                            <option timeZoneId="20" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="-4">(GMT-04:00) Santiago</option>
                            <option timeZoneId="21" gmtAdjustment="GMT-03:30" useDaylightTime="1" value="-3.5">(GMT-03:30) Newfoundland</option>
                            <option timeZoneId="22" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Brasilia</option>
                            <option timeZoneId="23" gmtAdjustment="GMT-03:00" useDaylightTime="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
                            <option timeZoneId="24" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Greenland</option>
                            <option timeZoneId="25" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Montevideo</option>
                            <option timeZoneId="26" gmtAdjustment="GMT-02:00" useDaylightTime="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
                            <option timeZoneId="27" gmtAdjustment="GMT-01:00" useDaylightTime="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
                            <option timeZoneId="28" gmtAdjustment="GMT-01:00" useDaylightTime="1" value="-1">(GMT-01:00) Azores</option>
                            <option timeZoneId="29" gmtAdjustment="GMT+00:00" useDaylightTime="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                            <option timeZoneId="30" gmtAdjustment="GMT+00:00" useDaylightTime="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                            <option timeZoneId="31" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                            <option timeZoneId="32" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                            <option timeZoneId="33" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                            <option timeZoneId="34" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                            <option timeZoneId="35" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) West Central Africa</option>
                            <option timeZoneId="36" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Amman</option>
                            <option timeZoneId="37" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                            <option timeZoneId="38" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Beirut</option>
                            <option timeZoneId="39" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Cairo</option>
                            <option timeZoneId="40" gmtAdjustment="GMT+02:00" useDaylightTime="0" value="2">(GMT+02:00) Harare, Pretoria</option>
                            <option timeZoneId="41" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                            <option timeZoneId="42" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Jerusalem</option>
                            <option timeZoneId="43" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Minsk</option>
                            <option timeZoneId="44" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Windhoek</option>
                            <option timeZoneId="45" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                            <option timeZoneId="46" gmtAdjustment="GMT+03:00" useDaylightTime="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                            <option timeZoneId="47" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Nairobi</option>
                            <option timeZoneId="48" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Tbilisi</option>
                            <option timeZoneId="49" gmtAdjustment="GMT+03:30" useDaylightTime="1" value="3.5">(GMT+03:30) Tehran</option>
                            <option timeZoneId="50" gmtAdjustment="GMT+04:00" useDaylightTime="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
                            <option timeZoneId="51" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="4">(GMT+04:00) Baku</option>
                            <option timeZoneId="52" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="4">(GMT+04:00) Yerevan</option>
                            <option timeZoneId="53" gmtAdjustment="GMT+04:30" useDaylightTime="0" value="4.5">(GMT+04:30) Kabul</option>
                            <option timeZoneId="54" gmtAdjustment="GMT+05:00" useDaylightTime="1" value="5">(GMT+05:00) Yekaterinburg</option>
                            <option timeZoneId="55" gmtAdjustment="GMT+05:00" useDaylightTime="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                            <option timeZoneId="56" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
                            <option timeZoneId="57" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                            <option timeZoneId="58" gmtAdjustment="GMT+05:45" useDaylightTime="0" value="5.75">(GMT+05:45) Kathmandu</option>
                            <option timeZoneId="59" gmtAdjustment="GMT+06:00" useDaylightTime="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
                            <option timeZoneId="60" gmtAdjustment="GMT+06:00" useDaylightTime="0" value="6">(GMT+06:00) Astana, Dhaka</option>
                            <option timeZoneId="61" gmtAdjustment="GMT+06:30" useDaylightTime="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
                            <option timeZoneId="62" gmtAdjustment="GMT+07:00" useDaylightTime="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                            <option timeZoneId="63" gmtAdjustment="GMT+07:00" useDaylightTime="1" value="7">(GMT+07:00) Krasnoyarsk</option>
                            <option timeZoneId="64" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                            <option timeZoneId="65" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
                            <option timeZoneId="66" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                            <option timeZoneId="67" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Perth</option>
                            <option timeZoneId="68" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Taipei</option>
                            <option timeZoneId="69" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                            <option timeZoneId="70" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="9">(GMT+09:00) Seoul</option>
                            <option timeZoneId="71" gmtAdjustment="GMT+09:00" useDaylightTime="1" value="9">(GMT+09:00) Yakutsk</option>
                            <option timeZoneId="72" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="9.5">(GMT+09:30) Adelaide</option>
                            <option timeZoneId="73" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="9.5">(GMT+09:30) Darwin</option>
                            <option timeZoneId="74" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="10">(GMT+10:00) Brisbane</option>
                            <option timeZoneId="75" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                            <option timeZoneId="76" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Hobart</option>
                            <option timeZoneId="77" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
                            <option timeZoneId="78" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Vladivostok</option>
                            <option timeZoneId="79" gmtAdjustment="GMT+11:00" useDaylightTime="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                            <option timeZoneId="80" gmtAdjustment="GMT+12:00" useDaylightTime="1" value="12">(GMT+12:00) Auckland, Wellington</option>
                            <option timeZoneId="81" gmtAdjustment="GMT+12:00" useDaylightTime="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                            <option timeZoneId="82" gmtAdjustment="GMT+13:00" useDaylightTime="0" value="13">(GMT+13:00) Nuku'alofa</option>
                        </select> 
                        <span class="error <?=!isset($errors['timezone']) ? 'hidden' : "";?>"
                        >Please make a choice</span>
                    </div>   
                    <button id="next" name="next">Next</button>            
                </form>
            </div>
        </section>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>