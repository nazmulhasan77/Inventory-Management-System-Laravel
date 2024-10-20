<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
class InventoryController extends Controller
{
    //
    function index(){
        $inventory = Inventory::all();
        return view('inventory',['inventory'=>$inventory]);
    }
    function addInventory(Request $request){
        $inventory = new Inventory();
        
        $inventory->name = $request->name;
        $inventory->category = $request->category;
        $inventory->unit_price = $request->unit_price;
        $inventory->quantity = $request->quantity;
        $inventory->save();
        return redirect('inventory');
    }
    function deleteInventory($id){
        $inventory = Inventory::destroy($id);
        return redirect('inventory');
    }
    function editInventory($id){
        $inventory = Inventory::where('id', $id)->first();
        return view('edit-inventory',['inventory'=>$inventory]);
    }
    function UpdateInventory(Request $request,$id){
        $inventory = Inventory::find($id);
        $inventory->name = $request->name;
        $inventory->category = $request->category;
        $inventory->unit_price = $request->unit_price;
        $inventory->quantity = $request->quantity;
        $inventory->save();
        return redirect('inventory');
    }

    function search(Request $request){
        $inventory = Inventory::where('name','like',"%$request->search%")
        ->orWhere('category','like',"%{$request->search}%")
        ->get();
        return view('inventory',['inventory'=>$inventory,'search'=>$request->search,'icon'=>"cancel"]);
    }
}