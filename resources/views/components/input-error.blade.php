@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-[13px] text-red-500 font-medium space-y-1.5 mt-2 ml-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-start gap-1.5 animate-in fade-in slide-in-from-left-2">
                <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif