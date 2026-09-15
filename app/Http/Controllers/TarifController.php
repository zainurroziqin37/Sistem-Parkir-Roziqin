<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        // Mengirim variabel $tarifs (jamak) sesuai kebutuhan file Blade
        $tarifs = Tarif::orderBy('id_tarif')->get();
        return view('tarif.index', compact('tarifs'));
    }

    public function create()
    {
        return view('tarif.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_kendaraan' => 'required|string|max:100',
            'tarif_per_jam' => 'required|numeric',
        ]);
        $data['jenis_kendaraan'] = strtolower(trim($data['jenis_kendaraan']));

        Tarif::create($data);

        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tarif = Tarif::findOrFail($id);
        return view('tarif.edit', compact('tarif'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'jenis_kendaraan' => 'required|string|max:100',
            'tarif_per_jam' => 'required|numeric',
        ]);
        $data['jenis_kendaraan'] = strtolower(trim($data['jenis_kendaraan']));

        $tarif = Tarif::findOrFail($id);
        $tarif->update($data);

        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tarif = Tarif::findOrFail($id);
        $tarif->delete();

        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil dihapus!');
    }
}