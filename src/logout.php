<?php
session_start();
session_destroy();
header('Location: /se/login');
exit();
 ?>