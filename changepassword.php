<?php 
declare(strict_types=1);
require_once 'core/init.php';

$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
if (Input::exists()) {
        // echo 'OK!'; validate stuff
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'password_current' => array(
            'required' => true,
            'min' => 6
        ),
        'password_new' => array(
            'required' => true,
            'min' => 6
        ),
        'password_new_again' => array(
            'required' => true,
            'min' => 6,
            'matches' => 'password_new'
        )
    ));

    if ($validation->passed()) {
        // change password
        if (!password_verify(Input::get('password_current'), $user->data()->password)) {
            echo 'Your current password is wrong.';
        } else {
            $table = User_type($user->permissionLevel());
            $user->update(
                $table,
                array(
                'password' => password_hash(Input::get('password_new'), PASSWORD_BCRYPT)
                )
            );
            Session::flash('home', 'Your password has been changed!');
            Redirect::to('profil.php');
        }
    } else {
        foreach ($validation->errors() as $error) {
            echo $error, '<br>';
        }
    }
}


?>