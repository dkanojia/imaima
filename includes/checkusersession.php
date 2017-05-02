<?php
session_start();
if(!isset($_SESSION["userid"]) || !isset($_SESSION["usernid"]))
{
header("location:".$glob['rootRel']."index.php");
}
?>