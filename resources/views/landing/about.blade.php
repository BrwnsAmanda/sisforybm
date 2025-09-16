@extends('layouts.app')

@section('title', 'About Us - YBM MAKASSAR')

@section('content')
@include('components.navbar')
<main class="bg-white text-gray-800">

    <!-- About Section -->
    <section class="max-w-7xl mx-auto px-10 pt-20 mb-6 flex flex-col md:flex-row items-center gap-8">
    <div class="md:w-1/2">
        <h1 class="text-3xl md:text-4xl font-extrabold">
            <span class="text-blue-800">Yayasan Baitul Maal</span>
            <span class="text-orange-500"> BRILiaN</span>
        </h1>
        <p class="mt-4">
            Yayasan Baitul Maal BRILiaN (YBM BRILiaN) merupakan LAZNAS berdasarkan Keputusan Menteri Agama Republik Indonesia No. 458 Tahun 2024,
            yang mengelola Zakat, Infak, Sedekah, dan Dana Sosial Keagamaan Lainnya melalui 5 pilar program yaitu pendidikan, ekonomi, kesehatan, dakwah,
            dan sosial kemanusiaan.
        </p>
    </div>
    <div class="md:w-1/2">
        <img src="{{ asset('images/image.jpg') }}" alt="YBM BRILiaN" class="w-full h-auto rounded-md">
    </div>
</section>

    <!-- Visi & Misi Section -->
    <section class="max-w-7xl mx-auto  flex flex-col md:flex-row items-center gap-12 relative">
        <div class="md:w-1/2 flex justify-center">
            <img src="{{ asset('images/image5.jpg') }}" alt="Mission Decoration" class="w-full h-auto object-contain">
        </div>
        <div class="md:w-1/2 space-y-8">
            <div>
                <h2 class="text-orange-500 text-2xl font-bold mb-2">Visi</h2>
                <p>
                    Terwujudnya masyarakat berdaya melalui pengelolaan filantropi Islam yang adaptif, inspiratif, dan berkarakter.
                </p>
            </div>
            <div>
                <h2 class="text-blue-800 text-2xl font-bold mb-2">Misi</h2>
                <ul class="list-disc list-inside space-y-2">
                    <li>Transformasi organisasi dengan SDM dan sistem unggul, agile, inovatif, serta berbasis teknologi.</li>
                    <li>Layanan prima dalam intermediasi muzaki dan mustahik melalui filantropi Islam di BRI dan masyarakat.</li>
                    <li>Pemberdayaan berdampak untuk kemandirian dan partisipasi masyarakat.</li>
                    <li>Meningkatkan kesejahteraan dan mencerdaskan bangsa melalui peradaban zakat.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <!-- Footer -->
<footer class="bg-blue-800 text-white mt-8">
    <div class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row justify-between gap-12">
        <!-- Info YBM -->
        <div class="md:w-1/2 flex items-center gap-2">
            <img src="{{ asset('images/ybmlogo.jpg') }}" alt="YBM BRILiaN Logo" class="w-24 h-auto">
            <div>
                <h2 class="font-bold text-xl">
                    <span>YBM</span>
                    <span class="text-orange-300"> BRILiaN </span>
                    <span class="text-orange-300"> RO Makassar </span>
                </h2>
                <p class="mt-2 max-w-md">
                    Yayasan Baitul Maal BRILiaN (YBM BRILiaN) merupakan LAZNAS berdasarkan Keputusan Menteri Agama Republik Indonesia No. 458 Tahun 2024,
                    yang mengelola Zakat, Infak, Sedekah, dan Dana Sosial Keagamaan Lainnya.
                </p>
            </div>
        </div>

        <!-- Contact + Map -->
        <div class="md:w-1/2 flex flex-col md:flex-row gap-8">
            <!-- Contact -->
            <div class="flex-1">
                <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                <div class="flex flex-col gap-4">
                    <a href="mailto:customercare@ybmbrilian.id" class="flex items-center gap-2 hover:underline">
                        <i class="far fa-envelope"></i> customercare@ybmbrilian.id
                    </a>
                    <a href="https://www.instagram.com/ybmbrilian_regionalmakassar" target="_blank" class="flex items-center gap-2 hover:underline">
                        <i class="fab fa-instagram text-pink-500"></i> ybmbrilianmakassar
                    </a>
                    <a href="https://www.facebook.com/ybmbri.makassar.9/" target="_blank" class="flex items-center gap-2 hover:underline">
                        <i class="fab fa-facebook text-blue-600"></i> YBM BRILiaN Makassar
                    </a>
                    <p class="flex items-center gap-2">
                        <i class="fas fa-building text-gray-200"></i> Jl. Slamet Riyadi, No. 5 Kantor BRI Lt 2, Kota Makassar
                    </p>
                </div>
            </div>

            <!-- Leaflet Map -->
            <div class="flex-1">
                <div id="map" class="w-full h-48 md:h-64 rounded-md"></div>
            </div>
        </div>
    </div>

    <div class="bg-blue-700 text-center py-4 mt-8">
        <h5 class="text-white text-sm">Copyright © {{ date('Y') }} YBM BRILiaN RO Makassar. All Rights Reserved</h5>
    </div>
</footer>


</main>

<!-- Leaflet JS & CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([-5.147665, 119.432731], 16); // koordinat Makassar kantor YBM
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map);
    L.marker([-5.147665, 119.432731]).addTo(map)
        .bindPopup('<b>YBM BRILiaN RO Makassar</b><br>Jl. Slamet Riyadi, No. 5')
        .openPopup();
</script>
@endsection
