<?php

namespace App\Exports;

use App\Models\OutgoingProduct;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class LadiesDrinkExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function view(): View
    {
        $waitressStats = OutgoingProduct::selectRaw('waitress_id, DATE(date) as record_date, SUM(ld_qty) as total_drinks')
            ->groupBy('waitress_id', 'record_date')
            ->with('waitress:id,name')
            ->orderBy('record_date', 'asc')
            ->get();

       return view('exportexcels.ladiesdrinksALLExcel', [
            'waitressStats' => $waitressStats
        ]);
    }
}
