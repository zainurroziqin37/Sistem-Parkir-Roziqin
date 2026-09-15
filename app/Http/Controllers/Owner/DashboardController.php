<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendapatan    = Transaksi::where('status', 'keluar')->sum('biaya_total');
        $pendapatanHariIni  = Transaksi::where('status', 'keluar')->whereDate('waktu_keluar', today())->sum('biaya_total');
        $pendapatanBulanIni = Transaksi::where('status', 'keluar')->whereMonth('waktu_keluar', now()->month)->sum('biaya_total');
        $totalTransaksi = Transaksi::where('status', 'keluar')->count();
        $kendaraanAktif = Transaksi::where('status', 'masuk')->count();

        return view('owner.dashboard', compact('totalPendapatan', 'pendapatanHariIni', 'pendapatanBulanIni', 'totalTransaksi', 'kendaraanAktif'));
    }
}