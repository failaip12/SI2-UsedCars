<?php
declare(strict_types=1);
require_once 'core/init.php';

$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
if (Input::exists()) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'old_password' => array(
            'required' => true,
            'min' => 6
        ),
        'new_password' => array(
            'required' => true,
            'min' => 6
        ),
        'new_password_again' => array(
            'required' => true,
            'min' => 6,
            'matches' => 'new_password'
        )
    ));

    if ($validation->passed()) {
        // change password
        if (!password_verify(Input::get('old_password'), $user->data()->password)) {
            echo 'Your current password is wrong.';
        } else {
            $table = User_type($user->permissionLevel());
            $user->update(
                $table,
                array(
                'password' => password_hash(Input::get('new_password'), PASSWORD_BCRYPT)
                )
            );
            Session::flash('home', 'Your password has been changed!');
            Redirect::to('change-password.php');
        }
    } else {
        foreach ($validation->errors() as $error) {
            echo $error, '<br>';
        }
    }
}
require_once 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/single-ad.css">
        <title>UsedCars | Oglas</title>
        <link rel="icon" type="image/x-icon" href="./images/icons/car-icon.png">
        <script src="js/index.js" defer></script>
    </head>
    <body>
        <main>
            <section class="profilepage">
                
                <div class="info">
                    <h2>Promena sifre</h2>
                    <form action="change-password.php" method="post">
                        <ul>
                            <li>
                                <label for="old_password">Stara sifra:</label>
                                <input type="password" id="old_password" name="old_password">
                            </li>
                            <li>
                                <label for="new_password">Nova sifra:</label>
                                <input type="password" id="new_password" name="new_password">
                            </li>
                            <li>
                                <label for="new_password_again">Nova sifra ponovo:</label>
                                <input type="password" id="new_password_again" name="new_password_again">
                            </li>
                            <li>
                                <input type="submit" value="Change">
                            </li>
                        </ul>
                    </form>

                </div>
            </section>
            <section class="guide">
                <div class="guide-desc">
                    <h1 class="guide-title">Kako izabrati najbolji automobil za Vas?</h1>
                    <p>Na šta sve treba obratiti pažnju pri kupovini automobila, koji detalji su najvažniji? Pročitajte naš <a
                            href="#">vodič</a> pre Vaše prve kupovine!</p>
                </div>
                <img src="./images/icons/shopping_cart.png" alt="Shopping cart icon">
            </section>
        </main>
        <footer>
            <div class="logo">
                <!-- <img src="./images/icons/car-icon.png" alt="Yellow car icon that is part of the logo"> -->
                <span class="pink">Used</span>
                <span class="grey">Cars</span>
            </div>
            <div class="contact">
                <div class="contact-info">
                    <a href="#">Oglasi</a>
                    <a href="#">Cene</a>
                </div>
                <div class="contact-sections">
                    <div class="contact-section">
                        <h2>Kompanija</h2>
                        <a href="#">Iskustva korisnika</a>
                        <a href="#">O nama</a>
                        <a href="#">Kontakt</a>
                    </div>
                    <div class="contact-section">
                        <h2>Pomoć</h2>
                        <a href="#">Podrška</a>
                        <a href="#">Blog</a>
                    </div>
                </div>
            </div>
            <p>©2022 UsedCars.com, sva prava zadržana.</p>
        </footer>
    </body>
</html>