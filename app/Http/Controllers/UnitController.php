<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $unit = Unit::all();
        return view('admin.unit.index', compact('unit'));
    }

    public function create()
    {
        return view('admin.unit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_unit' => 'required',
            'harga_unit' => 'required',
            'kapasitas' => 'required',
        ]);

        Unit::create($request->all());

        return redirect()->route('unit.index')->with('success', 'Unit berhasil ditambahkan!');
    }
}
