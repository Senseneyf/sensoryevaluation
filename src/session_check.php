<?php 
session_start();
/*if the session username hasn't been set, redirect to the login page*/
if(!isset($_SESSION['username'])){ 
	header("Location: /login"); 
} 
?>
