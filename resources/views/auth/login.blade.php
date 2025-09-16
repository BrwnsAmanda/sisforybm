@extends('layouts.app')

@section('title', 'Login - YBM MAKASSAR')

@section('content')
<main class="min-h-screen flex flex-col items-center justify-center bg-gray-50 font-poppins">

    <div class="relative w-full max-w-5xl bg-white rounded-xl shadow-xl overflow-hidden flex flex-col md:flex-row">

        <!-- Left Image -->
        <div class="md:w-1/2 hidden md:flex items-center justify-center bg-white relative">
            <img src="{{ asset('images/ybmlogo.jpg') }}" alt="YBM BRILiaN"
                class="w-160 h-auto object-contain absolute top-1/2 transform -translate-y-1/2">
        </div>

        <!-- Login Form -->
        <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
            <h1 class="text-3xl font-bold text-center text-blue-800 mb-6">
                Selamat Datang di <br> YBM BRILiaN RO Makassar
            </h1>
            <p class="text-gray-600 mb-4">Masukkan email dan password Anda untuk melanjutkan.</p>

            <!-- Status Message -->
            @if(session('status'))
                <div class="mb-4 text-sm text-green-600 font-medium">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('filament.adminybm.auth.login') }}" class="space-y-6">
                @csrf

                <!-- Email Input -->
                <div class="relative">
                    <label for="email" class="block text-gray-700 mb-2 font-medium">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        placeholder="Masukkan email Anda"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition placeholder-gray-400">
                    @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="relative">
                    <label for="password" class="block text-gray-700 mb-2 font-medium">Password</label>
                    <input type="password" name="password" id="password" required
                        placeholder="Masukkan password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition placeholder-gray-400">
                    @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex flex-col gap-4">
                    <button type="submit" class="w-full bg-blue-700 text-white font-bold py-3 rounded-lg hover:bg-blue-800 transition shadow-md">
                        Masuk
                    </button>
                    <a href="{{ route('home') }}" class="w-full text-center text-gray-700 font-semibold py-3 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                        Kembali ke Halaman Utama
                    </a>
                </div>
            </form>
        </div>

    </div>

    <!-- Footer langsung di bawah card -->
    <footer class="mt-6 text-gray-400 text-sm text-center">
        © {{ date('Y') }} YBM BRILiaN RO Makassar
    </footer>

</main>
@endsection
