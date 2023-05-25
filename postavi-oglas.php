<?php
declare(strict_types=1);
require_once 'core/init.php';
//echo '<pre>';
//var_dump($_POST);
//echo '</pre>';
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
            'karoserija' => array(
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
            'emisionaKlasa' => array(
                'required' => true,
                'max' => 45
            ),
            'broj_vrata' => array(
                'required' => true,
                'max' => 45
            ),
            'broj_sedista' => array(
                'required' => true,
                'max' => 45
            ),
            'volan' => array(
                'required' => true,
                'max' => 45
            ),
            'klima' => array(
                'required' => true,
                'max' => 45
            ),
            'opis' => array(
                'required' => true,
                'max' => 1000
            ),
            'naslov' => array(
                'required' => true,
                'max' => 1000
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
                        'karoserija' => Input::get('karoserija'),
                        'gorivo' => Input::get('gorivo'),
                        'kubikaza' => Input::get('kubikaza'),
                        'snaga' => Input::get('snaga'),
                        'emisiona_klasa' => Input::get('emisionaKlasa'),
                        'broj_vrata' => Input::get('broj_vrata'),
                        'broj_sedista' => Input::get('broj_sedista'),
                        'klima' => Input::get('klima'),
                        'volan' => Input::get('volan'),
                        'opis_oglasa' => Input::get('opis'),
                        'naslov' => Input::get('naslov'),
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
                //Redirect::to('index.php');
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
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        UsedCars
    </title>
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/postavi-oglas.css">
    <!--=============== REMIX ICON/BOXICON ===============-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="nav container">
            <!--====treba mi jos i broj sedista vrsta motora broj vrata za oglas====-->
            <i class='bx bx-menu' id="menu-icon"></i>
            <!--====logo====-->
            <a href="#" class="logo">Used<span>Cars</span></a>
            <!--<div class="logo"><a href=""><img src=".\img\logo.jpg" width="30px" height="50px"></a></div>-->
            <!--====nav list====-->
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

        </div>
    </header>
    <section class=" home" id="home">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="oglas-form">

            <div class="form-container">
            <div class="file-upload-container">
                <div class="section-label" style="margin-bottom:20px;">Slike oglasa</div>
                <input class="form-control" type="file" id="fileToUpload" name="fileToUpload[]" style='border:1px solid black;max-width:40%;border-left:0' hidden multiple onchange="handleFileSelection(event)">
                <label for="fileToUpload" class="file-upload-label">Izaberi slike oglasa</label>
                <span id="file-chosen"></span>
            </div>

                <div>
                    <div class="section-label">Marka</div>
                    <select class="select" id="marka" name="marka" placeholder="Marka">
                        <option value="" disabled selected hidden>Marka</option>
                        <option value="ac">AC</option>
                        <option value="alfa-romeo">Alfa Romeo</option>
                        <option value="alpina">Alpina</option>
                        <option value="aro">Aro</option>
                        <option value="audi">Audi</option>
                        <option value="austin">Austin</option>
                        <option value="bentley">Bentley</option>
                        <option value="bmw">BMW</option>
                        <option value="buick">Buick</option>
                        <option value="cadillac">Cadillac</option>
                        <option value="chery">Chery</option>
                        <option value="chevrolet">Chevrolet</option>
                        <option value="chrysler">Chrysler</option>
                        <option value="citroen">Citroen</option>
                        <option value="cupra">Cupra</option>
                        <option value="dacia">Dacia</option>
                        <option value="daewoo">Daewoo</option>
                        <option value="daihatsu">Daihatsu</option>
                        <option value="dodge">Dodge</option>
                        <option value="dr">DR</option>
                        <option value="ferrari">Ferrari</option>
                        <option value="fiat">Fiat</option>
                        <option value="ford">Ford</option>
                        <option value="gaz">GAZ</option>
                        <option value="great-wall">Great Wall</option>
                        <option value="honda">Honda</option>
                        <option value="hummer">Hummer</option>
                        <option value="hyundai">Hyundai</option>
                        <option value="infiniti">Infiniti</option>
                        <option value="isuzu">Isuzu</option>
                        <option value="jaguar">Jaguar</option>
                        <option value="jeep">Jeep</option>
                        <option value="kia">Kia</option>
                        <option value="lada">Lada</option>
                        <option value="lamborghini">Lamborghini</option>
                        <option value="lancia">Lancia</option>
                        <option value="land-rover">Land Rover</option>
                        <option value="lexus">Lexus</option>
                        <option value="lincoln">Lincoln</option>
                        <option value="linzda">Linzda</option>
                        <option value="mahindra">Mahindra</option>
                        <option value="maserati">Maserati</option>
                        <option value="mazda">Mazda</option>
                        <option value="mercedes-benz">Mercedes Benz</option>
                        <option value="mg">MG</option>
                        <option value="mini">MINI</option>
                        <option value="mitsubishi">Mitsubishi</option>
                        <option value="moskvitch">Moskvitch</option>
                        <option value="nissan">Nissan</option>
                        <option value="nsu">NSU</option>
                        <option value="oldsmobile">Oldsmobile</option>
                        <option value="opel">Opel</option>
                        <option value="peugeot">Peugeot</option>
                        <option value="piaggio">Piaggio</option>
                        <option value="polski-fiat">Polski Fiat</option>
                        <option value="porsche">Porsche</option>
                        <option value="renault">Renault</option>
                        <option value="rolls-royce">Rolls Royce</option>
                        <option value="rover">Rover</option>
                        <option value="saab">Saab</option>
                        <option value="seat">Seat</option>
                        <option value="shuanghuan">Shuanghuan</option>
                        <option value="smart">Smart</option>
                        <option value="ssangyong">SsangYong</option>
                        <option value="subaru">Subaru</option>
                        <option value="suzuki">Suzuki</option>
                        <option value="tesla">Tesla</option>
                        <option value="toyota">Toyota</option>
                        <option value="trabant">Trabant</option>
                        <option value="triumph">Triumph</option>
                        <option value="uaz">UAZ</option>
                        <option value="volkswagen">Volkswagen</option>
                        <option value="volvo">Volvo</option>
                        <option value="wartburg">Wartburg</option>
                        <option value="zastava">Zastava</option>
                        <option value="zhidou">ZhiDou</option>
                        <option value="skoda">Škoda</option>
                        <option value="ostalo">Ostalo</option>
                    </select>
                </div>
                <div>
                    <div class="section-label">Osnovne informacije</div>
                    <input class="text-input" type="text" placeholder="Naslov" name="naslov" required>
                    <input class="text-input" type="text" placeholder="Godiste" name="godiste" required>
                    <select class="select" id="karoserija" name="karoserija" placeholder="Karoserija">
                        <option value="" disabled selected hidden>Karoserija</option>
                        <option value="Limuzina">Limuzina</option>
                        <option value="Hečbek">Hečbek</option>
                        <option value="Karavan">Karavan</option>
                        <option value="Kupe">Kupe</option>
                        <option value="Kabriolet/Roadster">Kabriolet/Roadster</option>
                        <option value="Monovolumen (MiniVan)">Monovolumen (MiniVan)</option>
                        <option value="Džip/SUV">Džip/SUV</option>
                        <option value="Pickup">Pickup</option>
                    </select>
                    <select class="select" id="gorivo" name="gorivo" placeholder="Gorivo">
                        <option value="" disabled selected hidden>Gorivo</option>
                        <option value="Benzin">Benzin</option>
                        <option value="Dizel">Dizel</option>
                        <option value="Benzin + Gas (TNG)">Benzin + Gas (TNG)</option>
                        <option value="Benzin + Metan (CNG)">Benzin + Metan (CNG)</option>
                        <option value="Električni pogon">Električni pogon</option>
                        <option value="Hibridni pogon">Hibridni pogon</option>
                    </select>
                </div>

                <div>
                    <div class="section-label">Dodatne informacije</div>
                    <div class="dodatne-informacije">
                        <input class="text-input" type="text" placeholder="Kubikaža (cm3)" name="kubikaza" required>
                        <input class="text-input" type="text" placeholder="Snaga (kW)"  name="snaga"required>
                        <br>
                        <input class="text-input" type="text" placeholder="Kilometraža *" name="kilometraza"required>
                        <br>

                        <select class="select" id="emisionaKlasa" name="emisionaKlasa" placeholder="Emisiona klasa">
                            <option value="" disabled selected hidden>Emisiona klasa</option>
                            <option value="Euro 1">Euro 1</option>
                            <option value="Euro 2">Euro 2</option>
                            <option value="Euro 3">Euro 3</option>
                            <option value="Euro 4">Euro 4</option>
                            <option value="Euro 5">Euro 5</option>
                            <option value="Euro 6">Euro 6</option>
                        </select>

                        <br>

                        <select class="select" id="Pogon" name="pogon" placeholder="Pogon">
                            <option value="" disabled selected hidden>Pogon</option>
                            <option value="Prednji">Prednji</option>
                            <option value="Zadnji">Zadnji</option>
                            <option value="4x4">4x4</option>
                            <option value="4x4 reduktor">4x4 reduktor</option>
                        </select>


                        <select class="select" id="menjac" name="menjac" placeholder="Menjac">
                            <option value="" disabled selected hidden>Menjac</option>
                            <option value="Manuelni 4 brzine">Manuelni 4 brzine</option>
                            <option value="Manuelni 5 brzina">Manuelni 5 brzina</option>
                            <option value="Manuelni 6 brzina">Manuelni 6 brzina</option>
                            <option value="Automatski / poluautomatski">Automatski / poluautomatski</option>
                        </select>

                        <br>

                        <select class="select" id="broj_vrata" name="broj_vrata" placeholder="Broj vrata">
                            <option value="" disabled selected hidden>Broj vrata</option>
                            <option value="2/3 vrata">2/3 vrata</option>
                            <option value="4/5 vrata">4/5 vrata</option>
                        </select>


                        <select class="select" id="broj_sedista" name="broj_sedista" placeholder="Broj sedista">
                            <option value="" disabled selected hidden>Broj sedista</option>
                            <option value="2 sedišta">2 sedišta</option>
                            <option value="3 sedišta">3 sedišta</option>
                            <option value="4 sedišta">4 sedišta</option>
                            <option value="5 sedišta">5 sedišta</option>
                            <option value="6 sedišta">6 sedišta</option>
                            <option value="7 sedišta">7 sedišta</option>
                            <option value="8 sedišta">8 sedišta</option>
                            <option value="9 sedišta">9 sedišta</option>
                        </select>

                        <br>

                        <select class="select" id="volan" name="volan" placeholder="Volan">
                            <option value="" disabled selected hidden>Volan</option>
                            <option value="Levi volan">Levi volan</option>
                            <option value="Desni volan">Desni volan</option>
                        </select>


                        <select class="select" id="klima" name="klima" placeholder="Klima">
                            <option value="" disabled selected hidden>Klima</option>
                            <option value="Nema klimu">Nema klimu</option>
                            <option value="Manuelna klima">Manuelna klima</option>
                            <option value="Automatska klima">Automatska klima</option>
                        </select>
                    </div>
                </div>

                <div>
                    <div class="section-label">Cena</div>
                    <input class="text-input" type="text" placeholder="Cena" name="cena" required>
                </div>

                <div>
                    <div class="section-label">Opis oglasa</div>
                    <textarea class="text-area" name="opis" required></textarea>
                </div>

                <div>

                <div class="submit-container">
                    
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <button class="footer__button" type="submit">POSTAVITE OGLAS</button>
                </div>
            </div>
        </div>
    </form>
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
    <script src="js/postavi-oglas.js"></script>
    </script>
</body>

</html>