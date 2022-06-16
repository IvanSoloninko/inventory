<?php

namespace App\Http\Controllers;

use App\Exports\StockExport;
use App\Models\History;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class StockController extends Controller
{
    public function index()
    {
        return view('stock.index', [
            'stocks' => Stock::query()->orderBy('id', 'desc')->get(),
        ]);
    }

    public function create()
    {
        return view('stock.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
        ]);

        try {
            $stock = Stock::query()->create($request->only('name', 'address'));

            History::query()->create([
                'text' => "Admin: ".Auth::user()->full_name." create new stock $stock[name]",
            ]);

            return redirect()->route('stock.index')->with('success', 'Stock Created Successfully.');
        } catch (Throwable $error) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $error->getMessage());
        }
    }

    public function edit(Stock $stock)
    {
        return view('stock.edit', [
            'stock' => $stock,
        ]);
    }

    public function update(Request $request, Stock $stock)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
        ]);

        try {
            $stock->update($request->only('name', 'address'));

            History::query()->create([
                'text' => "Admin: ".Auth::user()->full_name." edit stock $stock[name]",
            ]);

            return redirect()->route('stock.index')->with('success', 'Stock Updated Successfully.');
        } catch (Throwable $error) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $error->getMessage());
        }
    }

    public function export(Stock $stock)
    {
        return Excel::download(new StockExport($stock['id']), 'stock.xlsx');
    }

    public function items(Stock $stock)
    {
        return view('stock.items', [
            'stock' => $stock,
            'items' => $stock->iventory,
        ]);
    }
}
