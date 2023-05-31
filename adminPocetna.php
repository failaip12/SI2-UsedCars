<?php
  declare(strict_types=1);
  require_once 'core/init.php';
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="style.css">
    <!--=============== REMIX ICON/BOXICON ===============-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist\css\bootstrap.css">
    <script src="bootstrap-5.3.0-alpha1-dist\js\bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="custom.css">
  </head>
  <body>
    <header>
      <div class="nav container1">
        <!--====treba mi jos i broj sedista vrsta motora broj vrata za oglas====-->
        <i class='bx bx-menu' id="menu-icon"></i>
        <!--====logo====-->
        <a href="#" class="logo">Used<span>Cars</span></a>
        <!--<div class="logo"><a href=""><img src=".\img\logo.jpg" width="30px" height="50px"></a></div>-->
        <!--====nav list====-->
        <ul class="navbar">
          <li><a href="#home">Home</a></li>
          <li><a href="#poslednje">Poslednje dodato</a></li>
          <li><a href="#registracija">Registracija</a></li>
          <li><a href="#prijava">Prijava</a></li>
          <li><a href="#kontakt">Kontakt</a></li>
        </ul>
        <i class='bx bx-search' id="search-icon" onclick="showDiv('search-box')"></i>
      </div>
    </header>
    <section class="home" id="home">
      <div class="container" style="margin-top: 200px;">
        <form action="">
          <div class="card pozadina">
            <div class="card-body">
              <h3>Filtriraj pretragu</h3>
              <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                  <div class="input-group my-2">
                    <select class="form-select" aria-label="select example" id="marka" name="marka">
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
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                  <div class="input-group my-2">
                    <input type="text" class="form-control" id="inputModel" name="inputModel" placeholder="Model">
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group my-2">
                    <select class="form-select" aria-label="godisteFrom" id="godisteFrom" name="godisteFrom" aria-placeholder="Godiste od">
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
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group my-2">
                    <select class="form-select" aria-label="godisteTo" id="godisteTo" name="godisteTo" aria-placeholder="Godiste do">
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
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group my-2">
                    <select class="form-select" aria-label="menjac1" id="menjac1" name="menjac1" aria-placeholder="Menjac">
                      <option value="" disabled selected hidden>Menjac</option>
                      <option value="Manuelni 4 brzine">Manuelni 4 brzine</option>
                      <option value="Manuelni 5 brzina">Manuelni 5 brzina</option>
                      <option value="Manuelni 6 brzina">Manuelni 6 brzina</option>
                      <option value="Automatski / poluautomatski">Automatski / poluautomatski</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                  <div class="input-group my-2">
                    <select class="form-select" aria-label="karoserija1" id="karoserija1" name="karoserija1" aria-placeholder="Karoserija">
                      <option value="" disabled selected hidden>Karoserija</option>
                      <option value="2/3 vrata">2/3 vrata</option>
                      <option value="4/5 vrata">4/5 vrata</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                  <div class="input-group my-2">
                    <select class="form-select" aria-label="fuel" id="fuel" name="fuel" aria-placeholder="Gorivo">
                      <option value="" disabled selected hidden>Gorivo</option>
                      <option value="Benzin">Benzin</option>
                      <option value="Dizel">Dizel</option>
                      <option value="Benzin + Gas (TNG)">Benzin + Gas (TNG)</option>
                      <option value="Benzin + Metan (CNG)">Benzin + Metan (CNG)</option>
                      <option value="Električni pogon">Električni pogon</option>
                      <option value="Hibridni pogon">Hibridni pogon</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group my-2">
                    <select class="form-select" aria-label="cenaFrom" id="cenaTo" name="cenaTo" aria-placeholder="Cena od">
                      <option value="" disabled selected hidden>Cena od</option>
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
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group my-2">
                    <select class="form-select" aria-label="godisteTo" id="godisteTo" name="godisteTo" aria-placeholder="Cena do">
                      <option value="" disabled selected hidden>Cena do</option>
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
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group my-2 justify-content-center">
                    <button type="button" class="btn btn-success">Trazi</button>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group my-2 justify-content-center">
                    <button type="button" class="btn btn-info" id="sacuvajPretragu" name="sacuvajPretragu">Sacuvaj pretragu</button>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group my-2 justify-content-center">
                    <button type="button" class="btn btn-info" id="sacuvanePretrage" name="sacuvanePretrage" >Sacuvane pretrage</button>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group my-2 justify-content-center">
                    <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#detaljnaPretraga" aria-expanded="true" aria-controls="detaljnaPretraga">
                    Detaljna pretraga
                    </button>
                  </div>
                </div>
                <!-- collapse iz detaljne tretrage treba 
                  <div class="collapse" id="detaljnaPretraga"> -->
                <div class="card card-body pozadina2 text-black">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="input-group my-2">
                        <select class="form-select" aria-label="" id="volan" name="volan" aria-placeholder="Volan">
                          <option value="" disabled selected hidden>Volan</option>
                          <option value="Levi volan">Levi volan</option>
                          <option value="Desni volan">Desni volan</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="input-group my-2">
                        <select class="form-select" aria-label="emislionaklasa" id="emislionaklasa" name="emislionaklasa" aria-placeholder="Emisiona klasa">
                          <option value="" disabled selected hidden>Emisiona klasa</option>
                          <option value="Euro 1">Euro 1</option>
                          <option value="Euro 2">Euro 2</option>
                          <option value="Euro 3">Euro 3</option>
                          <option value="Euro 4">Euro 4</option>
                          <option value="Euro 5">Euro 5</option>
                          <option value="Euro 6">Euro 6</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <div class="input-group my-2">
                        <select class="form-select" aria-label="kilomenataOD" id="kilomenataOD" name="kilomenataOD" aria-placeholder="Km od">
                          <option value="" disabled selected hidden>km od</option>
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
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <div class="input-group my-2">
                        <select class="form-select" aria-label="kilometaraDO" id="kilometaraDO" name="kilometaraDO" aria-placeholder="Km do">
                          <option value="" disabled selected hidden>km do</option>
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
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <div class="input-group my-2">
                        <select class="form-select" aria-label="BOJA" id="BOJA" name="BOJA" aria-placeholder="Boja">
                          <option value="" disabled selected hidden>Boja</option>
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
                      </div>
                    </div>
                    <h3>Sigurnost</h3>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="AIRBAG">
                        <label class="form-check-label" for="AIRBAG">Airbag za vozaca</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="passengerAIRBAG">
                        <label class="form-check-label" for="passengerAIRBAG">Airbag za suvozaca</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="passengerAIRBAG">
                        <label class="form-check-label" for="passengerAIRBAG">Airbag za suvozaca</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="childLOCK">
                        <label class="form-check-label" for="childLOCK">Child lock</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="ABS">
                        <label class="form-check-label" for="ABS">ABS</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="ESP">
                        <label class="form-check-label" for="ESP">ESP</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="ABR">
                        <label class="form-check-label" for="ABS">ABR</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="ALARM">
                        <label class="form-check-label" for="ALARM">Alarm</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="kodiranKljuc">
                        <label class="form-check-label" for="kodiranKljuc">Kodiran kljuc</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="blokadaMotora">
                        <label class="form-check-label" for="blokadaMotora">Blokada motora</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="centralnoZakljucavanje">
                        <label class="form-check-label" for="centralnoZakljucavanje">Centralno zakljucavanje</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="ulazBezKljuca">
                        <label class="form-check-label" for="ulazBezKljuca">Ulaz bez kljuca</label>
                      </div>
                    </div>
                    <h3>Oprema</h3>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="metalikBoja">
                        <label class="form-check-label" for="metalikBoja">Metalik boja</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="servo">
                        <label class="form-check-label" for="servo">Servo volan</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="multifunkcionalniVolan">
                        <label class="form-check-label" for="multifunkcionalniVolan">Multifuncionalni volan</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="tempo">
                        <label class="form-check-label" for="tempo">Tempomat</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="daljinskoZakljucavanje">
                        <label class="form-check-label" for="daljinskoZakljucavanje">Daljinsko zakljucavanje</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="putniRacunar">
                        <label class="form-check-label" for="putniRacunar">Putni racunar</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="siber">
                        <label class="form-check-label" for="siber">Šiber</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="panorama">
                        <label class="form-check-label" for="panorama">Panorama</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="toniranaStakla">
                        <label class="form-check-label" for="toniranaStakla">Tonirana stakla</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="elektricnaStakla">
                        <label class="form-check-label" for="elektricnaStakla">Elektricna stakla</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="elektricniRetrovizori">
                        <label class="form-check-label" for="elektricniRetrovizori">Elektricni retrovizori</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="grejaciRetrovizora">
                        <label class="form-check-label" for="grejaciRetrovizora">Grejaci retrovizora</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="grejaciSedista">
                        <label class="form-check-label" for="grejaciSedista">Grejaci sedista</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="parkingSenzori">
                        <label class="form-check-label" for="parkingSenzori">Parking senzori</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="navigacija">
                        <label class="form-check-label" for="navigacija">Navigacija</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="radio">
                        <label class="form-check-label" for="radio">Radio</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="kamera">
                        <label class="form-check-label" for="kamera">Kamera</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="multimedija">
                        <label class="form-check-label" for="multimedija">Multimedija</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="grejanjeVolana">
                        <label class="form-check-label" for="grejanjeVolana">Grejanje volana</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="USB">
                        <label class="form-check-label" for="USB">USB</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="rezervniTocak">
                        <label class="form-check-label" for="rezervniTocak">Rezervni tocak</label>
                      </div>
                    </div>
                    <h3>Stanje vozila</h3>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="prviVlasnik">
                        <label class="form-check-label" for="prviVlasnik">Prvi vlasnik</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="kupljenNov">
                        <label class="form-check-label" for="kupljenNov">Kupljen nov</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="garancija">
                        <label class="form-check-label" for="garancija">Garancija</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="garaziran">
                        <label class="form-check-label" for="garaziran">Garanžiran</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="servisnaKnjiga">
                        <label class="form-check-label" for="servisnaKnjiga">Servisna knjiga</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="rezervniKljuc">
                        <label class="form-check-label" for="rezervniKljuc">Rezervni kljuc</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="restauriran">
                        <label class="form-check-label" for="restauriran">Restauriran</label>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="autoSkola">
                        <label class="form-check-label" for="autoSkola">Auto škola</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="container elementi" style="margin-top: 100px;" >
          <!--ovo kao primer kako ce da izgleda kartica-->
          <div class="row" >
            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="card kartica bg-dark text-white ">
                <img class="card-img" src="C:\Users\hp\Desktop\usedcars moj\slika\skrinsot.png" alt="pozadina">
                <div class="card-img-overlay">
                  <h5 class="card-title">Honda</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Civic</h6>
                  <img  class="car-img" src="slika\car1.jpg" alt="Card image">
                  <div class="col">
                    <i class="ri-dashboard-3-line"></i>3.7sec
                  </div>
                  <div class="col">
                    <i class="ri-funds-box-line"></i> 356 km/h
                  </div>
                  <div class="col">
                    <i class="ri-charging-pile-2-line"></i> Electric
                  </div>
                  <h4 class="popular__price">2000€</h4>
                  <div class="row">
                    <div class="col">
                      <button type="button" class="btn btn-success">Vise</button>
                    </div>
                    <div class="col">
                      <button type="button" class="btn btn-warning">Obrisi</button>
                    </div>
                  </div>
                  <button class="button popular__button"data-toggle="tooltip" data-placement="bottom" title="Sacuvaj oglas">
                  <i class="ri-shopping-bag-2-line"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="card kartica bg-dark text-white ">
                <img class="card-img" src="C:\Users\hp\Desktop\usedcars moj\slika\skrinsot.png" alt="pozadina">
                <div class="card-img-overlay">
                  <h5 class="card-title">Honda</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Civic</h6>
                  <img  class="car-img" src="slika\car1.jpg" alt="Card image">
                  <div class="col-lg-4 col-md-4 col-sm-6">
                    <i class="ri-dashboard-3-line"></i>3.7sec
                  </div>
                  <div class="col">
                    <i class="ri-funds-box-line"></i> 356 km/h
                  </div>
                  <div class="col">
                    <i class="ri-charging-pile-2-line"></i> Electric
                  </div>
                  <h4 class="popular__price">2000€</h4>
                  <button type="button" class="btn btn-default">Klik za vise</button>
                  <button class="button popular__button"data-toggle="tooltip" data-placement="bottom" title="Sacuvaj oglas">
                  <i class="ri-shopping-bag-2-line"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="card kartica bg-dark text-white ">
                <img class="card-img" src="C:\Users\hp\Desktop\usedcars moj\slika\skrinsot.png" alt="pozadina">
                <div class="card-img-overlay">
                  <h5 class="card-title">Honda</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Civic</h6>
                  <img  class="car-img" src="slika\car1.jpg" alt="Card image">
                  <div class="col">
                    <i class="ri-dashboard-3-line"></i>3.7sec
                  </div>
                  <div class="col">
                    <i class="ri-funds-box-line"></i> 356 km/h
                  </div>
                  <div class="col">
                    <i class="ri-charging-pile-2-line"></i> Electric
                  </div>
                  <h4 class="popular__price">2000€</h4>
                  <button type="button" class="btn btn-default">Klik za vise</button>
                  <button class="button popular__button"data-toggle="tooltip" data-placement="bottom" title="Sacuvaj oglas">
                  <i class="ri-shopping-bag-2-line"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="card kartica bg-dark text-white ">
                <img class="card-img" src="C:\Users\hp\Desktop\usedcars moj\slika\skrinsot.png" alt="pozadina">
                <div class="card-img-overlay">
                  <h5 class="card-title">Honda</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Civic</h6>
                  <img  class="car-img" src="slika\car1.jpg" alt="Card image">
                  <div class="col">
                    <i class="ri-dashboard-3-line"></i>3.7sec
                  </div>
                  <div class="col">
                    <i class="ri-funds-box-line"></i> 356 km/h
                  </div>
                  <div class="col">
                    <i class="ri-charging-pile-2-line"></i> Electric
                  </div>
                  <h4 class="popular__price">2000€</h4>
                  <button type="button" class="btn btn-default">Klik za vise</button>
                  <button class="button popular__button"data-toggle="tooltip" data-placement="bottom" title="Sacuvaj oglas">
                  <i class="ri-shopping-bag-2-line"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="card kartica bg-dark text-white ">
                <img class="card-img" src="C:\Users\hp\Desktop\usedcars moj\slika\skrinsot.png" alt="pozadina">
                <div class="card-img-overlay">
                  <h5 class="card-title">Honda</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Civic</h6>
                  <img  class="car-img" src="slika\car1.jpg" alt="Card image">
                  <div class="col">
                    <i class="ri-dashboard-3-line"></i>3.7sec
                  </div>
                  <div class="col">
                    <i class="ri-funds-box-line"></i> 356 km/h
                  </div>
                  <div class="col">
                    <i class="ri-charging-pile-2-line"></i> Electric
                  </div>
                  <h4 class="popular__price">2000€</h4>
                  <button type="button" class="btn btn-default">Klik za vise</button>
                  <button class="button popular__button"data-toggle="tooltip" data-placement="bottom" title="Sacuvaj oglas">
                  <i class="ri-shopping-bag-2-line"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="card kartica bg-dark text-white ">
                <img class="card-img" src="C:\Users\hp\Desktop\usedcars moj\slika\skrinsot.png" alt="pozadina">
                <div class="card-img-overlay">
                  <h5 class="card-title">Honda</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Civic</h6>
                  <img  class="car-img" src="slika\car1.jpg" alt="Card image">
                  <div class="col">
                    <i class="ri-dashboard-3-line"></i>3.7sec
                  </div>
                  <div class="col">
                    <i class="ri-funds-box-line"></i> 356 km/h
                  </div>
                  <div class="col">
                    <i class="ri-charging-pile-2-line"></i> Electric
                  </div>
                  <h4 class="popular__price">2000€</h4>
                  <button type="button" class="btn btn-default">Klik za vise</button>
                  <button class="button popular__button"data-toggle="tooltip" data-placement="bottom" title="Sacuvaj oglas">
                  <i class="ri-shopping-bag-2-line"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="card kartica bg-dark text-white ">
                <img class="card-img" src="C:\Users\hp\Desktop\usedcars moj\slika\skrinsot.png" alt="pozadina">
                <div class="card-img-overlay">
                  <h5 class="card-title">Honda</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Civic</h6>
                  <img  class="car-img" src="slika\car1.jpg" alt="Card image">
                  <div class="col">
                    <i class="ri-dashboard-3-line"></i>3.7sec
                  </div>
                  <div class="col">
                    <i class="ri-funds-box-line"></i> 356 km/h
                  </div>
                  <div class="col">
                    <i class="ri-charging-pile-2-line"></i> Electric
                  </div>
                  <h4 class="popular__price">2000€</h4>
                  <button type="button" class="btn btn-default">Klik za vise</button>
                  <button class="button popular__button"data-toggle="tooltip" data-placement="bottom" title="Sacuvaj oglas">
                  <i class="ri-shopping-bag-2-line"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="container" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; ">
            <div class="pagination" style="display: flex; align-items: center; color: #ffff; padding: 10px 40px;border-radius: 6px;">
              <button class="btn1" style="display: inline-flex;
                align-items: center;
                font-size: 15px;
                font-weight: 500;
                color: #ffff;
                background: transparent;
                outline: none;
                border: none;
                cursor: pointer;" onclick="backBtn">prev</button>
              <ul style="margin: 15px 20px;">
                <li class="link active" style="display: inline-block;margin: 0 10px;width: 25px;height: 25px;border-radius: 50%;text-align: center;font-size: 15px;
                  font-weight: 500;line-height: 25px;cursor: pointer;" value="1" onclick="activeLink()">1</li>
                <li class="link" style="display: inline-block;margin: 0 10px;width: 25px;height: 25px;border-radius: 50%;text-align: center;font-size: 15px;
                  font-weight: 500;line-height: 25px;cursor: pointer;" value="2" onclick="activeLink()">2</li>
                <li class="link" style="display: inline-block;margin: 0 10px;width: 25px;height: 25px;border-radius: 50%;text-align: center;font-size: 15px;
                  font-weight: 500;line-height: 25px;cursor: pointer;" value="3" onclick="activeLink()">3</li>
                <li class="link" style="display: inline-block;margin: 0 10px;width: 25px;height: 25px;border-radius: 50%;text-align: center;font-size: 15px;
                  font-weight: 500;line-height: 25px;cursor: pointer;" value="4" onclick="activeLink()">4</li>
                <li class="link" style="display: inline-block;margin: 0 10px;width: 25px;height: 25px;border-radius: 50%;text-align: center;font-size: 15px;
                  font-weight: 500;line-height: 25px;cursor: pointer;" value="5" onclick="activeLink()">5</li>
                <li class="link"  style="display: inline-block;margin: 0 10px;width: 25px;height: 25px;border-radius: 50%;text-align: center;font-size: 15px;
                  font-weight: 500;line-height: 25px;cursor: pointer;" value="6" onclick="activeLink()">6</li>
              </ul>
              <button class="btn2" style="display: inline-flex;
                align-items: center;
                font-size: 15px;
                font-weight: 500;
                color: #ffff;
                background: transparent;
                outline: none;
                border: none;
                cursor: pointer;" onclick="nextBtn" >next</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="footer" >
      <div class="col-1">
        <h3>Korisni linkovi</h3>
        <a href="#home">Home</a>
        <a href="#poslednje">Popularno</a>
        <a href="#registracija">Registracija</a>
        <a href="#prijava">Prijava</a>
        <a href="#Kontakt">Kontakt</a>
      </div>
      <div class="col-2">
        <h3>NEWSLETTER</h3>
        <form>
          <input  class="email" type="text" placeholder="Unesite email" required>
          <br></br>
          <button class ="footer__button" type="submit">PRETPLATITE SE</button>
        </form>
      </div>
      <div class="col-3">
        <h3>Kontakt</h3>
        <p>Kralja Petra 45, VI sprat
          11000 Beograd
          Tel: 011/71-55-055
          e-mail: info@laguna.rs
        </p>
      </div>
    </section>
  </body>
</html>