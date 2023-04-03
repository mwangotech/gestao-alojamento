<?php

namespace App\Traits;
trait DatabaseFunctions
{
    public function escape($value)
    {
        return str_replace(
            ['\\', "\0", "\n", "\r", "\x1a", "'", '"'],
            ['\\\\', "\\0", "\\n", "\\r", '\Z', "\'", '\"'],
            $value
        );
    }
}
