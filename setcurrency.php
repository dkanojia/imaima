<?php
session_start();
if(isset($_REQUEST["curr"]))
{
	if($_REQUEST["curr"]=="usd" || $_REQUEST["curr"]=="eur" || $_REQUEST["curr"]=="gbp" || $_REQUEST["curr"]=="inr")
	{
		$_SESSION["currency"] = $_REQUEST["curr"];
	}
}
if(isset($_SESSION["current_url"]) && strlen($_SESSION["current_url"])>2)
{
	if(strrpos($_SESSION["current_url"], 'checkout', 0))
	{
	header("location:".$glob['rootRel']."cart.html");
	}
	else
	{
	header("location:".$_SESSION["current_url"]);
	}
}
else
header("location:".$glob['rootRel']);
?>