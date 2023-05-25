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
    <body style="background-image:url(slika/usedcars.jpg); background-repeat:no-repeat;
    background-size:cover;">
        
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
                    <li><a href="#pending">Pending</a></li>
                    <li><a href="#pretraga korisnika">Pretraga korisnika</a></li>
                    
                </ul>
                <i class='bx bx-search' id="search-icon" onclick="showDiv('search-box')""></i>
            </div>
        </header>
    </body>
</html>