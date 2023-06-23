<?php
declare(strict_types=1);

require_once 'core/init.php';
$user = new User();
if ($user->permissionLevel()!=1) {
    Redirect::to('index.php');
}
$korisnik_id = $user->data()->korisnik_id;
$db = DB::getInstance();
$db->query("UPDATE `korisnik` SET `ime` = ?, prezime = ?, email = ?, mobilni = ?, grad = ?, datum_rodjenja = ? WHERE `korisnik`.`korisnik_id` = ?", array(Input::get('ime'), Input::get('prezime'), Input::get('email'), Input::get('mobilni'), Input::get('grad'), Input::get('datum_rodjenja'), $korisnik_id));
Redirect::to('profile.php');
