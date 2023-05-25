<?php
declare(strict_types=1);

require_once 'core/init.php';
require_once 'functions/pagination.php';
$trenutna_strana = 1;
$user = new User();
if ($user->permissionLevel()!=2) {
    Redirect::to('index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script>
        function odobriOglas(id){
        var odgovor=confirm("Odobravanje oglasa: Da li ste sigurni?");
        if (odgovor)
        window.location = "odobri_oglas.php?id="+id;
        return false;
      }
    </script>

    
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"/>
    <title>Dobrodoslica</title>
</head>
<body>
<div class="container">
    <div class="table-responsive" style="width: fit-content; margin-left:-120px;">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-xs-5">
                        <h2><b>Tabela neodobrenih oglasa</b></h2>
                    </div>
        <form method="post" id="profil" action="">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <div id = "personal">

        <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Naslov oglasa</th>
                        <th>Marka vozila</th>
                        <th>Tip vozila</th>
                        <th>Godina vozila</th>
                        <th>Kilometraza vozila</th>
                        <th>Cena vozila</th>
                        <th>Menjac vozila</th>
                        <th>Pogon vozila</th>
                        <th>Potvrda</th>
                    </tr>
                </thead>
                <?php
                    $db = DB::getInstance();
                    $oglasi_query = $db->query("SELECT * FROM `oglasi` WHERE admin_id is NULL");
                    if (!Input::exists('get')) {
                        $trenutna_strana = 1;
                    } else {
                        $trenutna_strana = (int) Input::get('strana');
                    }
                    $broj_oglasa = $oglasi_query->count();
                    $oglasi = $db->query('SELECT * FROM oglasi WHERE admin_id is NULL limit ? , ?', array(($trenutna_strana - 1) * 10, 10))->results();
                    if (count($oglasi) > 0) {
                        foreach ($oglasi as $oglas) {
                            $link = "oglas.php?id=" . strval($oglas->oglas_id);
                            echo "<tr class='manageRows'>";
                            echo '<td id=\'id\'> <a href="'.$link.'">';
                            echo $oglas->oglas_id;
                            echo "</td>";
                            echo "<td id='naslov'>";
                            echo $oglas->naslov;
                            echo "</td>";
                            echo "<td id='marka'>";
                            echo $oglas->marka;
                            echo "</td>";
                            echo "<td id='karoserija'>";
                            echo $oglas->karoserija;
                            echo "</td>";
                            echo "<td id='godiste'>";
                            echo $oglas->godiste;
                            echo "</td>";
                            echo "<td id='kilometraza'>";
                            echo $oglas->kilometraza;
                            echo "</td>";
                            echo "<td id='cena'>";
                            echo $oglas->cena;
                            echo "</td>";
                            echo "<td id='menjac'>";
                            echo $oglas->menjac;
                            echo "</td>";
                            echo "<td id='pogon'>";
                            echo $oglas->pogon;
                            echo "<td><input type='submit' class='btn' onclick='return odobriOglas($oglas->oglas_id)' value='Odobri oglas'></td>";
                            echo "</tr>";
                        }
                    }
                    //TODO Add search
                ?>
          </table>
            <div class="clearfix">
    <div class="hint-text">Prikazano <b><?php echo (($trenutna_strana - 1) * 10) + 1; echo ' - '; echo $trenutna_strana * 10;?></b> od <b><?php echo $broj_oglasa; ?></b> oglasa</div>
    <ul class="pagination">
    <?php
        echo pagination($broj_oglasa, $trenutna_strana, 'listaoglasa.php');
    ?>
    </ul>
</div>
        </div>
        </form>
        </div>
        </div>
        </div>
    </section>

</body>
