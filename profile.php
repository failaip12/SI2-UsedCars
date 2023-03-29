<?php

require_once 'core/init.php';

if(!$email = Input::get('user')) {
	Redirect::to('index.php');
} else {
	$user = new User($email);
	if(!$user->exists()) {
		Redirect::to(404);
	} else {
		// user exists
		$data = $user->data();
	}
	?>
	
	<h3><?php echo escape($data->email); ?></h3>
	<p>Ime i prezime: <?php echo escape($data->ime); echo ' '; echo escape($data->prezime);?></p>

	<?php 
}
?>