<?php

session_start();
unset($_SESSION['user_loginid']);
unset($_SESSION['user_nid']);
unset($_SESSION['user_name']);
unset($_SESSION['user_email']);
unset($_SESSION['discountvalue']);
unset($_SESSION['discountmsg']);
unset($_SESSION['discountcode']);
unset($_SESSION["discounttype"]);
unset($_SESSION["current_ship_country"]);
header("location:".$glob['rootRel']);

?>

