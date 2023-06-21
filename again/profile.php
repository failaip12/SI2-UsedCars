<?php
declare(strict_types=1);
require_once 'core/init.php';

$user = new User();
if (!$user->isLoggedIn() || $user->permissionLevel()==2) {
    Redirect::to('index.php');
}
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
        <header>
            <div class="menu">
                <div class="logo">
                    <!-- <img src="./images/icons/car-icon.png" alt="Yellow car icon that is part of the logo"> -->
                    <span class="pink">Used</span>
                    <span class="grey">Cars</span>
                </div>
                <img src="./images/icons/hamburger-icon.png" alt="Hamburger icon" id="hamburger">
            </div>
            <nav id="nav">
                <ul>
                    <li><a href="index.php">Početna</a></li>
                    <li><a href="index.php">Pretraga</a></li>
                    <li><a href="#">Vesti</a></li>
                    <div class="buttons">
                        <li><button class="modal-btn">Prijavi se</button></li>
                        <li><a href="register.php" class="login-btn">Registruj se</a></li>
                    </div>
                </ul>
            </nav>
            <div id="overlay">
                <form action="login.php" method="post" class="login-form" >
                    <div class="login-data">
                        <div class="login-item">
                            <label for="email">E-mail</label>
                            <input type="text" placeholder="E-mail" name="email" required>
                        </div>
                        <div class="login-item">
                            <label for="password">Šifra</label>
                            <input type="password" placeholder="Šifra" name="password" required>
                        </div>
                        <button type="submit" class="login-btn">Uloguj se</button>
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    </div>
                    
                    <div class="close-login">
                        <button type="button" class="cancel-btn">Zatvori</button>
                        <a href="register.php">Nemate svoj nalog? Napravite novi!</a>
                    </div>
                </form>
            </div>
        </header>
        <main>
            <section class="profilepage">
                
                <div class="info">
                    <h2>Opšte informacije</h2>
                    <ul>
                        <li>
                            <p>Ime: </p>
                            <p><?php if($user->data()->ime !== null) echo escape($user->data()->ime); ?></p>
                        </li>
                        <li>
                            <p>Prezime</p>
                            <p><?php if($user->data()->prezime !== null)  echo escape($user->data()->prezime); ?></p>
                        </li>
                        <li>
                            <p>E-mail: </p>
                            <p><?php if($user->data()->email !== null) echo escape($user->data()->email); ?></p>
                        </li>
                        <li>
                            <p>Broj telefona: </p>
                            <p><?php if($user->data()->mobilni !== null)  echo escape($user->data()->mobilni); ?></p>
                        </li>
                       
                    </ul>
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