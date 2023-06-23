<?php
declare(strict_types=1);
require_once 'core/init.php';
$db = DB::getInstance();
$user = new User();
$marka = "%" . strtolower(Input::get('marka')) . "%";
$model = "%" . strtolower(Input::get('model')) . "%";
$pogon = "%" . strtolower(Input::get('pogon')) . "%";
$menjac = "%" . strtolower(Input::get('menjac')) . "%";
$gorivo = "%" . strtolower(Input::get('gorivo')) . "%";

$godiste_od = !empty(Input::get('godiste_od')) ? Input::get('godiste_od') : PHP_INT_MIN;
$godiste_do = !empty(Input::get('godiste_do')) ? Input::get('godiste_do') : PHP_INT_MAX;
$kilometraza_od = !empty(Input::get('kilometraza_od')) ? Input::get('kilometraza_od') : PHP_INT_MIN;
$kilometraza_do = !empty(Input::get('kilometraza_do')) ? Input::get('kilometraza_do') : PHP_INT_MAX;
$cena_od = !empty(Input::get('cena_od')) ? Input::get('cena_od') : PHP_INT_MIN;
$cena_do = !empty(Input::get('cena_do')) ? Input::get('cena_do') : PHP_INT_MAX;
$kubikaza_od = !empty(Input::get('kubikaza_od')) ? Input::get('kubikaza_od') : PHP_INT_MIN;
$kubikaza_do = !empty(Input::get('kubikaza_do')) ? Input::get('kubikaza_do') : PHP_INT_MAX;
$snaga_od = !empty(Input::get('snaga_od')) ? Input::get('snaga_od') : PHP_INT_MIN;
$snaga_do = !empty(Input::get('snaga_do')) ? Input::get('snaga_do') : PHP_INT_MAX;

$sql = "SELECT * FROM oglasi WHERE admin_id is NOT NULL";

$bindings = [];

if (!empty($marka)) {
  $sql .= " AND LOWER(marka) LIKE ?";
  $bindings[] = $marka;
}

if (!empty($model)) {
  $sql .= " AND LOWER(model) LIKE ?";
  $bindings[] = $model;
}

$sql .= " AND godiste BETWEEN ? AND ?";
$bindings[] = $godiste_od;
$bindings[] = $godiste_do;

$sql .= " AND kilometraza BETWEEN ? AND ?";
$bindings[] = $kilometraza_od;
$bindings[] = $kilometraza_do;

$sql .= " AND cena BETWEEN ? AND ?";
$bindings[] = $cena_od;
$bindings[] = $cena_do;

if (!empty($pogon)) {
  $sql .= " AND LOWER(pogon) LIKE ?";
  $bindings[] = $pogon;
}

if (!empty($menjac)) {
  $sql .= " AND LOWER(menjac) LIKE ?";
  $bindings[] = $menjac;
}

if (!empty($gorivo)) {
  $sql .= " AND LOWER(gorivo) LIKE ?";
  $bindings[] = $gorivo;
}

$sql .= " AND kubikaza BETWEEN ? AND ?";
$bindings[] = $kubikaza_od;
$bindings[] = $kubikaza_do;

$sql .= " AND snaga BETWEEN ? AND ?";
$bindings[] = $snaga_od;
$bindings[] = $snaga_do;

// Execute the prepared SQL statement
$oglasi = $db->query($sql, $bindings)->results();
require_once 'navbar.php';
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
                <form method="GET">
                    <input type="text" placeholder="Marka" name="marka" class="search-input" value="<?php echo Input::get('marka', ''); ?>" />
                    <input type="text" placeholder="Model" name="model" class="search-input" value="<?php echo Input::get('model', ''); ?>" />
                    <input type="text" placeholder="Godste od" name="godiste_od" class="search-input" value="<?php echo Input::get('godiste_od', ''); ?>" />
                    <input type="text" placeholder="Godste do" name="godiste_do" class="search-input" value="<?php echo Input::get('godiste_do', ''); ?>" />
                    <input type="text" placeholder="Kilometraza od" name="kilometraza_od" class="search-input" value="<?php echo Input::get('kilometraza_od', ''); ?>" />
                    <input type="text" placeholder="Kilometraza do" name="kilometraza_do" class="search-input" value="<?php echo Input::get('kilometraza_do', ''); ?>" />
                    <input type="text" placeholder="Cena od" name="cena_od" class="search-input" value="<?php echo Input::get('cena_od', ''); ?>" />
                    <input type="text" placeholder="Cena do" name="cena_do" class="search-input" value="<?php echo Input::get('cena_do', ''); ?>" />
                    <select id="gorivo" name="gorivo">
                        <option value="Dizel" <?php if (Input::get('gorivo') === 'Dizel') echo 'selected'; ?>>Dizel</option>
                        <option value="Benzin" <?php if (Input::get('gorivo') === 'Benzin') echo 'selected'; ?>>Benzin</option>
                        <option value="Benzin + Gas (TNG)" <?php if (Input::get('gorivo') === 'Benzin + Gas (TNG)') echo 'selected'; ?>>Benzin + Gas (TNG)</option>
                        <option value="Benzin + Metan (CNG)" <?php if (Input::get('gorivo') === 'Benzin + Metan (CNG)') echo 'selected'; ?>>Benzin + Metan (CNG)</option>
                        <option value="Električni pogon" <?php if (Input::get('gorivo') === 'Električni pogon') echo 'selected'; ?>>Električni pogon</option>
                        <option value="Hibridni pogon" <?php if (Input::get('gorivo') === 'Hibridni pogon') echo 'selected'; ?>>Hibridni pogon</option>
                    </select>
                    <select id="pogon" name="pogon">
                        <option value="Prednji" <?php if (Input::get('pogon') === 'Prednji') echo 'selected'; ?>>Prednji</option>
                        <option value="Zadnji" <?php if (Input::get('pogon') === 'Zadnji') echo 'selected'; ?>>Zadnji</option>
                        <option value="4x4" <?php if (Input::get('pogon') === '4x4') echo 'selected'; ?>>4x4</option>
                    </select>
                    <select id="menjac" name="menjac">
                        <optgroup label="Manuelni menjač">
                            <option value="Manuelni 1 brzina" <?php if (Input::get('menjac') === 'Manuelni 1 brzina') echo 'selected'; ?>>1 brzina</option>
                            <option value="Manuelni 2 brzina" <?php if (Input::get('menjac') === 'Manuelni 2 brzina') echo 'selected'; ?>>2 brzine</option>
                            <option value="Manuelni 3 brzina" <?php if (Input::get('menjac') === 'Manuelni 3 brzina') echo 'selected'; ?>>3 brzine</option>
                            <option value="Manuelni 4 brzina" <?php if (Input::get('menjac') === 'Manuelni 4 brzina') echo 'selected'; ?>>4 brzina</option>
                            <option value="Manuelni 5 brzina" <?php if (Input::get('menjac') === 'Manuelni 5 brzina') echo 'selected'; ?>>5 brzina</option>
                            <option value="Manuelni 6 brzina" <?php if (Input::get('menjac') === 'Manuelni 6 brzina') echo 'selected'; ?>>6 brzina</option>
                        </optgroup>
                        <optgroup label="Automatski menjač">
                            <option value="Automatski 1 brzina" <?php if (Input::get('menjac') === 'Automatski 1 brzina') echo 'selected'; ?>>1 brzina</option>
                            <option value="Automatski 2 brzina" <?php if (Input::get('menjac') === 'Automatski 2 brzina') echo 'selected'; ?>>2 brzine</option>
                            <option value="Automatski 3 brzina" <?php if (Input::get('menjac') === 'Automatski 3 brzina') echo 'selected'; ?>>3 brzine</option>
                            <option value="Automatski 4 brzina" <?php if (Input::get('menjac') === 'Automatski 4 brzina') echo 'selected'; ?>>4 brzina</option>
                            <option value="Automatski 5 brzina" <?php if (Input::get('menjac') === 'Automatski 5 brzina') echo 'selected'; ?>>5 brzina</option>
                            <option value="Automatski 6 brzina" <?php if (Input::get('menjac') === 'Automatski 6 brzina') echo 'selected'; ?>>6 brzina</option>
                        </optgroup>
                    </select>
                    <input type="text" placeholder="Kubikaza od" name="kubikaza_od" class="search-input" value="<?php echo Input::get('kubikaza_od', ''); ?>" />
                    <input type="text" placeholder="Kubikaza do" name="kubikaza_do" class="search-input" value="<?php echo Input::get('kubikaza_do', ''); ?>" />
                    <input type="text" placeholder="Snaga od" name="snaga_od" class="search-input" value="<?php echo Input::get('snaga_od', ''); ?>" />
                    <input type="text" placeholder="Snaga do" name="snaga_do" class="search-input" value="<?php echo Input::get('snaga_do', ''); ?>" />
                    <button type="submit" class="login-btn">Pretraži</button>
                </form>
                <form method="POST" action="save-search.php">
                <input type="hidden" name="marka" value="<?php echo Input::get('marka', ''); ?>" />
                <input type="hidden" name="model" value="<?php echo Input::get('model', ''); ?>" />
                <input type="hidden" name="godiste_od" value="<?php echo Input::get('godiste_od', ''); ?>" />
                <input type="hidden" name="godiste_do" value="<?php echo Input::get('godiste_do', ''); ?>" />
                <input type="hidden" name="kilometraza_od" value="<?php echo Input::get('kilometraza_od', ''); ?>" />
                <input type="hidden" name="kilometraza_do" value="<?php echo Input::get('kilometraza_do', ''); ?>" />
                <input type="hidden" name="cena_od" value="<?php echo Input::get('cena_od', ''); ?>" />
                <input type="hidden" name="cena_do" value="<?php echo Input::get('cena_do', ''); ?>" />
                <input type="hidden" name="gorivo" value="<?php echo Input::get('gorivo', ''); ?>" />
                <input type="hidden" name="pogon" value="<?php echo Input::get('pogon', ''); ?>" />
                <input type="hidden" name="menjac" value="<?php echo Input::get('menjac', ''); ?>" />
                <input type="hidden" name="kubikaza_od" value="<?php echo Input::get('kubikaza_od', ''); ?>" />
                <input type="hidden" name="kubikaza_do" value="<?php echo Input::get('kubikaza_do', ''); ?>" />
                <input type="hidden" name="snaga_od" value="<?php echo Input::get('snaga_od', ''); ?>" />
                <input type="hidden" name="snaga_do" value="<?php echo Input::get('snaga_do', ''); ?>" />
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                <?php 
                if(Input::exists('get'))
                 echo '<button type="submit" class="login-btn">Sacuvaj pretragu</button>';
                ?>
                </form>
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
                    else {
                        echo "Nema oglasa";
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