<?php

namespace App\Services;

class Helpers
{
    public function HideOrShowEntityToUsers(object $item, string $parameter)
    {
        if ($item[$parameter] == '1') {
            $item->update([
                $parameter => 0,
            ]);
        } else {
            $item->update([
                $parameter => 1,
            ]);
        }
    }
}
