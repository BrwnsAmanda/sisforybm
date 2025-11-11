<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">
        {{ $spreadsheet->title }}
    </h2>

    <div class="overflow-x-auto border rounded-lg shadow-sm">
        <iframe
            src="{{ $spreadsheet->url }}"
            width="100%"
            height="700"
            frameborder="0"
            class="rounded-lg">
        </iframe>
    </div>

    <p class="mt-4 text-sm text-gray-500">
        *Spreadsheet hanya dapat dilihat, tidak dapat diedit di sini.*
    </p>
</div>
