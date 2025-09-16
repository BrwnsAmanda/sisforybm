<nav class="fixed w-full z-50 bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/ybmlogo.jpg') }}" alt="Logo YBM" class="w-12 h-auto">
            <h1 class="text-xl font-extrabold tracking-tight text-gray-900">
                <span class="text-blue-800">YBM</span>
                <span class="text-orange-500">BRILiaN</span>
                <span class="text-orange-500">RO Makassar</span>
            </h1>
        </div>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex gap-6 items-center">
    <li>
        <a href="{{ route('home') }}" class="relative px-3 py-2 font-extrabold transition-all duration-200 rounded-lg
            {{ Route::currentRouteName() == 'home' ? 'text-blue-700' : 'text-gray-700 hover:text-blue-700' }} group">
            Home
            <span class="absolute bottom-0 left-1/2 h-0.5 bg-blue-700 transition-all duration-200 transform -translate-x-1/2
                {{ Route::currentRouteName() == 'home' ? 'w-3/4' : 'w-0 group-hover:w-3/4' }}"></span>
        </a>
    </li>
    <li>
        <a href="{{ route('about') }}" class="relative px-3 py-2 font-extrabold transition-all duration-200 rounded-lg
            {{ Route::currentRouteName() == 'about' ? 'text-blue-700' : 'text-gray-700 hover:text-blue-700' }} group">
            About Us
            <span class="absolute bottom-0 left-1/2 h-0.5 bg-blue-700 transition-all duration-200 transform -translate-x-1/2
                {{ Route::currentRouteName() == 'about' ? 'w-3/4' : 'w-0 group-hover:w-3/4' }}"></span>
        </a>
    </li>
</ul>


        <!-- Login Button -->
        <div class="hidden md:flex">
            <a href="{{ route('login') }}" class="px-6 py-2 rounded-full bg-gradient-to-r from-blue-700 to-blue-500 text-white font-bold shadow-lg hover:from-orange-500 hover:to-orange-500 transition-all duration-300">
                Login
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button id="mobile-menu-button" class="focus:outline-none">
                <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg">
        <ul class="flex flex-col p-6 gap-4">
            <li>
                <a href="{{ route('home') }}" class="relative px-3 py-2 font-medium text-gray-700 hover:text-blue-700 transition-all duration-200 rounded-lg group">
                    Home
                    <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-blue-700 transition-all duration-200 group-hover:w-3/4 transform -translate-x-1/2"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('about') }}" class="relative px-3 py-2 font-medium text-gray-700 hover:text-blue-700 transition-all duration-200 rounded-lg group">
                    About Us
                    <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-blue-700 transition-all duration-200 group-hover:w-3/4 transform -translate-x-1/2"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('login') }}" class="px-6 py-2 rounded-full bg-gradient-to-r from-blue-700 to-blue-500 text-white font-bold shadow-lg hover:from-orange-500 hover:to-orange-500 transition-all duration-300">
                    Login
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        menu.classList.toggle('flex');
        menu.classList.toggle('flex-col');
    });
</script>
