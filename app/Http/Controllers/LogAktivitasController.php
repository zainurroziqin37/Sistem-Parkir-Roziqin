<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::with('user')
            ->latest()
            ->paginate(15);

        return view('log_aktivitas.index', [
            'logs' => $logs,
            'totalAktivitas' => LogAktivitas::count(),
            'aktivitasHariIni' => LogAktivitas::whereDate('created_at', today())->count(),
            'aktivitasUser' => LogAktivitas::where('id_user', Auth::id())->count(),
        ]);
    }
}