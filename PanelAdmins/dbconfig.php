<?php
    $host ="localhost";
    $db_log = "psychology";
    $db_pass = "hkv70c05nnXcNFYf";
    $db_name = "psy";
    global $db;
    $db = mysqli_connect($host, $db_log, $db_pass, $db_name) or die(mysqli_error($db));
?>