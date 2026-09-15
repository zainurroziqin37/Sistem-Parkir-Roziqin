<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $kendaraanAktif   = Transaksi::where('status', 'masuk')->count();
        $transaksiHariIni = Transaksi::whereDate('waktu_masuk', today())->count();
        $pendapatanHariIni = Transaksi::where('status', 'keluar')
            ->whereDate('waktu_keluar', today())
            ->sum('biaya_total');
        $transaksiSelesai = Transaksi::where('status', 'keluar')->count();
        $transaksiTerbaru = Transaksi::orderBy('id_parkir', 'desc')->take(10)->get();

        return view('petugas.dashboard', compact('kendaraanAktif', 'transaksiHariIni', 'pendapatanHariIni', 'transaksiSelesai', 'transaksiTerbaru'));
    }
}