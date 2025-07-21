{{-- Pastikan ini dibungkus dalam div tunggal --}}
<div
    class="flex flex-col items-center justify-center p-8 bg-white rounded-lg shadow-xl border border-gray-100 max-w-sm mx-auto my-10 space-y-6">

    <h1 class="text-6xl font-extrabold text-gray-900 tabular-nums tracking-tighter">
        {{ $count }}
    </h1>

    <div class="flex space-x-4">
        {{-- Tombol Increment (Gaya Primary Button) --}}
        <button wire:click="increment"
            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium
                   transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2
                   disabled:pointer-events-none disabled:opacity-50
                   bg-gray-900 text-white hover:bg-gray-700 active:bg-gray-800
                   h-10 px-4 py-2 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            <span class="sr-only">Increment</span>
        </button>

        {{-- Tombol Decrement (Gaya Outline Button) --}}
        <button wire:click="decrement"
            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium
                   transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2
                   disabled:pointer-events-none disabled:opacity-50
                   border border-gray-200 bg-white shadow-sm hover:bg-gray-50 text-gray-900
                   h-10 px-4 py-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"></path>
            </svg>
            <span class="sr-only">Decrement</span>
        </button>

    </div>
</div>
