<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use Illuminate\Http\Request;

class AreaParkirController extends Controller
{
        public function index()
    {
        $areas = AreaParkir::orderBy('id_area')->get();
        return view('area_parkir.index', compact('areas'));
    }

    public function create()
    {
        return view('area_parkir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);

        AreaParkir::create($request->only(['nama_area', 'kapasitas', 'keterangan']));

        return redirect()->route('admin.area.index')->with('success', 'Area parkir berhasil ditambahkan!');
    }

    public function edit(AreaParkir $area)
    {
        return view('area_parkir.edit', compact('area'));
    }

    public function update(Request $request, AreaParkir $area)
    {
        $request->validate([
            'nama_area' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $area->update($request->only(['nama_area', 'kapasitas', 'keterangan']));

        return redirect()->route('admin.area.index')->with('success', 'Area parkir berhasil diperbarui!');
    }

    public function destroy(AreaParkir $area)
    {
        $area->delete();
        return redirect()->route('admin.area.index')->with('success', 'Area parkir berhasil dihapus!');
    }
}