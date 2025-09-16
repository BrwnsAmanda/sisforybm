<div x-data="{ open: false }"
    class="bg-white dark:bg-gray-800 shadow-lg h-full w-64 fixed left-0 top-0 z-40 transition-all duration-300 ease-in-out"
    id="sidebar">

    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <img src="{{ asset('images/Logo-Unhas.png') }}" alt="Logo" class="h-10 w-auto">
                <div class="ml-3">
                    <h1 class="text-lg font-bold text-gray-800 dark:text-white">SATU DATA</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Dashboard Pimpinan</p>
                </div>
            </div>

            <!-- Close button (mobile) -->
            <button @click="open = false" class="lg:hidden p-1 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
        </div>

        <!-- Menu -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">MAIN</h3>

            <a href="{{ route('home') }}"
                class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 'bg-blue-50 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 border-r-2 border-blue-700 dark:border-blue-500' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                </svg>
                Dashboard
            </a>

            <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mt-6 mb-3">MANAGEMENT</h3>

            <a href="{{ route('home') }}"
                class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200  'bg-blue-50 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 border-r-2 border-blue-700 dark:border-blue-500' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"></path>
                </svg>
                Kelola Domain
            </a>

            <a href="{{ route('home') }}"
                class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 'bg-blue-50 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 border-r-2 border-blue-700 dark:border-blue-500' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" clip-rule="evenodd"></path>
                </svg>
                Kelola Subdomain
            </a>
        </nav>
    </div>
</div>

<!-- Mobile Overlay -->
<div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden" @click="open = false"></div>
