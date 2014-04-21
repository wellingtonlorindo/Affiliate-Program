<?php
	session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	require_once('../../../wp-load.php');

	if (wp_insert_user($_POST)) {
		if (empty($_POST['ID'])) {
			$_SESSION['affPInfo'] = "We've sent an email to ".$_POST['user_email'];
			$_SESSION['affPInfo'] .= "<br /> In the email you'll find a link that when clicked on will bring";
			$_SESSION['affPInfo'] .= " back to the site so you can start using your account. <br /> ";
		} else {
			$_SESSION['affPSuccess'] = 'Updated with success.';
		}
		
		header('Location:'.$_SERVER['HTTP_REFERER']);

	} else {
		$_SESSION['affPError'] = 'An error has occurred. Please, try again.';
	}
	