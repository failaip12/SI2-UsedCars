<?php
declare(strict_types=1);
require_once 'core/init.php';

$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
$db = DB::getInstance();

if (Input::exists()) {
  if (Token::check(Input::get('token'))) {
      $validate = new Validate();
      $validation = $validate->check($_POST, array(
          'ime' => array(
              'max' => 45
          ),
          'prezime' => array(
              'max' => 45
          ),
          'adresa' => array(
              'max' => 45
          ),
          'grad' => array(
              'max' => 45
          ),
          'postanski_broj' => array(
              'max' => 45
          ),
          'fiksni' => array(
              'max' => 45
          ),
          'mobilni' => array(
              'max' => 45
          )
      ));

      if ($validation->passed()) {
          // update
          try {
              $user->update(User_type($user->permissionLevel()), array(
                  'ime' => Input::get('ime'),
                  'prezime' => Input::get('prezime'),
                  'adresa' => Input::get('adresa'),
                  'grad' => Input::get('grad'),
                  'postanski_broj' => Input::get('postanski_broj'),
                  'fiksni' => Input::get('fiksni'),
                  'mobilni' => Input::get('mobilni')
              ));
              Session::flash('home', 'Your details have been updated.');
              Redirect::to('profil.php');
          } catch (Exception $e) {
              die($e->getMessage());
          }
      } else {
          foreach ($validation->errors() as $error) {
              echo $error, '<br>';
          }
      }
  }
}
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
  <link rel="stylesheet" href="css/profil.css">
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
      <nav class="navigation">
        <img src="https://www.kindpng.com/picc/m/252-2524695_dummy-profile-image-jpg-hd-png-download.png" width="100"
          height="80" />
        <ul class="navigation-container">
          <li>
            <button class="navigation-button active-nav" value="profil">Profil</button>
          </li>
          <li>
            <button class="navigation-button" value="sacuvane-pretrage">Sačuvane pretrage</button>
          </li>
        </ul>
      </nav>
      <div class="content">
        <div id="profil" class="tab active-tab">
          <h2 class="tab-title">
            Profil
          </h2>
          <h3 class="tab-subtitle">Osnovne informacije</h3>
          <form action="" method="post">
            <div class="profile-inputs-container">
              <div class="profile-inputs">
                Ime: <br><input class="text-input" type="text" placeholder="Ime" name="ime" value="<?php echo escape($user->data()->ime)?>">
                Prezime:<input class="text-input" type="text" placeholder="Prezime" name="prezime" value="<?php echo escape($user->data()->prezime)?>">
                Adresa:<input class="text-input" type="text" placeholder="Adresa" name="adresa" value="<?php echo escape($user->data()->adresa)?>">
                <br>
                Grad:
                <br><input class="text-input" type="text" placeholder="Grad" name="grad" value="<?php echo escape($user->data()->grad)?>">
                Poštanski broj:<input class="text-input" type="text" placeholder="Poštanski broj" name="postanski_broj" value="<?php echo escape($user->data()->postanski_broj)?>">
              </div>
              <div class="profile-inputs">
              Fiksni Telefon:<input class="text-input" type="text" placeholder="Fiksni Telefon" name="fiksni" value="<?php echo escape($user->data()->fiksni)?>">
              Mobilni telefon:<input class="text-input" type="text" placeholder="Mobilni telefon" name="mobilni" value="<?php echo escape($user->data()->mobilni)?>">
              <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
              </div>
            </div>
            <div class="submit-container">
              <button class="button" type="submit">SAČUVAJ</button>
            </div>
          </form>
          <h3 class="tab-subtitle">Bezbednost</h3>
          <form action="changepassword.php" method="post">
            <div class="profile-inputs-container">
              <div class="profile-inputs">
                <input class="text-input" type="password" placeholder="Trenutna šifra" name="password_current" id="password_current" required>
                <input class="text-input" type="password" placeholder="Nova šifra" name="password_new" id="password_new" required>
                <input class="text-input" type="password" placeholder="Ponovi novu šifru" name="password_new_again" id="password_new_again" required>
              </div>
            </div>
            <div class="submit-container">
              <button class="button" type="submit">Promeni šifru</button>
            </div>
          </form>
        </div>
        <div id="sacuvane-pretrage" class="tab">
          <h2 class="tab-title">
            Sačuvane pretrage
          </h2>
          <div class="sacuvane-retrage-lista">
            <div class="pretraga">
              <div class="pretraga-sadrzaj">
                <a class="pretraga-ime" href="#">
                  Alfa Romeo 145
                </a>
                <div class="pretraga-opis">
                  Alfa Romeo 145, do 7000 €, do 2021 god., Limuzina, Hečbek
                </div>
              </div>
              <div class="pretraga-akcije">
                <div class="akcija">Obrisi</div>
              </div>
            </div>
            <div class="pretraga">
              <div class="pretraga-sadrzaj">
                <a class="pretraga-ime" href="#">
                  Chery Tengo Tiggo
                </a>
                <div class="pretraga-opis">
                  Chery Tengo Tiggo, do 20000 €, od 2013 god., Limuzina, Hečbek, Karavan, Benzin, Dizel
                </div>
              </div>
              <div class="pretraga-akcije">
                <div class="akcija">Obrisi</div>
              </div>
            </div>
            <div class="pretraga">
              <div class="pretraga-sadrzaj">
                <a class="pretraga-ime" href="#">
                  Fiat 500L 500X...
                </a>
                <div class="pretraga-opis">
                  Fiat 500l 500x 850 Barchetta, do 20000 €, do 2024 god., Limuzina, Dizel
                </div>
              </div>
              <div class="pretraga-akcije">
                <div class="akcija">Obrisi</div>
              </div>
            </div>
            <div class="pretraga">
              <div class="pretraga-sadrzaj">
                <a class="pretraga-ime" href="#">
                  Alfa Romeo 145
                </a>
                <div class="pretraga-opis">
                  Alfa Romeo 145, do 7000 €, do 2021 god., Limuzina, Hečbek
                </div>
              </div>
              <div class="pretraga-akcije">
                <div class="akcija">Obrisi</div>
              </div>
            </div>
            <div class="pretraga">
              <div class="pretraga-sadrzaj">
                <a class="pretraga-ime" href="#">
                  Chery Tengo Tiggo
                </a>
                <div class="pretraga-opis">
                  Chery Tengo Tiggo, do 20000 €, od 2013 god., Limuzina, Hečbek, Karavan, Benzin, Dizel
                </div>
              </div>
              <div class="pretraga-akcije">
                <div class="akcija">Obrisi</div>
              </div>
            </div>
            <div class="pretraga">
              <div class="pretraga-sadrzaj">
                <a class="pretraga-ime" href="#">
                  Fiat 500L 500X...
                </a>
                <div class="pretraga-opis">
                  Fiat 500l 500x 850 Barchetta, do 20000 €, do 2024 god., Limuzina, Dizel
                </div>
              </div>
              <div class="pretraga-akcije">
                <div class="akcija">Obrisi</div>
              </div>
            </div>
            <div class="pretraga">
              <div class="pretraga-sadrzaj">
                <a class="pretraga-ime" href="#">
                  Alfa Romeo 145
                </a>
                <div class="pretraga-opis">
                  Alfa Romeo 145, do 7000 €, do 2021 god., Limuzina, Hečbek
                </div>
              </div>
              <div class="pretraga-akcije">
                <div class="akcija">Obrisi</div>
              </div>
            </div>
            <div class="pretraga">
              <div class="pretraga-sadrzaj">
                <a class="pretraga-ime" href="#">
                  Chery Tengo Tiggo
                </a>
                <div class="pretraga-opis">
                  Chery Tengo Tiggo, do 20000 €, od 2013 god., Limuzina, Hečbek, Karavan, Benzin, Dizel
                </div>
              </div>
              <div class="pretraga-akcije">
                <div class="akcija">Obrisi</div>
              </div>
            </div>
            <div class="pretraga">
              <div class="pretraga-sadrzaj">
                <a class="pretraga-ime" href="#">
                  Fiat 500L 500X...
                </a>
                <div class="pretraga-opis">
                  Fiat 500l 500x 850 Barchetta, do 20000 €, do 2024 god., Limuzina, Dizel
                </div>
              </div>
              <div class="pretraga-akcije">
                <div class="akcija">Obrisi</div>
              </div>
            </div>
          </div>
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

  <script src="js/profil.js"></script>
</body>

</html>