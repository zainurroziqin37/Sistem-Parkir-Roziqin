<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::orderBy('id_kendaraan')->get();
        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        $jenisKendaraan = $this->jenisKendaraanOptions();

        return view('kendaraan.create', compact('jenisKendaraan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'plat_nomor' => 'required|string|unique:tb_kendaraan,plat_nomor|max:15',
            'jenis_kendaraan' => ['required', 'string', 'max:20', Rule::in($this->jenisKendaraanOptions()->all())],
            'warna' => 'required|string|max:20',
            'pemilik' => 'required|string|max:20',
        ]);

        $data['id_user'] = auth()->id();
        Kendaraan::create($data);
        return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $jenisKendaraan = $this->jenisKendaraanOptions([$kendaraan->jenis_kendaraan]);

        return view('kendaraan.edit', compact('kendaraan', 'jenisKendaraan'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $data = $request->validate([
            'plat_nomor' => 'required|string|max:15|unique:tb_kendaraan,plat_nomor,' . $kendaraan->id_kendaraan . ',id_kendaraan',
            'jenis_kendaraan' => ['required', 'string', 'max:20', Rule::in($this->jenisKendaraanOptions([$kendaraan->jenis_kendaraan])->all())],
            'warna' => 'required|string|max:20',
            'pemilik' => 'required|string|max:20',
        ]);
        $kendaraan->update($data);
        return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Kendaraan::findOrFail($id)->delete();
        return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil dihapus!');
    }

    private function jenisKendaraanOptions(array $tambahan = [])
    {
        return Tarif::query()
            ->pluck('jenis_kendaraan')
            ->merge($tambahan)
            ->filter()
            ->unique()
            ->sort()
            ->values();
    }
}