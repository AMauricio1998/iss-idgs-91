<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View as ViewView;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

class UsuariosFromView implements FromView
{
    public function view(): ViewView {
        return view('dashboard.excel.usuarios-excel', [
            'usuarios' => User::with('areas', 'roles')->orderBy('id', 'desc')->take(100)->get()
        ]);
    }
}
