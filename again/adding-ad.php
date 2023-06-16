<?php
declare(strict_types=1);
require_once 'core/init.php';

$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check(
            $_POST, array(
            'marka' => array(
                'required' => true,
                'max' => 45
            ),
            'godiste' => array(
                'required' => true,
                'numeric' => true
            ),
            'kilometraza' => array(
                'required' => true,
                'numeric' => true
            ),
            'cena' => array(
                'required' => true,
                'numeric' => true
            ),
            'pogon' => array(
                'required' => true,
                'max' => 45
            ),
            'menjac' => array(
                'required' => true,
                'max' => 45
            ),
            'gorivo' => array(
                'required' => true,
                'max' => 45
            ),
            'kubikaza' => array(
                'required' => true,
                'numeric' => true
            ),
            'snaga' => array(
                'required' => true,
                'numeric' => true
            ),
            'broj_vrata' => array(
                'required' => true,
                'max' => 45
            )
            )
        );

        if ($validation->passed()) {
            // update
            try {
                $db = DB::getInstance();
                $fileNames = array_filter($_FILES['fileToUpload']['name']);
                $target_dir = "slike_oglasa/";
                if (!empty($fileNames)) {
                    foreach ($_FILES['fileToUpload']['name'] as $key => $val) {
                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$key]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$key]);
                        $error = '';
                        if ($check !== false) {
                            $uploadOk = 1;
                        } else {
                            $error .= "File is not an image./n";
                            $uploadOk = 0;
                        }
                        // Check file size
                        if ($_FILES["fileToUpload"]["size"][$key] > 5000000000) { //Sredi ovaj limit
                            $error .= "Sorry, your file is too large./n";
                            $uploadOk = 0;
                        }

                        // Allow certain file formats
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                            $error .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed./n";
                            $uploadOk = 0;
                        }

                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            echo $error;
                            break;
                        } else {
                            if (!file_exists($target_dir)) {
                                mkdir($target_dir, 0777, true);
                            }
                            $newfilename = $target_dir . $_FILES["fileToUpload"]["name"][$key];
                            if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $newfilename)) {
                                echo 'Doslo je do nepoznate greske tokom dodavanja slika<br>';
                                break;
                            }
                        }
                    }
                }//IMPROVE ERROR HANDLING
                $db->insert(
                    'oglasi', array(
                        'marka' => Input::get('marka'),
                        'godiste' => Input::get('godiste'),
                        'kilometraza' => Input::get('kilometraza'),
                        'cena' => Input::get('cena'),
                        'pogon' => Input::get('pogon'),
                        'menjac' => Input::get('menjac'),
                        'gorivo' => Input::get('gorivo'),
                        'kubikaza' => Input::get('kubikaza'),
                        'snaga' => Input::get('snaga'),
                        'broj_vrata' => Input::get('broj_vrata'),
                        'korisnik_id' => $user->data()->korisnik_id
                    )
                );
                $oglas_id = $db->query('SELECT oglas_id FROM oglasi ORDER BY oglas_id DESC LIMIT 1')->first()->oglas_id;
                foreach ($fileNames as $filename) {
                    $sha1 = sha1_file($target_dir . $filename);
                    rename($target_dir . $filename, $target_dir . $sha1 . '.' . explode(".", $filename)[1]);
                    $slika = $db->get('slika', array('hash', '=', $sha1 . '.' . explode(".", $filename)[1]));
                    $broj_slika = $slika->count();
                    if ($broj_slika == 0) {
                        $db->insert(
                            'slika', array(
                            'hash' => $sha1 . '.' . explode(".", $filename)[1]
                            )
                        );
                        $slika_id = $db->query('SELECT slika_id FROM slika ORDER BY slika_id DESC LIMIT 1')->first()->slika_id;
                        $db->insert(
                            'oglas_ima_sliku', array(
                            'oglas_id' => $oglas_id,
                            'slika_id' => $slika_id
                            )
                        );
                    } else {
                        $slika_id = $slika->first()->slika_id;
                        $db->insert(
                            'oglas_ima_sliku', array(
                            'oglas_id' => $oglas_id,
                            'slika_id' => $slika_id
                            )
                        );
                    }
                }
                
                Session::flash('home', 'Oglas je postavljen.');
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
            <form action="" method="post" enctype="multipart/form-data">
            <div class="file-upload-container">
                <div class="section-label" style="margin-bottom:20px;">Slike oglasa</div>
                <input class="form-control" type="file" id="fileToUpload" name="fileToUpload[]" style='border:1px solid black;max-width:40%;border-left:0' hidden multiple onchange="handleFileSelection(event)">
                <label for="fileToUpload" class="file-upload-label">Izaberi slike oglasa</label>
                <span id="file-chosen"></span>
            </div>
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
                        <input type="text" id="marka" name="marka">
                    </div>
                    <div class="ad-part">
                        <label for="model">Model:</label>
                        <input type="text" id="model" name="model">
                    </div>
                    <div class="ad-part">
                        <label for="godiste">Godište:</label>
                        <input type="text" id="godiste" name="godiste">
                    </div>
                    <div class="ad-part">
                        <label for="kilometraza">Kilometraža:</label>
                        <input type="text" id="kilometraza" name="kilometraza">
                    </div>
                    <div class="ad-part">
                        <label for="cena">Cena:</label>
                        <input type="text" id="cena" name="cena">
                    </div>
                    <div class="ad-part">
                        <label for="gorivo">Gorivo:</label>
                        <select id="gorivo" name="gorivo">
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
                        <input type="text" id="kubikaza" name="kubikaza">
                    </div>
                    <div class="ad-part">
                        <label for="model">Snaga motora:</label>
                        <input type="text" id="snaga" name="snaga">
                    </div>
                    <div class="ad-part">
                        <label for="pogon">Vrsta pogona:</label>
                        <select id="pogon" name="pogon">
                            <option value="prednji">Prednji</option>
                            <option value="zadnji">Zadnji</option>
                            <option value="na_sve_tockove">4x4</option>
                        </select>
                    </div>
                    <div class="ad-part">
                        <label for="menjac">Menjač:</label>
                        <select id="menjac" name="menjac">
                            <optgroup label="Manuelni menjač">
                                <option value="Manuelni 1 brzina">1 brzina</option>
                                <option value="Manuelni 2 brzina">2 brzine</option>
                                <option value="Manuelni 3 brzina">3 brzine</option>
                                <option value="Manuelni 4 brzina">4 brzina</option>
                                <option value="Manuelni 5 brzina">5 brzina</option>
                                <option value="Manuelni 6 brzina">6 brzina</option>
                            </optgroup>
                            <optgroup label="Automatski menjač">
                                <option value="Automatski 1 brzina">1 brzina</option>
                                <option value="Automatski 2 brzina">2 brzine</option>
                                <option value="Automatski 3 brzina">3 brzine</option>
                                <option value="Automatski 4 brzina">4 brzina</option>
                                <option value="Automatski 5 brzina">5 brzina</option>
                                <option value="Automatski 6 brzina">6 brzina</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="ad-part">
                        <label for="vrata">Broj vrata:</label>
                        <select id="vrata" name="broj_vrata">
                            <option value="2/3">2/3</option>
                            <option value="4/5">4/5</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <button class="submit-btn">Pošalji oglas</button>
            </form>
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