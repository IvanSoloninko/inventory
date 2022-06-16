<?php

namespace App\Http\Controllers;

use App\Exports\InventoryExport;
use App\Models\History;
use App\Models\Inventory;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;

class InventoryController extends Controller
{
    public function list()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            $inventory = Inventory::query()->orderBy('created_at')->get();

            return view('inventory.list', compact('inventory'));
        }

        $inventory = Inventory::query()->where('user_id', '=', $user->id)->orderBy('created_at')->get();

        return view('inventory.list', compact('inventory'));
    }

    public function add()
    {
        return view('inventory.add', [
            'users' => User::query()->orderBy('id', 'desc')->get(),
            'stocks' => Stock::query()->orderBy('id', 'desc')->get(),
        ]);
    }

    public function edit($id)
    {
        $inventory = Inventory::query()->where('id', $id)->first();

        return view('inventory.edit', [
            'inventory' => $inventory,
            'stocks' => Stock::query()->orderBy('id', 'desc')->get(),
        ]);
    }

    public function delete($id)
    {
        $inventory = Inventory::query()->where('id', $id)->firstOrFail();

        History::query()->create([
            'text' => $inventory->user['full_name']." delete inventory - $inventory[name_inventory]",
        ]);

        $inventory->delete();

        return redirect()->route('inventory.list')->with('success', 'Delete Inventory.');
    }

    public function store(Request $request)
    {
        // Validations
        $request->validate([
            'name_inventory' => 'required',
            'description' => 'required',
            'stock_id' => 'required',
            'condition' => 'required',
            'count' => 'required|integer',
        ]);

        try {
           $inventory = Inventory::create([
                'name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                'user_id' => Auth::user()->id,
                'description' => $request->description,
                'name_inventory' => $request->name_inventory,
                'stock_id' => $request->stock_id,
                'count' => $request->input('count'),
                'condition' => $request->condition,
                'user_created' => $request->input('user_created'),
            ]);

           History::query()->create([
               'text' => $inventory->user['full_name']." add new inventory - $inventory[name_inventory]",
           ]);

            return redirect()->route('inventory.list')->with('success', 'User Created Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function change($id, Request $request)
    {
        // Validations
        $request->validate([
            'name_inventory' => 'required',
            'description' => 'required',
            'stock_id' => 'required',
            'condition' => 'required',
            'count' => 'required|integer',
        ]);

        try {
            $inventory = Inventory::where('id', $id)->update([
                'description' => $request->description,
                'name_inventory' => $request->name_inventory,
                'stock_id' => $request->stock_id,
                'condition' => $request->condition,
                'count' => $request->input('count'),
            ]);

            History::query()->create([
                'text' => $inventory->user['full_name']." update inventory - $inventory[name_inventory]",
            ]);

            return redirect()->route('inventory.list')->with('success', 'Inventory Update Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    // Add trade
    public function showFormTrade(Inventory $inventory)
    {
        return view('inventory.trade', [
            'item' => $inventory,
            'users' => User::query()->orderBy('id', 'desc')->get(),
        ]);
    }

    public function tradeItem(Inventory $inventory, Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
        ]);

        try {
            $userTrade = $inventory->user['full_name'];

            $inventory->update($request->only('user_id'));

            History::query()->create([
                'text' => "User ".$userTrade." trade handed over inventory ".$inventory->user['full_name']." inventory item - $inventory[name_inventory]",
            ]);

            return redirect()->route('inventory.list')->with('success', 'Item Update trade.');
        } catch (\Throwable $error) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $error->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new InventoryExport, 'Inventory.xlsx');
    }
}
