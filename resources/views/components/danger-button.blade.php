<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-white border-2 border-red-100 rounded-2xl font-bold text-xs text-red-600 uppercase tracking-widest hover:bg-red-600 hover:text-white hover:border-red-600 hover:shadow-lg hover:shadow-red-200 active:scale-95 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200'
]) }}>
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
    </svg>
    {{ $slot }}
</button>