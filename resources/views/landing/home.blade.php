@extends('layouts.app')

@section('title', 'Landing Home - YBM MAKASSAR')

@section('content')
@include('components.navbar')
<div class="relative w-full h-screen overflow-hidden bg-gray-900">
    <!-- Background Image statis -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/ybmbg2.png') }}" alt="YBM BRILiaN" class="w-full h-full object-cover" style="position: absolute; top:0; left:0; object-fit: cover;">
        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
    </div>

    <!-- Konten Hero tetap di tengah -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
        <h1 class="text-6xl font-extrabold text-white mb-4">
            Welcome to <span class="text-blue-500">YBM</span> <span class="text-orange-400">BRILiaN</span> RO Makassar
        </h1>
        <p class="text-2xl text-gray-100 mb-6">
            Bersama Membangun Negeri
        </p>
        <a href="{{ route('about') }}" class="px-8 py-3 font-semibold text-white rounded-full bg-gradient-to-r from-blue-600 to-blue-400 hover:from-orange-700 hover:to-orange-500 transition-all duration-300 shadow-lg">
            Tentang Kami
        </a>
    </div>
</div>
@endsection
