<?php

	// Totally clean-up session values
	session_save_path("temp");
	session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
	
	// Go to login page with clean session
	header("Location: index.php");
	exit;
?>