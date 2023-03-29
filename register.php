<?php 
require_once 'core/init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'email' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'korisnik'
            ),
            'password' => array(
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            )
        ));
        
        if ($validation->passed()) {
            $user = new User();

            try {
                $user->create('korisnik', array(
                    'email' => Input::get('email'),
                    'password' => password_hash(Input::get('password'), PASSWORD_BCRYPT)
                ));
                Session::flash('home', 'You have been registered and can now log in!');
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
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off" />
    </div>
    
    <div class="field">
        <label for="password">Choose a password</label>
        <input type="password" id="password" name="password" />
    </div>
    
    <div class="field">
        <label for="password_again">Enter your password again</label>
        <input type="password" id="password_again" name="password_again" />
    </div>
    
    <input type="hidden" value="<?php echo Token::generate(); ?>"  name="token"/>
    <input type="submit" value="Register" />
    
</form>