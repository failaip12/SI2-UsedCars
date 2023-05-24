<?php
require_once 'core/init.php';
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="oglas-style.css">
        <!--=============== REMIX ICON/BOXICON ===============-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <!--=============== SWIPPER ===============-->
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="custom.css">
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
                <li><a href="#home">Home</a></li>
                <li><a href="#poslednje">Poslednje dodato</a></li>
                <li><a href="registracija.php">Registracija</a></li>
                <li><a href="prijava.php">Prijava</a></li>
                <li><a href="#kontakt">Kontakt</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="postavi-oglas.php">Postavi Oglas</a></li>
            </ul>
            <i class='bx bx-search' id="search-icon" onclick="showDiv('search-box')"></i>

        </div>
        </header>
    <section class=" home" id="home">
        <div class="search-box glass">
            <h2 class="section__title">Pretraga</h2>
            <select class="brand" id="brand" name="brand" placeholder="Marka">
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
            <select id="godinaod" name="godinaod" placeholder="Godina od">
                <option value="" disabled selected hidden>Godina od</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
            </select>
            <select id="godinado" name="godinado" placeholder="Godina do">
                <option value="" disabled selected hidden>Godina do</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
                <option value="2022">2022.</option>
            </select>
            <select id="karoserija" name="karoserija" placeholder="Karoserija">
                <option value="" disabled selected hidden>Karoserija</option>
                <option value="benzin">Benzin</option>
                <option value="benzin">Benzin</option>
                <option value="benzin">Benzin</option>
                <option value="benzin">Benzin</option>
            </select>
            <select id="gorivo" name="gorivo" placeholder="Gorivo">
                <option value="" disabled selected hidden>Gorivo</option>
                <option value="benzin">Benzin</option>
                <option value="benzin">Benzin</option>
                <option value="benzin">Benzin</option>
                <option value="benzin">Benzin</option>
            </select>
            <select id="vozila" name="vozila" placeholder="Polovna i nova vozila">
                <option value="" disabled selected hidden>Polovna i nova vozila</option>
                <option value="benzin">Benzin</option>
                <option value="benzin">Benzin</option>
                <option value="benzin">Benzin</option>
                <option value="benzin">Benzin</option>
            </select>
            <button class="button pretraga__button">Pretraži</button>
            <button class="button detaljna__button">Detaljna pretraga</button>
            <button class="button sacuvaj__button">Sačuvaj pretragu</button>
            <button class="button sacuvane__button">Sačuvane pretrage</button>
        </div>
    </section>

    <section class="popular section" id="popular">
        <h2 class="section__title">Poslednje dodati oglasi</h2>
        <div class="swiper popular__container container">
            <div class="swiper-wrapper">
                <div class=" swiper-slide popular__card">
                    <a href="oglas.php">
                        <div class=" shape shape__smaller">
                        </div>
                        <h1 class="popular__title">Honda</h1>
                        <h3 class="popular__subtitle">Civic</h3>
                        <img src="img/car1.jpg" class="popular__img">
                        <div class="popular__data">
                            <div class="popular__data-group">
                                <i class="ri-dashboard-3-line"></i>3.7sec
                            </div>
                            <div class="popular__data-group">
                                <i class="ri-funds-box-line"></i> 356 km/h
                            </div>
                            <div class="popular__data-group">
                                <i class="ri-charging-pile-2-line"></i> Electric
                            </div>
                        </div>
                        <h3 class="popular__price">2000€</h3>
                        <button class="button popular__button">
                            <i class="ri-shopping-bag-2-line"></i></button>
                    </a>
                </div>
                <div class="swiper-slide popular__card">
                    <a href="oglas.php">
                        <div class=" shape shape__smaller">
                        </div>
                        <h1 class="popular__title">Honda</h1>
                        <h3 class="popular__subtitle">Civic</h3>
                        <img src="img/car1.jpg" class="popular__img">
                        <div class="popular__data">
                            <div class="popular__data-group">
                                <i class="ri-dashboard-3-line"></i>3.7sec
                            </div>
                            <div class="popular__data-group">
                                <i class="ri-funds-box-line"></i> 356 km/h
                            </div>
                            <div class="popular__data-group">
                                <i class="ri-charging-pile-2-line"></i> Electric
                            </div>
                        </div>
                        <h3 class="popular__price">2000€</h3>
                        <button class="button popular__button">
                            <i class="ri-shopping-bag-2-line"></i></button>
                    </a>
                </div>
                <div class="swiper-slide popular__card">
                    <a href="oglas.php">
                        <div class=" shape shape__smaller">
                        </div>
                        <h1 class="popular__title">Honda</h1>
                        <h3 class="popular__subtitle">Civic</h3>
                        <img src="img/car1.jpg" class="popular__img">
                        <div class="popular__data">
                            <div class="popular__data-group">
                                <i class="ri-dashboard-3-line"></i>3.7sec
                            </div>
                            <div class="popular__data-group">
                                <i class="ri-funds-box-line"></i> 356 km/h
                            </div>
                            <div class="popular__data-group">
                                <i class="ri-charging-pile-2-line"></i> Electric
                            </div>
                        </div>
                        <h3 class="popular__price">2000€</h3>
                        <button class="button popular__button">
                            <i class="ri-shopping-bag-2-line"></i></button>
                    </a>
                </div>
                <div class="swiper-slide popular__card">
                    <a href="oglas.php">
                        <div class="shape shape__smaller">
                        </div>
                        <h1 class="popular__title">Honda</h1>
                        <h3 class="popular__subtitle">Civic</h3>
                        <img src="img/car1.jpg" class="popular__img">
                        <div class="popular__data">
                            <div class="popular__data-group">
                                <i class="ri-dashboard-3-line"></i>3.7sec
                            </div>
                            <div class="popular__data-group">
                                <i class="ri-funds-box-line"></i> 356 km/h
                            </div>
                            <div class="popular__data-group">
                                <i class="ri-charging-pile-2-line"></i> Electric
                            </div>
                        </div>
                        <h3 class="popular__price">2000€</h3>
                        <button class="button popular__button">
                            <i class="ri-shopping-bag-2-line"></i></button>
                    </a>
                </div>
                <div class="swiper-slide popular__card">
                    <a href="oglas.php">
                        <div class=" shape shape__smaller">
                        </div>
                        <h1 class="popular__title">Honda</h1>
                        <h3 class="popular__subtitle">Civic</h3>
                        <img src="img/car1.jpg" class="popular__img">
                        <div class="popular__data">
                            <div class="popular__data-group">
                                <i class="ri-dashboard-3-line"></i>3.7sec
                            </div>
                            <div class="popular__data-group">
                                <i class="ri-funds-box-line"></i> 356 km/h
                            </div>
                            <div class="popular__data-group">
                                <i class="ri-charging-pile-2-line"></i> Electric
                            </div>
                        </div>
                        <h3 class="popular__price">2000€</h3>
                        <button class="button popular__button">
                            <i class="ri-shopping-bag-2-line"></i></button>
                    </a>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
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

    <script>
    var swiper = new Swiper(".popular__container", {
      slidesPerView: 1,
      spaceBetween: 10,
      grabCursor:true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 50,
        },
      },
    });
  </script>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

</body>

</html>