<?php

namespace App\Cells;

class NavCell
{
    public function mostrar(array $params = [])
    {
        $params = [];

        return view('components/nav', $params);
    }
}
