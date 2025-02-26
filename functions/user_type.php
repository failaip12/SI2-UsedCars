<?php
declare(strict_types=1);

function User_type($tip)
{
    $table = '';
    if ($tip == 1) {
        $table = 'korisnik';
    } elseif ($tip == 2) {
        $table = 'admin';
    }
    return $table;
}
