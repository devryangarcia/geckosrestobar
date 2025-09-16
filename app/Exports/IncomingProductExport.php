<?php

namespace App\Exports;

use App\Models\IncomingProduct;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
class IncomingProductExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    public function view(): View
    {
        return view('exportexcels.incomingproductALLExcel', [
            'incomingproducts' => IncomingProduct::all()
        ]);
    }
}
