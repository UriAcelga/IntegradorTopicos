<?php

namespace App\Cells;

class ModalCell
{
    public function amo(array $params = [])
    {
        $params = [
            'elementos_input' => $params['elementos_input'] ?? [],
            'elementos_select' => $params['elementos_select'] ?? [],
            'title' => $params['title'] ?? 'Modificar Datos de Amo',
        ];

        return view('components/modal_amo', $params);
    }

    public function mascota(array $params = [])
    {
        $params = [];

        return view('components/modal_mascota', $params);
    }

    public function veterinario(array $params = [])
    {
        $params = [];

        return view('components/modal_veterinario', $params);
    }
}
