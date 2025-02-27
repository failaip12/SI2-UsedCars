<?php
declare(strict_types=1);

require_once __DIR__ . '/core/init.php';
$user = new User();
if ($user->permissionLevel()!=1) {
    Redirect::to('index.php');
}
$db = DB::getInstance();
$db->query('DELETE FROM cars.pretraga WHERE pretraga_id = ?', array(Input::get('id')));
Redirect::to('saved-search.php');
