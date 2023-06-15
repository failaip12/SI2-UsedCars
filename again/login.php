<?php
declare(strict_types=1);
require_once 'core/init.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'email' => array('required' => true),
            'password' => array('required' => true)
        ));

        if ($validation->passed()) {
            // Login user
            $user = new User();
            $login = $user->login(Input::get('email'), Input::get('password'));

            if ($login) {
                Redirect::to('index.php');
            } else {
                echo '<p>Sorry, logging in failed';
            }

        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }

    }
}