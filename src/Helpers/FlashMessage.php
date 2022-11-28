<?php

namespace App\Helpers;

# src/App/Helpers/FlashMessage.php

/**
 * Class FlashMessage
 * Aquesta classe llig i escriu directament en una variable de sessió
 * que serà un array, la clau serà $sessionKey de forma que evitem
 * possible col·lisions.
 */
class FlashMessage
{
    /**
     * string
     */

    const SESSION_KEY = "flash-message";

    /**
     * obtenim el valor de l'array associat a la clau.
     * després de llegir-lo l'esborrem
     * si no existeix tornem el valor indicat per defecte.
     * @param string $key
     * @param mixed $defaultValue
     * @return mixed|string
     */
    public static function get(string $key, mixed $defaultValue = ''): mixed
    {
        $value = $_SESSION[self::SESSION_KEY][$key] ?? $defaultValue;
        self::unset($key);

        return $value;
    }

    /**
     * @param string $key
     * @param $value
     */
    public static function set(string $key, $value): void {
        $_SESSION[self::SESSION_KEY][$key] = $value;
    }

    /**
     * @param string $key
     * @return void
     */
    private static function unset(string $key): void {
        unset($_SESSION[self::SESSION_KEY][$key]);
    }
}
