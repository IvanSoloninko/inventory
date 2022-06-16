<?php

namespace App\Exports;

use App\Models\Inventory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InventoryExport implements FromView
{
    public function view(): View
    {
        return view('exports.inventory', [
            'inventory' => Inventory::all(),
        ]);
    }
}
