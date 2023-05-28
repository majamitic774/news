<?php

namespace News\Core;

require_once '../src/utils/constants.php';

class View
{
    public static function render($fileName, $data = [])
    {
        extract($data);
        include VIEWS . $fileName;
    }
}
