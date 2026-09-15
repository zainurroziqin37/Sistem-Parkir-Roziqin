<?php

namespace App\Http\Controllers\Admin; // Perhatikan namespace-nya

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendapatan   = Transaksi::where('status', 'keluar')->sum('biaya_total');
        $pendapatanHariIni = Transaksi::where('status', 'keluar')->whereDate('waktu_keluar', today())->sum('biaya_total');
        $kendaraanAktif    = Transaksi::where('status', 'masuk')->count();
        $totalPetugas      = User::where('role', 'petugas')->count();
        $transaksiTerbaru  = Transaksi::orderBy('id_parkir', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('totalPendapatan', 'pendapatanHariIni', 'kendaraanAktif', 'totalPetugas', 'transaksiTerbaru'));
    }
}