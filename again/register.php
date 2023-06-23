<?php
declare(strict_types=1);
require_once 'core/init.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check(
            $_POST, array(
            'ime' => array(
                'required' => true,
                'min' => 2,
                'max' => 40,
            ),
            'prezime' => array(
                'required' => true,
                'min' => 2,
                'max' => 40,
            ),
            'email' => array(
                'required' => true,
                'min' => 5,
                'max' => 80,
                'unique' => 'korisnik'
            ),
            'password' => array(
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
            'datum_rodjenja' => array(
                'required' => true,
                'min' => 2,
                'max' => 40,
            ),
            'grad' => array(
                'required' => true,
                'min' => 2,
                'max' => 40,
            ),
            'mobilni' => array(
                'required' => true,
                'min' => 2,
                'max' => 40,
            ),
            )
        );
        
        if ($validation->passed()) {
            $user = new User();

            try {
                $user->create('korisnik', array(
                    'email' => Input::get('email'),
                    'password' => password_hash(Input::get('password'), PASSWORD_BCRYPT),
                    'ime' => Input::get('ime'),
                    'prezime' => Input::get('prezime'),
                    'mobilni' => Input::get('mobilni'),
                    'grad' => Input::get('grad'),
                    'datum_rodjenja' => Input::get('datum_rodjenja'), //TODO:FIXXXXXXXXXXXX
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
require_once 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/register.css">
        <title>UsedCars | Registracija</title>
        <link rel="icon" type="image/x-icon" href="./images/icons/car-icon.png">
    </head>
    <body>
        <section class="sign-in">
            <h1>Popunite podatke za registraciju:</h1>
            <form action="" method="post" class="form">
                <div class="form-item">
                    <label for="ime"><b>Ime</b></label>
                    <input type="text" name="ime" required>
                </div>
                <div class="form-item">
                    <label for="prezime"><b>Prezime</b></label>
                    <input type="text" name="prezime" required>
                </div>
                <div class="form-item">
                    <label for="email"><b>Email adresa</b></label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-item">
                    <label for="password"><b>Šifra</b></label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-item">
                    <label for="password_again"><b>Ponovi Šifru</b></label>
                    <input type="password" name="password_again" required>
                </div>
                <div class="form-item">
                    <label for="datum_rodjenja"><b>Datum rođenja</b></label>
                    <input type="text" name="datum_rodjenja" required>
                </div>
                <div class="form-item">
                    <label for="grad"><b>Grad</b></label>
                    <input type="text" name="grad" required>
                </div>
                <div class="form-item">
                    <label for="mobilni"><b>Mobilni telefon</b></label>
                    <input type="text" name="mobilni" id="mobilni" required>
                </div>
                <input type="hidden" value="<?php echo Token::generate(); ?>"  name="token" class="box"/>
                <button type="submit" class="login-btn form-btn">Registruj se</button>
            </form>
            <div class="links">
                <a href="index.php" class="link-back">Nazad na početnu stranicu</a>
                <a href="#" class="link-back">Vodič za nove korisnike</a>
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
        <footer>
            <div class="logo">
                <img src="./images/icons/car-icon.png" alt="Yellow car icon that is part of the logo">
                <span class="yellow">Used</span>
                <span class="white">Cars</span>
            </div>
            <div class="contact">
                <div class="contact-info">
                    <a href="#">Oglasi</a>
                    <a href="#">Cene</a>
                    <a href="login.php" class="login-btn">Prijavi se</a>
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