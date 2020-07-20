<?php

namespace App\Util;

class FileVerification
{
    static function CheckFormat($file_extension) : bool {
        $permit_format = require base_path().'/App/Reader/config/formats.php';
        return in_array($file_extension, $permit_format);
    }
}
