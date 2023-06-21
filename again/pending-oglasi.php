<?php
declare(strict_types=1);
require_once 'core/init.php';

$user = new User();
if ($user->permissionLevel()!=2) {
    Redirect::to('index.php');
}

$db = DB::getInstance();
$oglasi_query = $db->query("SELECT * FROM `oglasi` WHERE admin_id is NULL");
if (!Input::exists('get')) {
    $trenutna_strana = 1;
} else {
    $trenutna_strana = (int) Input::get('strana');
}
$broj_oglasa = $oglasi_query->count();
$oglasi = $db->query('SELECT * FROM oglasi WHERE admin_id is NULL limit ? , ?', array(($trenutna_strana - 1) * 10, 10))->results();
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
        <script>
        function odobriOglas(id){
        var odgovor=confirm("Odobravanje oglasa: Da li ste sigurni?");
        if (odgovor)
        window.location = "odobri_oglas.php?id="+id;
        return false;
        }
        </script>
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
            <h1 id="oglasi">Oglasi na cekanju</h1>
            <table id="pending-oglasi">
                <tr>
                  <th data-column-name="Marka">Marka</th>
                  <th data-column-name="Model">Model</th>
                  <th data-column-name="Godiste">Godiste</th>
                  <th data-column-name="Korisnik">Korisnik</th>
                  <th data-column-name="Potvrdi">Potvrdi</th>
                </tr>
                <?php
                if (count($oglasi) > 0) {
                    foreach ($oglasi as $oglas) {
                        $korisnik = $db->get('korisnik', array('korisnik_id', '=', $oglas->korisnik_id))->first();
                        $link = "oglas.php?id=" . strval($oglas->oglas_id);
                        echo '<tr>';
                        echo '<td data-column-name="Marka">' . $oglas->marka . "</td>";
                        echo '<td data-column-name="Model">' . $oglas->marka . "</td>";
                        echo '<td data-column-name="Godiste">' . $oglas->godiste . "</td>";
                        echo '<td data-column-name="Korisnik">' . $korisnik->ime. ' ' . $korisnik->prezime . "</td>";
                        echo "<td data-column-name=\"Potvrdi\"> <button class=\"login-btn\" onclick='return odobriOglas($oglas->oglas_id)'> Potvrdi </button></td>";
                        echo '</tr>';
                    }
                }
                ?>
            </table>
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