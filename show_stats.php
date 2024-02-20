<?php

mysqli_query ($db, 'set character_set_results = "utf8"');

$res = mysqli_query($db, "SELECT `views`, `hosts` FROM `visits` WHERE `date`='$date'");
$row = mysqli_fetch_assoc($res);

