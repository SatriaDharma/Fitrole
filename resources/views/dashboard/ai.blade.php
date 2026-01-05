@extends('layouts.app')

@section('title', 'Fitrole - AI Chatbot')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

<div class="max-w-7xl mx-auto h-[calc(100vh-140px)] flex flex-col">
    <div class="bg-white/80 backdrop-blur-md border border-slate-100 rounded-[2rem] px-8 py-5 flex items-center justify-between mb-4 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="relative group">
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg shadow-slate-200 group-hover:bg-emerald-600 transition-colors duration-300">
                    <svg class="h-6 w-6 text-emerald-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                    </svg>
                </div>
            </div>
            <div>
                <h2 class="text-lg font-black text-slate-800 tracking-tight">Fitrole AI</h2>
                <div class="flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <p class="text-[10px] text-emerald-600 font-black uppercase tracking-[0.2em]">Always Active</p>
                </div>
            </div>
        </div>
    </div>

    <div id="chatContainer" class="flex-1 overflow-y-auto px-2 space-y-6 mb-6 scroll-smooth scrollbar-hide">
        <div class="flex justify-start animate-fade-in">
            <div class="max-w-[80%] bg-white p-6 rounded-[2rem] rounded-tl-none border border-slate-100 shadow-sm text-slate-700 leading-relaxed font-medium chat-content">
                <p class="mb-3 text-xl">👋</p>
                Halo! Saya Fitrole AI, asisten kesehatan pintarmu. Senang sekali bisa menemanimu hari ini! Ada yang ingin kamu tanyakan seputar nutrisi, diet, atau rencana olahragamu?
            </div>
        </div>
    </div>

    <div class="relative group">
        <div class="absolute inset-x-0 -top-10 h-10 bg-gradient-to-t from-[#FDFBF7] to-transparent pointer-events-none"></div>
        <form id="aiChatForm" onsubmit="return handleFormSubmit(event)" class="relative">
            @csrf
            <input 
                type="text" id="userInput" 
                class="w-full bg-white border-2 border-slate-100 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/5 rounded-[2rem] pl-8 pr-20 py-6 text-slate-700 font-bold shadow-xl shadow-slate-200/50 outline-none transition-all placeholder:text-slate-300"
                placeholder="Tanya soal nutrisi, latihan, atau motivasi..."
                autocomplete="off"
            >
            <button 
                type="submit" id="submitBtn"
                class="absolute right-3 top-3 bottom-3 px-6 bg-slate-900 hover:bg-emerald-600 text-white rounded-2xl transition-all active:scale-95 flex items-center justify-center shadow-lg"
            >
                <svg class="w-5 h-5 transform rotate-90" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" /></svg>
            </button>
        </form>
        <p class="text-center text-[10px] text-slate-400 mt-4 font-bold uppercase tracking-widest">Powered by Gemini 2.5 Flash</p>
    </div>
</div>

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    
    .chat-content p { margin-bottom: 0.5rem; }
    .chat-content ul, .chat-content ol { margin-left: 1.5rem; margin-bottom: 1rem; }
    .chat-content ul { list-style-type: disc; }
    .chat-content ol { list-style-type: decimal; }
    .chat-content strong { color: #059669; font-weight: 800; }
</style>

<script>
    async function handleFormSubmit(event) {
        event.preventDefault();
        const input = document.getElementById('userInput');
        const container = document.getElementById('chatContainer');
        const message = input.value.trim();

        if (!message) return;

        container.insertAdjacentHTML('beforeend', `
            <div class="flex justify-end animate-fade-in mb-6">
                <div class="max-w-[80%] bg-emerald-600 text-white p-6 rounded-[2rem] rounded-tr-none shadow-lg shadow-emerald-200 font-medium leading-relaxed">
                    ${message}
                </div>
            </div>
        `);
        input.value = '';
        container.scrollTop = container.scrollHeight;

        const loadingId = 'loading-' + Date.now();
        container.insertAdjacentHTML('beforeend', `
            <div id="${loadingId}" class="flex justify-start animate-fade-in mb-6">
                <div class="max-w-[80%] bg-white p-6 rounded-[2rem] rounded-tl-none border border-slate-100 shadow-sm text-slate-400 font-medium">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-bounce"></span>
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-bounce [animation-delay:-0.15s]"></span>
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-bounce [animation-delay:-0.3s]"></span>
                    </div>
                </div>
            </div>
        `);
        container.scrollTop = container.scrollHeight;

        try {
            const response = await fetch("{{ route('dashboard.ai.ask') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            document.getElementById(loadingId).remove();

            if (data.status === 'success') {
                const formattedAnswer = marked.parse(data.answer);
                
                container.insertAdjacentHTML('beforeend', `
                    <div class="flex justify-start animate-fade-in mb-6">
                        <div class="max-w-[80%] bg-white p-6 rounded-[2rem] rounded-tl-none border border-slate-100 shadow-sm text-slate-700 leading-relaxed font-medium chat-content">
                            ${formattedAnswer}
                        </div>
                    </div>
                `);
            }
            container.scrollTop = container.scrollHeight;

        } catch (error) {
            console.error('Error:', error);
            document.getElementById(loadingId).innerHTML = `
                <div class="max-w-[80%] bg-rose-50 p-4 rounded-xl text-rose-600 text-sm">
                    Aduh, Fitrole lagi nggak enak badan. Coba tanya lagi nanti ya!
                </div>
            `;
        }
    }
</script>
@endsection