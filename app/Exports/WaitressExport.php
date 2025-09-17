<?php

namespace App\Exports;

use App\Models\Waitress;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class WaitressExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function view(): View
    {
        return view('exportexcels.waitressALLExcel', [
            'waitresses' => Waitress::all()
        ]);
    }
}
