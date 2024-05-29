<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
        public function index()
        {
            $items = Item::all();
            return view('items.index', compact('items'));
        }
    
        public function store(Request $request)
        {
            $request->validate(['name' => 'required']);
            Item::create(['name' => $request->name, 'checked' => false]);
            return redirect()->route('items.index');
        }
    
        public function update(Request $request, Item $item)
        {
            $item->name = $request->name;
            $item->checked = $request->has('checked');
            $item->save();
            return redirect()->route('items.index');
        }
    
        public function destroy(Item $item)
        {
            $item->delete();
            return redirect()->route('items.index');
        }
    }

