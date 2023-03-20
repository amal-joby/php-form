<?php
	session_start();
	session_unset();
	session_destroy();
	header('Location: /login-dir/php-forum/index.php?logout=true');
?>