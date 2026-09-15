<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Tampilan utama Laporan Parkir dengan Filter Tanggal
     */
    public function index(Request $request)
    {
        $query = $this->getFilteredQuery($request);

        // Ringkasan statistik
        $totalPendapatan = (clone $query)->sum('biaya_total');
        $totalTransaksi  = (clone $query)->count();

        // Data transaksi berhalaman
        $transaksis = $query->orderBy('waktu_keluar', 'desc')->paginate(20)->withQueryString();
        $laporan    = $transaksis;

        return view('owner.laporan', compact(
            'transaksis',
            'laporan',
            'totalPendapatan',
            'totalTransaksi'
        ));
    }

    /**
     * Tampilan Cetak Laporan (Siap Print)
     */
    public function cetak(Request $request)
    {
        $query = $this->getFilteredQuery($request);

        // Ambil semua data tanpa pagination untuk dicetak
        $transaksis      = $query->orderBy('waktu_keluar', 'asc')->get();
        $laporan         = $transaksis;
        $totalPendapatan = $transaksis->sum('biaya_total');
        $totalTransaksi  = $transaksis->count();

        return view('owner.cetak-laporan', compact(
            'transaksis',
            'laporan',
            'totalPendapatan',
            'totalTransaksi'
        ));
    }

    /**
     * Helper Query Filter
     */
    private function getFilteredQuery(Request $request)
    {
        $query = Transaksi::with(['tarif', 'area', 'user'])
            ->where('status', 'keluar');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('waktu_keluar', [
                $request->tanggal_mulai . ' 00:00:00',
                $request->tanggal_selesai . ' 23:59:59'
            ]);
        } elseif ($request->filled('tanggal_mulai')) {
            $query->whereDate('waktu_keluar', '>=', $request->tanggal_mulai);
        } elseif ($request->filled('tanggal_selesai')) {
            $query->whereDate('waktu_keluar', '<=', $request->tanggal_selesai);
        }

        return $query;
    }
}