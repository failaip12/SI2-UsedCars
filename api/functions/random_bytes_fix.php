<?php
declare(strict_types=1);

/**
 * Intended to avoid restrictions with passing null-containing strings to bcrypt functions like password_hash.
 *
 * In particular, prevents the error "Bcrypt password must not contain null character" when passing output of
 * random_bytes directly to password_hash.
 *
 * @see https://github.com/php/php-src/commit/6a5c04d01d
 * @see https://stackoverflow.com/questions/78646470
 * @license CC-0
 * 
 * @param int $size
 * @return string
 * @throws \Random\RandomException
 */
function random_bytes_no_null(int $size): string
{
    $str = '';
    while (true) {
        // this while(true) call structure ensures random_bytes is called at least once.
        // this keeps original exceptions intact, like:
        // "ValueError  random_bytes(): Argument #1 ($length) must be greater than 0."
        $str .= str_replace("\0", '', random_bytes($size));
        if (strlen($str) >= $size) {
            break;
        }
    }

    $str = substr($str, 0, $size);

    assert(strlen($str) === $size);
    assert(str_contains("test\0", "\0") === true, 'sanity: proper haystack/needle order');
    assert(str_contains($str, "\0") === false);

    return $str;
}