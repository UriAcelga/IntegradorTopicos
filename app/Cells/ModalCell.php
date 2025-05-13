<?php

namespace App\Cells;

class ModalCell
{
    public function mostrar(array $params = [])
    {
        $params = [
            'elementos_input' => $params['elementos_input'] ?? [],
            'elementos_select' => $params['elementos_select'] ?? [],
            'title' => $params['title'] ?? 'Veterinaria',
        ];

        return view('components/modal_basico', $params);
    }
}
