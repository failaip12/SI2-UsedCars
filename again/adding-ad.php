<?php
declare(strict_types=1);
require_once 'core/init.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/adding-ad.css">
        <title>UsedCars | Novi oglas</title>
        <link rel="icon" type="image/x-icon" href="./images/icons/car-icon.png">
        <script src="index.js" defer></script>
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
            <section class="new-ad">
                <h1>Unesite karakteristike automobila:</h1>
                <div class="ad-parts">
                    <!--<input type="file" name="filename" accept="image/gif, image/jpeg, image/png">-->
                    <div class="ad-part">
                        <label for="stanje">Stanje:</label>
                        <select id="stanje">
                            <option value="polovno">Polovno vozilo</option>
                            <option value="novo">Novo vozilo</option>
                        </select>
                    </div>
                    <div class="ad-part">
                        <label for="marka">Marka:</label>
                        <input type="text" id="marka">
                    </div>
                    <div class="ad-part">
                        <label for="model">Model:</label>
                        <input type="text" id="model">
                    </div>
                    <div class="ad-part">
                        <label for="godiste">Godište:</label>
                        <input type="text" id="godiste">
                    </div>
                    <div class="ad-part">
                        <label for="kilometraza">Kilometraža:</label>
                        <input type="text" id="kilometraza">
                    </div>
                    <div class="ad-part">
                        <label for="cena">Cena:</label>
                        <input type="text" id="cena">
                    </div>
                    <div class="ad-part">
                        <label for="gorivo">Gorivo:</label>
                        <select id="gorivo">
                            <option value="dizel">Dizel</option>
                            <option value="benzin">Benzin</option>
                            <option value="tng">Benzin + Gas (TNG)</option>
                            <option value="cng">Benzin + Metan (CNG)</option>
                            <option value="elektricni">Električni pogon</option>
                            <option value="hibridni">Hibridni pogon</option>
                        </select>
                    </div>
                    <div class="ad-part">
                        <label for="marka">Kubikaža:</label>
                        <input type="text" id="kubikaza">
                    </div>
                    <div class="ad-part">
                        <label for="model">Snaga motora:</label>
                        <input type="text" id="snaga">
                    </div>
                    <div class="ad-part">
                        <label for="pogon">Vrsta pogona:</label>
                        <select id="pogon">
                            <option value="prednji">Prednji</option>
                            <option value="zadnji">Zadnji</option>
                            <option value="na_sve_tockove">4x4</option>
                        </select>
                    </div>
                    <div class="ad-part">
                        <label for="menjac">Menjač:</label>
                        <select id="menjac">
                            <optgroup label="Manuelni menjač">
                                <option value="m1">1 brzina</option>
                                <option value="m2">2 brzine</option>
                                <option value="m3">3 brzine</option>
                                <option value="m4">4 brzina</option>
                                <option value="m5">5 brzina</option>
                                <option value="m6">6 brzina</option>
                            </optgroup>
                            <optgroup label="Automatski menjač">
                                <option value="a1">1 brzina</option>
                                <option value="a2">2 brzine</option>
                                <option value="a3">3 brzine</option>
                                <option value="a4">4 brzina</option>
                                <option value="a5">5 brzina</option>
                                <option value="a6">6 brzina</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="ad-part">
                        <label for="vrata">Broj vrata:</label>
                        <select id="vrata">
                            <option value="2/3">2/3</option>
                            <option value="4/5">4/5</option>
                        </select>
                    </div>
                </div>
                <button class="submit-btn">Pošalji oglas</button>
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