<?php

namespace App\Exports;

use App\Models\Bartender;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class BartenderExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function view(): View
    {
        return view('exportexcels.bartenderALLExcel', [
            'bartenders' => Bartender::all()
        ]);
    }
}
