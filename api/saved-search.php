<?php
declare(strict_types=1);
require_once 'core/init.php';
$user = new User();
if (!$user->isLoggedIn() || $user->permissionLevel()==2) {
    Redirect::to('index.php');
}
$db = DB::getInstance();
$pretrage = $db->get('pretraga', array('korisnik_id', '=', $user->data()->korisnik_id))->results();
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
        <script>
        function obrisiPretragu(id){
        var odgovor=confirm("Brisanje pretrage: Da li ste sigurni?");
        if (odgovor)
        window.location = "obrisi_pretragu.php?id="+id;
        return false;
      }
    </script>
    </head>
    <body>
        <main>
            <h1 id="oglasi">Sacuvane pretrage</h1>
            <table id="pending-oglasi">
                <tr>
                    <th data-column-name="Marka">Marka</th>
                    <th data-column-name="Model">Model</th>
                    <th data-column-name="Godiste od">Godiste od</th>
                    <th data-column-name="Godiste do">Godiste do</th>
                    <th data-column-name="Kilometraza od">Kilometraza od</th>
                    <th data-column-name="Kilometraza do">Kilometraza do</th>
                    <th data-column-name="Cena od">Cena od</th>
                    <th data-column-name="Cena do">Cena do</th>
                    <th data-column-name="Gorivo">Gorivo</th>
                    <th data-column-name="Pogon">Pogon</th>
                    <th data-column-name="Menjac">Menjac</th>
                    <th data-column-name="Kubikaza od">Kubikaza od</th>
                    <th data-column-name="Kubikaza do">Kubikaza do</th>
                    <th data-column-name="Snaga od">Snaga od</th>
                    <th data-column-name="Snaga do">Snaga do</th>
                    <th data-column-name="Pretrazi"></th>
                    <th data-column-name="Obrisi"></th>
                </tr>
                <?php 
                if(count($pretrage) > 0) {
                    foreach ($pretrage as $pretraga) {
                        $marka = $pretraga->marka;
                        $model = $pretraga->model;
                        $godiste_od = $pretraga->godiste_od;
                        $godiste_do = $pretraga->godiste_do;
                        $kilometraza_od = $pretraga->kilometraza_od;
                        $kilometraza_do = $pretraga->kilometraza_do;
                        $cena_od = $pretraga->cena_od;
                        $cena_do = $pretraga->cena_do;
                        $gorivo = $pretraga->gorivo;
                        $pogon = $pretraga->pogon;
                        $menjac = $pretraga->menjac;
                        $kubikaza_od = $pretraga->kubikaza_od;
                        $kubikaza_do = $pretraga->kubikaza_do;
                        $snaga_od = $pretraga->snaga_od;
                        $snaga_do = $pretraga->snaga_do;

                        $searchParams = http_build_query(array(
                            'marka' => $marka,
                            'model' => $model,
                            'godiste_od' => $godiste_od,
                            'godiste_do' => $godiste_do,
                            'kilometraza_od' => $kilometraza_od,
                            'kilometraza_do' => $kilometraza_do,
                            'cena_od' => $cena_od,
                            'cena_do' => $cena_do,
                            'gorivo' => $gorivo,
                            'pogon' => $pogon,
                            'menjac' => $menjac,
                            'kubikaza_od' => $kubikaza_od,
                            'kubikaza_do' => $kubikaza_do,
                            'snaga_od' => $snaga_od,
                            'snaga_do' => $snaga_do,
                        ));

                        $link = 'index.php?' . $searchParams;
                        echo '<tr>';
                        echo '<td data-column-name="Marka">'. $marka .'</td>';
                        echo '<td data-column-name="Model">'. $model .'</td>';
                        echo '<td data-column-name="Godiste od">'. $godiste_od .'</td>';
                        echo '<td data-column-name="Godiste do">'. $godiste_do .'</td>';
                        echo '<td data-column-name="Kilometraza od">'. $kilometraza_od .'</td>';
                        echo '<td data-column-name="Kilometraza do">'. $kilometraza_do .'</td>';
                        echo '<td data-column-name="Cena od">'. $cena_od .'</td>';
                        echo '<td data-column-name="Cena do">'. $cena_do .'</td>';
                        echo '<td data-column-name="Gorivo">'. $gorivo .'</td>';
                        echo '<td data-column-name="Pogon">'. $pogon .'</td>';
                        echo '<td data-column-name="Menjac">'. $menjac .'</td>';
                        echo '<td data-column-name="Kubikaza od">'. $kubikaza_od .'</td>';
                        echo '<td data-column-name="Kubikaza do">'. $kubikaza_do .'</td>';
                        echo '<td data-column-name="Snaga od">'. $snaga_od .'</td>';
                        echo '<td data-column-name="Snaga do">'. $snaga_do .'</td>';
                        echo '<td data-column-name="Pretrazi"><a href="'. $link .'"><button class="login-btn">Pretrazi</button></td></a>';
                        echo '<td data-column-name="Obrisi"><button class="login-btn" onclick=\'return obrisiPretragu(' .$pretraga->pretraga_id .')\'>Obrisi</button></td>';
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