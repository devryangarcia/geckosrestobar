<?php

namespace App\Exports;

use App\Models\OutgoingProduct;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class OutgoingProductExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    public function view(): View
    {
        return view('exportexcels.outgoingproductALLExcel', [
            'outgoingproducts' => OutgoingProduct::all()
        ]);
    }

}
