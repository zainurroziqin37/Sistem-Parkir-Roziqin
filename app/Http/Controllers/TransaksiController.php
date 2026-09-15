<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Tarif;
use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // Rute: petugas.transaksi.index (GET /petugas/transaksi)
    public function index(Request $request)
    {
        $search = strtoupper($request->search);

        // 1. Query Kendaraan Masih Parkir (Status: masuk)
        $queryMasuk = Transaksi::with(['tarif', 'area', 'user'])
            ->where('status', 'masuk')
            ->latest('waktu_masuk');

        // 2. Query Kendaraan Sudah Keluar (Status: keluar)
        $queryKeluar = Transaksi::with(['tarif', 'area', 'user'])
            ->where('status', 'keluar')
            ->latest('waktu_keluar');

        // Filter Pencarian jika ada
        if ($request->filled('search')) {
            $queryMasuk->where(function ($q) use ($search) {
                $q->where('id_kendaraan', 'like', "%{$search}%")
                  ->orWhere('id_parkir', $search);
            });

            $queryKeluar->where(function ($q) use ($search) {
                $q->where('id_kendaraan', 'like', "%{$search}%")
                  ->orWhere('id_parkir', $search);
            });
        }

        $transaksiMasuk = $queryMasuk->get();
        $transaksiKeluar = $queryKeluar->paginate(10)->withQueryString();

        // Statistik Hari Ini
        $transaksiHariIni = Transaksi::whereDate('waktu_masuk', today())->count();
        $pendapatanHariIni = Transaksi::where('status', 'keluar')
            ->whereDate('waktu_keluar', today())
            ->sum('biaya_total');
        $kendaraanKeluarHariIni = Transaksi::where('status', 'keluar')
            ->whereDate('waktu_keluar', today())
            ->count();

        return view('transaksi.index', compact(
            'transaksiMasuk',
            'transaksiKeluar',
            'transaksiHariIni',
            'pendapatanHariIni',
            'kendaraanKeluarHariIni'
        ));
    }

    // Rute: petugas.parkir.masuk (GET)
    public function masuk()
    {
        $tarifs = Tarif::orderBy('jenis_kendaraan')->get();
        $areas = AreaParkir::orderBy('id_area')->get();
        $kendaraans = Kendaraan::orderBy('plat_nomor')->get();

        return view('transaksi.masuk', compact('tarifs', 'areas', 'kendaraans'));
    }

    // Rute: petugas.parkir.storeMasuk (POST)
    public function storeMasuk(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:15',
            'id_tarif'   => 'required|exists:tb_tarif,id_tarif',
            'id_area'    => 'required|exists:tb_area_parkir,id_area',
        ]);

        $platNomor = strtoupper(trim($request->plat_nomor));
        $area = AreaParkir::findOrFail($request->id_area);

        $masihParkir = Transaksi::where('id_kendaraan', $platNomor)
            ->where('status', 'masuk')
            ->exists();

        if ($masihParkir) {
            return back()
                ->withInput()
                ->withErrors(['plat_nomor' => 'Kendaraan dengan plat tersebut masih berada di area parkir.']);
        }

        $kendaraanAktif = Transaksi::where('id_area', $area->id_area)
            ->where('status', 'masuk')
            ->count();

        if ($kendaraanAktif >= $area->kapasitas) {
            return back()
                ->withInput()
                ->withErrors(['id_area' => 'Kapasitas area parkir sudah penuh.']);
        }

        $transaksi = Transaksi::create([
            'id_kendaraan' => $platNomor,
            'id_tarif'     => $request->id_tarif,
            'id_area'      => $request->id_area,
            'id_user'      => Auth::id(),
            'waktu_masuk'  => Carbon::now(),
            'status'       => 'masuk',
        ]);

        // LOG: Catat aktivitas cetak tiket parkir masuk
        LogAktivitas::catat("Mencetak tiket parkir masuk ID #{$transaksi->id_parkir} untuk plat nomor {$platNomor}", "PARKIR");

        return redirect()->route('petugas.transaksi.index')
            ->with('success', 'Tiket parkir berhasil dicetak & kendaraan berhasil dicatat!');
    }

    // Rute: petugas.parkir.keluar (GET)
    public function keluar(Request $request)
    {
        $transaksi = null;
        if ($request->filled('keyword')) {
            $transaksi = Transaksi::with(['tarif', 'area'])
                ->where('status', 'masuk')
                ->where(function ($q) use ($request) {
                    $q->where('id_kendaraan', 'like', '%' . strtoupper($request->keyword) . '%')
                      ->orWhere('id_parkir', $request->keyword);
                })->first();

            if ($transaksi) {
                $waktuMasuk = Carbon::parse($transaksi->waktu_masuk);
                $waktuKeluar = Carbon::now();
                
                // Hitung durasi jam (minimal 1 jam)
                $durasi = max(1, (int) ceil($waktuMasuk->diffInMinutes($waktuKeluar) / 60));

                $transaksi->durasi_hitung = $durasi;
                $transaksi->biaya_hitung = $durasi * ($transaksi->tarif->tarif_per_jam ?? 0);
                $transaksi->waktu_keluar_hitung = $waktuKeluar;
            }
        }

        return view('transaksi.keluar', compact('transaksi'));
    }

    // Rute: petugas.parkir.storeKeluar (POST)
    public function storeKeluar(Request $request, $id)
    {
        $transaksi = Transaksi::with('tarif')->findOrFail($id);

        if ($transaksi->status !== 'masuk') {
            return redirect()->route('petugas.parkir.keluar')
                ->withErrors(['keyword' => 'Transaksi ini sudah diselesaikan.']);
        }

        $waktuKeluar = Carbon::now();
        $waktuMasuk = Carbon::parse($transaksi->waktu_masuk);
        $durasi = max(1, (int) ceil($waktuMasuk->diffInMinutes($waktuKeluar) / 60));
        $totalBiaya = $durasi * ($transaksi->tarif?->tarif_per_jam ?? 0);

        $transaksi->update([
            'waktu_keluar' => $waktuKeluar,
            'durasi_jam'   => $durasi,
            'biaya_total'  => $totalBiaya,
            'status'       => 'keluar',
        ]);

        // LOG: Catat aktivitas pembayaran parkir keluar
        $nominalFormat = number_format($totalBiaya, 0, ',', '.');
        LogAktivitas::catat("Memproses parkir keluar ID #{$transaksi->id_parkir} ({$transaksi->id_kendaraan}) - Total Biaya: Rp {$nominalFormat}", "PARKIR");

        return redirect()->route('petugas.struk.index', $transaksi->id_parkir)
            ->with('success', 'Pembayaran berhasil, silakan cetak struk.');
    }

    // Rute: petugas.struk.index (GET)
    public function struk($id)
    {
        $transaksi = Transaksi::with(['tarif', 'area', 'user'])->findOrFail($id);
        return view('transaksi.struk', compact('transaksi'));
    }
}