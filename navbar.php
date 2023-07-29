<?php
declare(strict_types=1);
$user = new User();
require_once 'core/init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css">
        <title>UsedCars</title>
        <link rel="icon" type="image/x-icon" href="./images/icons/car-icon.png">
    </head>
    <body>
    <header>
            <div class="menu">
                <div class="logo">
                    <img src="./images/icons/car-icon.png" alt="Car icon that is part of the logo">
                    <span class="pink">Used</span>
                    <span class="grey">Cars</span>
                </div>
                <img src="./images/icons/hamburger-icon.png" alt="Hamburger icon" id="hamburger">
            </div>
            <nav id="nav">
                <ul>
                    
                <?php
                if(!$user->isLoggedIn()) {
                    echo'
                    <li><a href="index.php">Početna</a></li>
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
                        <input type="hidden" name="token" value="'. Token::generate() .'" />
                    </div>
                    
                    <div class="close-login">
                        <button type="button" class="cancel-btn">Zatvori</button>
                        <a href="register.php">Nemate svoj nalog? Napravite novi!</a>
                    </div>
                </form>
            </div>';
                }
                elseif($user->permissionLevel()==1) {
                    echo'
                    <li><a href="index.php">Početna</a></li>
                    <li><a href="adding-ad.php">Dodaj oglas</a></li>
                    <li><a href="profile.php">Moj profil</a></li>
                    <li><a href="oglasi-korisnika.php">Moj oglasi</a></li>
                    <li><a href="saved-search.php">Sacuvane pretrage</a></li>
                    <li><a href="change-password.php">Promeni sifru</a></li>
                    <div class="buttons">
                        <li><a href="logout.php" class="login-btn">Odjavi se</a></li>
                    </div>
                </ul>';
                }
                elseif($user->permissionLevel()==2) {
                    echo'
                    <li><a href="index.php">Početna</a></li>
                    <li><a href="pending-oglasi.php">Oglasi na cekanju</a></li>
                    <li><a href="change-password.php">Promeni sifru</a></li>
                    <div class="buttons">
                        <li><a href="logout.php" class="login-btn">Odjavi se</a></li>
                    </div>
                </ul>';
                }
            
            ?>
        </header>
    </body>
</html>