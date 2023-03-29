<?php
declare(strict_types=1);

require_once 'core/init.php';
$user = new User();
if ($user->permissionLevel()!=2) {
    Redirect::to('index.php');
}
$admin_id = $user->data()->admin_id;
$db = DB::getInstance();
$db->query("UPDATE `oglasi` SET `admin_id` = ? WHERE `oglasi`.`oglas_id` = ?", array($admin_id, Input::get('id')));
Redirect::to('listaoglasa.php');
