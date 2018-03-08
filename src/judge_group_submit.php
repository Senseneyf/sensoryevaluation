<?php
if(!empty($_GET['Tests'])) {
	foreach ($_GET['Tests'] as $select){
		echo $select . "<br>";
	}
}
?>