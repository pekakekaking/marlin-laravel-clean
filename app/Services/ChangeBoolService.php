<?php

namespace App\Services;

class ChangeBoolService
{
    public static function changeBool($item, string $string)
    {
        if ($item[$string] == '1') {
            $item->update([
                $string => 0
            ]);
        } else {
            $item->update([
                $string => 1
            ]);
        }
    }
}
