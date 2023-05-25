<?php
declare(strict_types=1);
require_once 'core/init.php';
if (!Input::exists('get')) {
  Redirect::to('index.php');
}
$oglas_id = Input::get('id');
$db = DB::getInstance();
$oglas = $db->get('oglasi', array('oglas_id', '=', $oglas_id))->first();
$slike = $db->query('SELECT hash FROM slika s JOIN oglas_ima_sliku os ON os.slika_id=s.slika_id JOIN oglasi o ON o.oglas_id = os.oglas_id WHERE o.oglas_id = ?', array($oglas_id))->results();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    UsedCars
  </title>
  <!--=============== CSS ===============-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/oglas.css">
  <!--=============== REMIX ICON/BOXICON ===============-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <!--=============== SWIPPER ===============-->
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
</head>

<body>
  <header>
    <div class="nav container">
      <i class='bx bx-menu' id="menu-icon"></i>
      <a href="#" class="logo">Used<span>Cars</span></a>
      <ul class="navbar">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php#poslednje">Poslednje dodato</a></li>
        <li><a href="registracija.php">Registracija</a></li>
        <li><a href="prijava.php">Prijava</a></li>
        <li><a href="index.php#kontakt">Kontakt</a></li>
        <li><a href="profil.php">Profil</a></li>
        <li><a href="postavi-oglas.php">Postavi Oglas</a></li>
      </ul>
      <i class='bx bx-search' id="search-icon" onclick="showDiv('search-box')"></i>
  </header>

  <section class="home" id="home">
    <div class="oglas-container">
      <div class="oglas-column-1">
        <div class="oglas-header">
          <div class="oglas-header-content">
            <h1 class="title"><?php echo escape($oglas->naslov) ?></h1>
            <span class="year"><?php echo $oglas->godiste ?>. godište</span>
          </div>
        </div>

        <div class="swiper-container">
          <div class="swiper image-swiper">
            <div class="swiper-wrapper">
              <?php
                if (!empty($slike)) {
                  foreach ($slike as $slika) {
                    echo '<div class="swiper-slide"><img src="slike_oglasa/'. $slika->hash .'"></div>';
                  }
                }
              ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
          </div>
        </div>

        <div class="info-box">
          <h2>Opšte informacije</h2>
          <div class="info-section-container">
            <div class="info-section">
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Stanje:</div>
                  <div class="info-value">Polovno vozilo</div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Marka</div>
                  <div class="info-value"><?php echo escape($oglas->marka) ?></div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Godište</div>
                  <div class="info-value"><?php $oglas->godiste ?>.</div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Kilometraža</div>
                  <div class="info-value"><?php echo $oglas->kilometraza ?> km</div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Karoserija</div>
                  <div class="info-value"><?php echo escape($oglas->karoserija) ?></div>
                </div>
              </div>
              <div class="divider" style="border-bottom: none">
                <div class="info-entry">
                  <div class="info-label">Gorivo</div>
                  <div class="info-value"><?php echo escape($oglas->gorivo) ?></div>
                </div>
              </div>
            </div>
            <div class="info-section" style="padding-left: 40px">
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Kubikaža</div>
                  <div class="info-value"><?php echo escape($oglas->kubikaza) ?> cm<sup>3</sup></div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Snaga motora</div>
                  <div class="info-value"><?php echo escape($oglas->snaga) ?>/<?php echo escape($oglas->snaga) * 1.36 ?> (kW/KS)</div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Fiksna cena</div>
                  <div class="info-value">NE</div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Zamena:</div>
                  <div class="info-value">NE</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="info-box">
          <h2>Dodatne informacije</h2>
          <div class="info-section-container">
            <div class="info-section">
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Emisiona klasa motora</div>
                  <div class="info-value"><?php echo escape($oglas->emisiona_klasa) ?></div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Pogon</div>
                  <div class="info-value"><?php echo escape($oglas->pogon) ?> </div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Menjač</div>
                  <div class="info-value"><?php echo escape($oglas->menjac) ?> </div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Broj vrata</div>
                  <div class="info-value"><?php echo escape($oglas->broj_vrata) ?> </div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Broj sedišta</div>
                  <div class="info-value"><?php echo escape($oglas->broj_sedista) ?> </div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Strana volana</div>
                  <div class="info-value"><?php echo escape($oglas->volan) ?> </div>
                </div>
              </div>
              <div class="divider" style="border-bottom: none;">
                <div class="info-entry">
                  <div class="info-label">Klima</div>
                  <div class="info-value"><?php echo escape($oglas->klima) ?> </div>
                </div>
              </div>
            </div>
            <div class="info-section" style="padding-left: 40px">
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Boja</div>
                  <div class="info-value">Crna </div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Materijal enterijera</div>
                  <div class="info-value">Štof </div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Boja enterijera</div>
                  <div class="info-value">Druga </div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Registrovan do</div>
                  <div class="info-value">04.2024. </div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Poreklo vozila</div>
                  <div class="info-value">Domaće tablice </div>
                </div>
              </div>
              <div class="divider">
                <div class="info-entry">
                  <div class="info-label">Vlasništvo</div>
                  <div class="info-value">Vodi se na prodavca </div>
                </div>
              </div>
              <div class="divider" style="border-bottom: none;">
                <div class="info-entry">
                  <div class="info-label">Oštećenje</div>
                  <div class="info-value">Nije oštećen </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="info-box">
          <h2>Sigurnost</h2>
          <div class="info-checkboxes">
            <div class="info-entry">Airbag za vozača</div>
            <div class="info-entry">Airbag za suvozača</div>
            <div class="info-entry">Bočni airbag</div>
            <div class="info-entry">Child lock</div>
            <div class="info-entry">ABS</div>
            <div class="info-entry">ESP</div>
            <div class="info-entry">ASR</div>
            <div class="info-entry">Alarm</div>
            <div class="info-entry">Kodiran ključ</div>
            <div class="info-entry">OBD zaštita</div>
          </div>
        </div>

        <div class="info-box">
          <h2>Oprema</h2>
          <div class="info-checkboxes">
            <div class="info-entry">Metalik boja</div>
            <div class="info-entry">Branici u boji auta</div>
            <div class="info-entry">Servo volan</div>
            <div class="info-entry">Multifunkcionalni volan</div>
            <div class="info-entry">Tempomat</div>
            <div class="info-entry">Daljinsko zaključavanje</div>
            <div class="info-entry">Putni računar</div>
            <div class="info-entry">Tonirana stakla</div>
            <div class="info-entry">Električni podizači</div>
            <div class="info-entry">Električni retrovizori</div>
            <div class="info-entry">Sedišta podesiva po visini</div>
            <div class="info-entry">Grejanje sedišta</div>
            <div class="info-entry">Svetla za maglu</div>
            <div class="info-entry">Senzori za svetla</div>
            <div class="info-entry">Senzori za kišu</div>
            <div class="info-entry">Parking senzori</div>
            <div class="info-entry">Aluminijumske felne</div>
            <div class="info-entry">Navigacija</div>
            <div class="info-entry">Bluetooth</div>
            <div class="info-entry">Radio/Kasetofon</div>
            <div class="info-entry">LED prednja svetla</div>
            <div class="info-entry">LED zadnja svetla</div>
            <div class="info-entry">Naslon za ruku</div>
            <div class="info-entry">Adaptivni tempomat</div>
            <div class="info-entry">Kamera</div>
            <div class="info-entry">Hands free</div>
            <div class="info-entry">Adaptivna svetla</div>
            <div class="info-entry">Head-up display</div>
            <div class="info-entry">ISOFIX sistem</div>
            <div class="info-entry">Start-stop sistem</div>
            <div class="info-entry">Ekran na dodir</div>
            <div class="info-entry">Kožni volan</div>
            <div class="info-entry">Grejanje volana</div>
            <div class="info-entry">USB</div>
            <div class="info-entry">Paljenje bez ključa</div>
            <div class="info-entry">Ambijentalno osvetljenje</div>
            <div class="info-entry">MP3</div>
            <div class="info-entry">Utičnica od 12V</div>
            <div class="info-entry">Otvor za skije</div>
            <div class="info-entry">Podešavanje volana po visini</div>
            <div class="info-entry">Držači za čaše</div>
            <div class="info-entry">Elektronska ručna kočnica</div>
            <div class="info-entry">AUX konekcija</div>
            <div class="info-entry">Modovi vožnje</div>
          </div>
        </div>

        <div class="info-box">
          <h2>Stanje</h2>
          <div class="info-checkboxes">
            <div class="info-entry">Prvi vlasnik</div>
            <div class="info-entry">Kupljen nov u Srbiji</div>
            <div class="info-entry">Garancija</div>
            <div class="info-entry">Servisna knjiga</div>
            <div class="info-entry">Rezervni ključ</div>
          </div>
        </div>

        <div class="info-box">
          <h2>Opis</h2>
          <div class="info-description">
          <?php echo escape($oglas->opis_oglasa) ?>
          </div>
        </div>
      </div>
      <div class="oglas-column-2">
        <span class="price"><?php echo $oglas->cena ?> €</span>
        <div class="info-card">
          <h2>Force Luxury Cars</h2>
          <div class="info-card-address">
            Mladenovac<br>
            Beogradski put 160
          </div>
          <div class="button-container">
            <button class="button" type="submit">KONTAKTIRAJ</button>
          </div>
        </div>

      </div>
  </section>

  <section class="footer">
    <div class="col-1">
      <h3>Korisni linkovi</h3>
      <a href="#home">Home</a>
      <a href="#poslednje">Popularno</a>
      <a href="registracija.php">Registracija</a>
      <a href="prijava.php">Prijava</a>
      <a href="#Kontakt">Kontakt</a>
    </div>
    <div class="col-2">
      <h3>NEWSLETTER</h3>
      <form>
        <input class="email" type="text" placeholder="Unesite email" required>
        <br></br>
        <button class="footer__button" type="submit">PRETPLATITE SE</button>
      </form>
    </div>
    <div class="col-3">
      <h3>Kontakt</h3>
      <p>Kralja Petra 45, VI sprat
        11000 Beograd
        Tel: 011/71-55-055
        e-mail: info@laguna.rs</p>
    </div>
  </section>

  <!-- <script src="js/profil.js"></script> -->
  <script>
    var swiper = new Swiper(".image-swiper", {
      pagination: {
        el: ".swiper-pagination",
        type: "fraction",
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>
</body>

</html>