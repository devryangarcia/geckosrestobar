<?php

namespace App\Exports;

use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class SupplierExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function view(): View
    {
        return view('exportexcels.supplierALLExcel', [
            'suppliers' => Supplier::all()
        ]);
    }

}
