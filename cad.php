<?php
	session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	require_once('../../../wp-load.php');

	if (!empty($_POST['ID']) && !empty($_POST['user_pass'])) {
		$_POST['user_pass'] = wp_hash_password($_POST['user_pass']);
	}

	if (wp_insert_user($_POST)) {
		if (empty($_POST['ID'])) {
			$param = '?info=ok&email='.$_POST['user_email'];
		} else {
			$param = '?success=ok';
		}

	} else {
		$param = '?danger=ok';
	}
	
	header('Location:'.bloginfo('url').'/registration-affp/'.$param);