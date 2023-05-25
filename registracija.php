<?php 
require_once 'core/init.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check(
            $_POST, array(
            'email' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'korisnik'
            ),
            'password' => array(
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            )
            )
        );
        
        if ($validation->passed()) {
            $user = new User();

            try {
                $user->create('korisnik', array(
                    'email' => Input::get('email'),
                    'password' => password_hash(Input::get('password'), PASSWORD_BCRYPT)
                ));
                Session::flash('home', 'You have been registered and can now log in!');
                Redirect::to('index.php');
            } catch(Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach($validation->errors() as $error) {
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
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
        <link rel="stylesheet" href="css/style.css">
        <!--=============== REMIX ICON/BOXICON ===============-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="nav container">
                <!--====menu icon====-->
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
                </ul>
                <i class='bx bx-search' id="search-icon" onclick="showDiv('search-box')""></i>
            </div>
        </header>
        
        <section class="home" id="home">
            
            
                <div class="center">
                    <form action="" method="post" class="form">
                        <h1> Registracija </h1>
                            <input type="text"  id="email" name="email" placeholder="email" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off" class="box"/>
                            <input type="password" id="password" name="password" placeholder="sifra" class="box"/>
                            <input type="password" id="password_again" name="password_again" placeholder=" ponovi sifru" class="box"/>
                            <input type="hidden" value="<?php echo Token::generate(); ?>"  name="token" class="box"/>
                            <input type="submit" value="Register" id="submit"/>
                    </form>
                </div>
             



        </section>
        <section class="footer" >
            <div class="col-1"><h3>Korisni linkovi</h3>
                <a href="#home">Home</a>
                <a href="#poslednje">Popularno</a>
                <a href="registracija.php">Registracija</a>
                <a href="prijava.php">Prijava</a>
                <a href="#Kontakt">Kontakt</a>
            </div>
            <div class="col-2"><h3>NEWSLETTER</h3>
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
                    e-mail: info@laguna.rs</p>
            </div>
        
        </section>
    </body>
</html>

