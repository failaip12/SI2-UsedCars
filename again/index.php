<?php
declare(strict_types=1);
require_once 'core/init.php';
$db = DB::getInstance();
$oglasi_query = $db->query("SELECT * FROM `oglasi` WHERE admin_id is NULL");
if (!Input::exists('get')) {
    $trenutna_strana = 1;
} else {
    $trenutna_strana = (int) Input::get('strana');
}
$broj_oglasa = $oglasi_query->count();
$oglasi = $db->query('SELECT * FROM oglasi WHERE admin_id is NOT NULL limit ? , ?', array(($trenutna_strana - 1) * 10, 10))->results();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css">
        <title>UsedCars</title>
        <link rel="icon" type="image/x-icon" href="./images/icons/car-icon.png">
        <script src="js/index.js" defer></script>
    </head>
    <body>
        <header>
            <div class="menu">
                <div class="logo">
                    <img src="./images/icons/car-icon.png" alt="Yellow car icon that is part of the logo">
                    <span class="yellow">Used</span>
                    <span class="white">Cars</span>
                </div>
                <img src="./images/icons/hamburger-icon.png" alt="Hamburger icon" id="hamburger">
            </div>
            <nav id="nav">
                <ul>
                    <li><a href="#">Početna</a></li>
                    <li><a href="#">Pretraga</a></li>
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
            <section class="search">
                <h1>Dobrodošli na UsedCars stranicu!</h1>
                <label htmlFor="search-bar">Izaberi kriterijum za pretragu: </label>
                <!-- <select id="search-bar" class="search-select">
                    <option value="marka" default>Marka vozila</option>
                    <option value="tip">Tip vozila</option>
                    <option value="godina">Godina proizvodnje</option>
                    <option value="kilometraza">Pređeni kilometri</option>
                    <option value="cena">Cena</option>
                    <option value="pogon">Vrsta pogona</option>
                    <option value="menjac">Vrsta menjača</option>
                </select> -->
                <div class="search-text">
                    <input type="text" placeholder="Marka" name="marka" class="search-input" />
                    <input type="text" placeholder="Tip" name="tip" class="search-input" />
                    <input type="text" placeholder="Godina" name="godina" class="search-input" />
                    <input type="text" placeholder="Kilometraza" name="kilometraza" class="search-input" />
                    <input type="text" placeholder="Cena" name="cena" class="search-input" />
                    <input type="text" placeholder="Pogon" name="pogon" class="search-input" />
                    <input type="text" placeholder="Menjac" name="menjac" class="search-input" />
                    
                    <button class="login-btn">Pretraži</button>
                </div>
            </section>
            <section class="car-ads">
                <h1>Oglasi</h1>
                <div class="car-ads-grid">
                    <?php
                    if (count($oglasi) > 0) {
                        foreach ($oglasi as $oglas) {
                            $korisnik = $db->get('korisnik', array('korisnik_id', '=', $oglas->korisnik_id))->first();
                            $slika_id = $db->get('oglas_ima_sliku', array('oglas_id', '=', $oglas->oglas_id))->first()->slika_id;
                            $slika_hash = $db->get('slika', array('slika_id', '=', $slika_id))->first()->hash;
                            $link = "single-ad.php?id=" . strval($oglas->oglas_id);
                            echo '<div class="car-ad">';
                                echo '<a href="' . $link . '">';
                                    echo '<img src="slike_oglasa/' . $slika_hash . '" alt="A car">';
                                    echo '<div class="car-desc">';
                                        echo '<div class="car-name-price">';
                                            echo '<h2 class="car-name">' . $oglas->naslov . '</h2>';
                                            echo '<p class="car-price">€' . $oglas->cena . '</p>';
                                        echo '</div>';
                                        echo '<p class="car-details">' . $oglas->gorivo . '(' . $oglas->godiste . ')</p>';
                                    echo '</div>';
                                echo '</a>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </section>
            <section class="guide">
                <div class="guide-desc">
                    <h1 class="guide-title">Kako izabrati najbolji automobil za Vas?</h1>
                    <p>Na šta sve treba obratiti pažnju pri kupovini automobila, koji detalji su najvažniji? Pročitajte naš <a href="#">vodič</a> pre Vaše prve kupovine!</p>
                </div>
                <img src="./images/icons/shopping_cart.png" alt="Shopping cart icon">
            </section>
        </main>
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
                    <a href="register.php" class="login-btn">Prijavi se</a>
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