<?php

namespace App\Exports;

use App\Models\Stock;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StockExport implements FromView
{
    private $stock;
    /**
     * @var int
     */
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $stock = Stock::query()->where('id', $this->id)->first();

        return view('exports.stock', [
            'stock' => $stock,
        ]);
    }
}
