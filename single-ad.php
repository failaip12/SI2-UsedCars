<?php
declare(strict_types=1);
require_once __DIR__ . '/core/init.php';
if (!Input::exists('get')) {
    Redirect::to('index.php');
}
$user = new User();
$oglas_id = Input::get('id');
$db = DB::getInstance();
$oglas = $db->query('SELECT * FROM oglasi WHERE oglas_id = ?', array($oglas_id))->first();
if (!$oglas->admin_id)
{
    if (!$user->isLoggedIn())
    {
        Redirect::to(404);
    }
    else
    {
        if ($user->permissionLevel() == 1)
        {
            if ($oglas->korisnik_id != $user->data()->korisnik_id)
            {
                Redirect::to(404);
            }
        }
        elseif ($user->permissionLevel() != 2)
        {
            Redirect::to(404);
        }
    }
}

$slike = $db->query('SELECT hash FROM slika s JOIN oglas_ima_sliku os ON os.slika_id=s.slika_id JOIN oglasi o ON o.oglas_id = os.oglas_id WHERE o.oglas_id = ?', array($oglas_id))->results();
$prodavac = $db->get('korisnik', array('korisnik_id', '=', $oglas->korisnik_id))->first();
require_once __DIR__ . '/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/single-ad.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <title>UsedCars | Oglas</title>
    <link rel="icon" type="image/x-icon" href="./images/icons/car-icon.png">
    <script src="js/index.js" defer></script>
    <script src="js/single-ad.js" defer></script>
    <style>
        .swiper-container {
            width: 100%;
            height: 100vh; /* Adjust the height as needed */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
    </style>
</head>
<body>
<main>
    <section class="ad">
        <h1><?php echo escape($oglas->naslov) ?></h1>

        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                if (!empty($slike)) {
                    foreach ($slike as $slika) {
                        echo '<div class="swiper-slide"><img src="./slike_oglasa/'. $slika->hash .'"></div>';
                    }
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <div class="ad-info">
            <h2>Opšte informacije</h2>
            <ul>
                <li>
                    <p>Marka: </p>
                    <p><?php echo escape($oglas->marka) ?></p>
                </li>
                <li>
                    <p>Model: </p>
                    <p><?php echo escape($oglas->marka) ?></p>
                </li>
                <li>
                    <p>Godište: </p>
                    <p><?php echo $oglas->godiste ?>.</p>
                </li>
                <li>
                    <p>Kilometraža: </p>
                    <p><?php echo $oglas->kilometraza ?> km</p>
                </li>
                <li>
                    <p>Cena: </p>
                    <p><?php echo $oglas->cena ?> €</p>
                </li>
                <li>
                    <p>Gorivo: </p>
                    <p><?php echo escape($oglas->gorivo) ?></p>
                </li>
                <li>
                    <p>Kubikaža:</p>
                    <p><?php echo $oglas->kubikaza ?> cm<sup>3</sup></p>
                </li>
                <li>
                    <p>Snaga motora: </p>
                    <p><?php echo $oglas->snaga ?> kW</p>
                </li>
                <li>
                    <p>Vrsta pogona:</p>
                    <p><?php echo escape($oglas->pogon) ?></p>
                </li>
                <li>
                    <p>Vrsta menjača: </p>
                    <p><?php echo escape($oglas->menjac) ?></p>
                </li>
                <li>
                    <p>Broj vrata: </p>
                    <p><?php echo escape($oglas->broj_vrata) ?></p>
                </li>
                <li>
                    <p>Broj vrata: </p>
                    <p><?php echo $oglas->broj_sedista ?></p>
                </li>
            </ul>
        </div>
        <div class="ad-desc">
            <h2>Opis vozila</h2>
            <p><?php echo escape($oglas->opis_oglasa) ?></p>
        </div>
        <div class="user">
            <h2>Informacije o prodavcu</h2>
            <div class="user-info">
                <div class="user-basic">
                    <img src="./images/cvrle.jpg" alt="Profile picture of the user">
                    <h3><?php echo escape($prodavac->ime).' '.escape($prodavac->prezime) ?></h3>
                </div>
                <p class="user-city"><?php echo escape($prodavac->grad) ?></p>
                <p>Broj telefona: <?php echo escape($prodavac->mobilni) ?></p>
            </div>
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
                <img src="./images/icons/car-icon.png" alt="Car icon that is part of the logo">
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
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper('.swiper-container', {
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        </script>
    </body>
</html>