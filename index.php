<?php
require_once 'core/init.php';

// flash a message if exists // 
if (Session::exists('home')) {
    echo '<p>'.Session::flash('home').'</p>';
}

$user = new User();
// echo '<pre>';
// print_r($user);
// echo '</pre>';
echo '<a href="oglasi.php">Oglasi</a>';
if($user->isLoggedIn()) {
    echo 'Logged In';
    ?>
        <p>Hello <a href="profile.php?user=<?php echo escape($user->data()->email); ?>">
            <?php echo escape($user->data()->email); ?></a>!</p>

        <ul>
            <li><a href="dodajoglas.php">Dodaj oglas</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="update.php">Update</a></li>
            <li><a href="changepassword.php">Change Password</a></li>
        </ul>
    <?php

    if($user->permissionLevel()==2) {
        echo '<p>You are an admin.</p>';
    }

} else {
    echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register</a>.</p>';
}

?>