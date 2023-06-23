<?php
declare(strict_types=1);
require_once 'core/init.php';
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
            <h1 id="oglasi">Sacuvane pretrage</h1>
            <table id="pending-oglasi">
                <tr>
                  <th data-column-name="Marka">Marka</th>
                  <th data-column-name="Tip">Tip</th>
                  <th data-column-name="Godiste">Godiste</th>
                  <th data-column-name="Kilometraza">Kilometraza</th>
                  <th data-column-name="Cena">Cena</th>
                  <th data-column-name="Pogon">Cena</th>
                  <th data-column-name="Menjac">Cena</th>
                  <th data-column-name="Pretrazi"></th>
                  <th data-column-name="Obrisi"></th>
                </tr>
                <tr>
                  <td data-column-name="Marka">Cell 1</td>
                  <td data-column-name="Tip">Cell 2</td>
                  <td data-column-name="Godiste">Cell 3</td>
                  <td data-column-name="Kilometraza">Cell 4</td>
                  <td data-column-name="Cena">Cell 4</td>
                  <td data-column-name="Pogon">Cell 4</td>
                  <td data-column-name="Menjac">Cell 4</td>
                  <td data-column-name="Pretrazi"><button class="login-btn">Pretrazi</button></td>
                  <td data-column-name="Obrisi"><button class="login-btn">Obrisi</button></td>
                </tr>
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