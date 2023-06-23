<?php
declare(strict_types=1);
require_once 'core/init.php';
$user = new User();
if (!$user->isLoggedIn() || $user->permissionLevel()==2) {
    Redirect::to('index.php');
}
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        try {
            $db = DB::getInstance();
            $db->insert(
                'pretraga', array(
                    'marka' => Input::get('marka'),
                    'model' => Input::get('model'),
                    'godiste_od' => Input::get('godiste_od'),
                    'godiste_do' => Input::get('godiste_do'),
                    'kilometraza_od' => Input::get('kilometraza_od'),
                    'kilometraza_do' => Input::get('kilometraza_do'),
                    'cena_od' => Input::get('cena_od'),
                    'cena_do' => Input::get('cena_do'),
                    'gorivo' => Input::get('gorivo'),
                    'pogon' => Input::get('pogon'),
                    'menjac' => Input::get('menjac'),
                    'kubikaza_od' => Input::get('kubikaza_od'),
                    'kubikaza_do' => Input::get('kubikaza_do'),
                    'snaga_od' => Input::get('snaga_od'),
                    'snaga_do' => Input::get('snaga_do'),
                    'korisnik_id' => $user->data()->korisnik_id
                )
            );
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}


$marka = Input::get('marka');
$model = Input::get('model');
$godiste_od = Input::get('godiste_od');
$godiste_do = Input::get('godiste_do');
$kilometraza_od = Input::get('kilometraza_od');
$kilometraza_do = Input::get('kilometraza_do');
$cena_od = Input::get('cena_od');
$cena_do = Input::get('cena_do');
$gorivo = Input::get('gorivo');
$pogon = Input::get('pogon');
$menjac = Input::get('menjac');
$kubikaza_od = Input::get('kubikaza_od');
$kubikaza_do = Input::get('kubikaza_do');
$snaga_od = Input::get('snaga_od');
$snaga_do = Input::get('snaga_do');

$searchParams = http_build_query(array(
    'marka' => $marka,
    'model' => $model,
    'godiste_od' => $godiste_od,
    'godiste_do' => $godiste_do,
    'kilometraza_od' => $kilometraza_od,
    'kilometraza_do' => $kilometraza_do,
    'cena_od' => $cena_od,
    'cena_do' => $cena_do,
    'gorivo' => $gorivo,
    'pogon' => $pogon,
    'menjac' => $menjac,
    'kubikaza_od' => $kubikaza_od,
    'kubikaza_do' => $kubikaza_do,
    'snaga_od' => $snaga_od,
    'snaga_do' => $snaga_do,
));

$link = 'index.php?' . $searchParams;

Redirect::to($link);