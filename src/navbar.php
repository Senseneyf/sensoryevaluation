<?php
//the end of url of the current page
$page = $_SERVER['REQUEST_URI'];
$index = 'http://' . $_SERVER['HTTP_HOST'] . '/index';

//My tests
if(preg_match('(index)',$page) === 1){
	echo '<a data-active href="'. $index .'">My Tests</a><a href="/test_type"> Create Test </a>';
}
//Test creation pages
else if(preg_match('(test_edit|test_type)',$page) === 1){
	echo '<a href="'. $index .'">My Tests</a><a data-active href="/test_type"> Create Test </a>';
}
//Admin pages
else if(preg_match('(admin|user_edit|user_create|password_edit)',$page) === 1){
	echo '<a href="'. $index .'">My Tests</a><a href="/test_type"> Create Test </a>';
}
else if(preg_match('(live_test)',$page) === 1){
	echo '<a href="'. $index .'">My Tests</a><a href="/test_type"> Create Test </a>';
}
//Default case
else{
	echo '<a href="'. $index .'">My Tests</a><a href="/test_type"> Create Test </a>';
}

echo '<div class="navLogin">';
//Admin button can be included on all pages
if(isset($_SESSION['username']) && $_SESSION['username'] === "admin"){
	if(preg_match('(admin|user_edit|user_create|password_edit)',$page) === 1){
		echo '<a data-active href="/admin">Admin</a>';
	}
	else{
		echo '<a href="/admin">Admin</a>';
	}
}
echo '<a href="/help.htm"> Help </a>';
//Logout is always avaliable if someone is logged in
if(isset($_SESSION['username'])){
	echo '<a href="/logout" >Logout</a>';
}
echo '</div>';

?>