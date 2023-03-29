<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'ime' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
            'prezime' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            )
        ));

        if($validation->passed()) {
            // update
            try {
                $user->update(User_type($user->permissionLevel()), array(
                    'ime' => Input::get('ime'),
                    'prezime' => Input::get('prezime')
                ));
                Session::flash('home', 'Your details have been updated.');
                Redirect::to('index.php');
            } catch(Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}

?>

<form action="" method="post">
    <div class="field">
        <label for="ime">Ime</label>
        <input type="text" name="ime" value="<?php echo escape($user->data()->ime); ?>">
    </div>
    <div class="field">
        <label for="prezime">Prezime</label>
        <input type="text" name="prezime" value="<?php echo escape($user->data()->prezime); ?>">
    </div>
    <input type="submit" value="Update">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>