@extends('layout.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
        <p class="text-sm text-gray-500 mt-1">Ringkasan statistik dan aktivitas sistem parkir.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Kendaraan Masuk</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">124</h3>
            </div>
            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                <i class="fa-solid fa-car text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Pendapatan Hari Ini</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">Rp 850K</h3>
            </div>
            <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                <i class="fa-solid fa-wallet text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Kapasitas Terisi</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">65%</h3>
            </div>
            <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                <i class="fa-solid fa-chart-pie text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Petugas Aktif</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">5</h3>
            </div>
            <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                <i class="fa-solid fa-user-shield text-xl"></i>
            </div>
        </div>
    </div>
</div>
@endsection