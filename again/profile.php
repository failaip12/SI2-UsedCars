<?php
declare(strict_types=1);
require_once 'core/init.php';

$user = new User();
if (!$user->isLoggedIn() || $user->permissionLevel()==2) {
    Redirect::to('index.php');
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