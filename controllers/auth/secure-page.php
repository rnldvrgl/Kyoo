<?php
/*
    * For Secure Logins

    ? Redirect Pages here
*/

if ($_SESSION['sid'] === session_id()) {

	$_SESSION['authorized'] = TRUE;

	//  !! Anong mas optimal na way para mag redirect?
	// ? Isang dashboard.php ang gamitin para sa lahat ng user

	// Redirect to the dashboard
	redirect('/dashboard');
} else {
	$_SESSION['authorized'] = FALSE;

	redirect('/404');
}
