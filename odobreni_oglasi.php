<?php
declare(strict_types=1);
require_once __DIR__ . '/core/init.php';

$user = new User();
if ($user->permissionLevel()!=2) {
    Redirect::to('index.php');
}

$db = DB::getInstance();
$oglasi_query = $db->query('SELECT * FROM oglasi WHERE admin_id is NOT NULL')->count();
if (!Input::exists('get')) {
    $trenutna_strana = 1;
} else {
    $trenutna_strana = (int) Input::get('strana');
}


$offset = ($trenutna_strana - 1) * 10;
$oglasi = $db->query('SELECT * FROM oglasi WHERE admin_id is NOT NULL LIMIT 10 OFFSET ?',
    array($offset))->results();

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
        <title>UsedCars | Oglas</title>
        <link rel="icon" type="image/x-icon" href="./images/icons/car-icon.png">
        <script src="js/index.js" defer></script>
        <script src = "js/utils.js"></script>
    </head>
    <body>
        <main>
            <h1 id="oglasi">Oglasi na cekanju</h1>
            <table id="pending-oglasi">
                <tr>
                  <th data-column-name="#">#</th>
                  <th data-column-name="Marka">Marka</th>
                  <th data-column-name="Model">Model</th>
                  <th data-column-name="Godiste">Godiste</th>
                  <th data-column-name="Korisnik">Korisnik</th>
                  <th data-column-name="Obrisi">Obrisi</th>
                </tr>
                <?php
                if (count($oglasi) > 0) {
                    foreach ($oglasi as $index=>$oglas) {
                        $korisnik = $db->get('korisnik', array('korisnik_id', '=', $oglas->korisnik_id))->first();
                        $link = "single-ad.php?id=" . strval($oglas->oglas_id);
                        echo '<tr>';
                        echo '<td data-column-name="#"> <a href="' . $link . '">' . ($index + 1) . '</a></td>';
                        echo '<td data-column-name="Marka">' . $oglas->marka . "</td>";
                        echo '<td data-column-name="Model">' . $oglas->marka . "</td>";
                        echo '<td data-column-name="Godiste">' . $oglas->godiste . "</td>";
                        echo '<td data-column-name="Korisnik">' . $korisnik->ime. ' ' . $korisnik->prezime . "</td>";
                        echo "<td data-column-name=\"Obrisi\"> <button class=\"login-btn\" onclick='return obrisiOglas($oglas->oglas_id)'> Obrisi </button></td>";
                        echo '</tr>';
                    }
                }
                ?>
            </table>
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
    </body>
</html>