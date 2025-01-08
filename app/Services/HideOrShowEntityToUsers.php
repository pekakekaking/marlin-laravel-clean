<?php

namespace App\Services;

class HideOrShowEntityToUsers
{
    public static function HideOrShow($item, string $string)
    {
        if ($item[$string] == '1') {
            $item->update([
                $string => 0,
            ]);
        } else {
            $item->update([
                $string => 1,
            ]);
        }
    }
}
