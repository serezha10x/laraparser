<?php

namespace App\Util;

use phpMorphy;

require_once(base_path() . "/vendor/autoload.php");

class MorphyConfig
{
    static public function setMorphy(string $lang) {
        $dir = base_path() . "/vendor/cijic/phpmorphy/libs/phpmorphy/dicts";
        $lang = 'ru_RU';
        return new phpMorphy($dir, $lang);
    }
}
