@props(['product', 'size' => 'w-14 h-14'])

@php
    $slug = strtolower($product->slug ?? $product->logo ?? '');
    $hasCustomImage = !empty($product->logo_image);
@endphp

@if($hasCustomImage)
    {{-- Priority 1: Custom uploaded image --}}
    <div class="{{ $size }} rounded-2xl overflow-hidden flex items-center justify-center shadow-md border border-gray-100 bg-white shrink-0 transition-transform group-hover:scale-105">
        <img src="{{ asset('storage/' . $product->logo_image) }}" 
             alt="{{ $product->name }}" 
             class="w-full h-full object-cover">
    </div>
@else
    {{-- Priority 2: Built-in SVG icons --}}
    <div class="{{ $size }} rounded-2xl flex items-center justify-center overflow-hidden shrink-0 transition-transform group-hover:scale-105 shadow-md
        @if($slug == 'chatgpt') bg-[#10a37f] shadow-emerald-200
        @elseif($slug == 'gemini') bg-slate-900 shadow-red-200
        @elseif($slug == 'netflix') bg-black shadow-red-200
        @elseif($slug == 'spotify') bg-[#1DB954] shadow-emerald-200
        @elseif($slug == 'adobe') bg-[#FF0000] shadow-red-200
        @elseif($slug == 'capcut') bg-black shadow-gray-300
        @elseif($slug == 'canva') bg-[#00C4CC] shadow-cyan-200
        @elseif($slug == 'google') bg-white border border-gray-100 shadow-gray-200
        @else bg-red-600 shadow-red-200
        @endif">

    @if($slug == 'chatgpt')
        <!-- Official ChatGPT / OpenAI Logo -->
        <svg class="w-2/3 h-2/3 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M22.2819 9.8211a5.9847 5.9847 0 0 0-.5157-4.9108 6.0462 6.0462 0 0 0-6.5098-2.9A6.0651 6.0651 0 0 0 4.9807 4.1818a5.9847 5.9847 0 0 0-3.9977 2.9 6.0462 6.0462 0 0 0 .7427 7.0966 5.98 5.98 0 0 0 .511 4.9107 6.051 6.051 0 0 0 6.5146 2.9001A5.9847 5.9847 0 0 0 13.2599 24a6.0557 6.0557 0 0 0 5.7718-4.2058 5.9894 5.9894 0 0 0 3.9977-2.9001 6.0557 6.0557 0 0 0-.7475-7.0729zm-9.022 12.6081a4.4755 4.4755 0 0 1-2.8764-1.0408l.1419-.0804 4.7783-2.7582a.7948.7948 0 0 0 .3927-.6813v-6.7369l2.02 1.1686a.071.071 0 0 1 .038.052v5.5826a4.504 4.504 0 0 1-4.4945 4.4944zm-9.6607-4.1254a4.47 4.47 0 0 1-.5355-3.0716l.142.0852 4.783 2.7582a.7712.7712 0 0 0 .7806 0l5.8428-3.3685v2.3324a.0804.0804 0 0 1-.0332.0615L9.74 19.9502a4.4992 4.4992 0 0 1-6.1408-1.6464zM2.3423 8.7056a4.485 4.485 0 0 1 2.3655-1.9728V12.26a.7665.7665 0 0 0 .3879.6765l5.8144 3.3543-2.0201 1.1685a.0757.0757 0 0 1-.071 0l-4.8303-2.7865A4.504 4.504 0 0 1 2.3423 8.7056zm16.0993 3.8558L12.6007 9.1929l2.02-1.1639a.0757.0757 0 0 1 .071 0l4.8303 2.7913a4.4944 4.4944 0 0 1-.6765 8.1042v-5.5259a.7948.7948 0 0 0-.3974-.6813zm2.0107-3.0231l-.142-.0852-4.7735-2.7818a.7759.7759 0 0 0-.7854 0L8.909 10.0388V7.7017a.071.071 0 0 1 .0331-.0615l4.8304-2.7866a4.504 4.504 0 0 1 6.6809 4.7187zM8.3072 12.8623l-2.02-1.1638a.0804.0804 0 0 1-.038-.0521V6.0638a4.504 4.504 0 0 1 7.3757-3.4537l-.142.0805-4.7783 2.7582a.7948.7948 0 0 0-.3927.6813v6.7322zm1.0986-1.8157l3.0475-1.761 3.0428 1.761v3.5173l-3.0428 1.761-3.0475-1.761z"/>
        </svg>

    @elseif($slug == 'gemini')
        <!-- Official Google Gemini 4-Point Sparkle Star -->
        <svg class="w-3/4 h-3/4" viewBox="0 0 24 24" fill="none">
            <path d="M12 0C12 6.62742 6.62742 12 0 12C6.62742 12 12 17.3726 12 24C12 17.3726 17.3726 12 24 12C17.3726 12 12 6.62742 12 0Z" fill="url(#gemini-sparkle-grad-{{ $product->id ?? 'def' }})"/>
            <defs>
                <linearGradient id="gemini-sparkle-grad-{{ $product->id ?? 'def' }}" x1="0" y1="0" x2="24" y2="24" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#1A73E8"/>
                    <stop offset="0.35" stop-color="#8E24AA"/>
                    <stop offset="0.7" stop-color="#D81B60"/>
                    <stop offset="1" stop-color="#E52592"/>
                </linearGradient>
            </defs>
        </svg>

    @elseif($slug == 'netflix')
        <!-- Official Netflix Red 'N' Icon -->
        <svg class="w-2/3 h-2/3 text-[#E50914]" viewBox="0 0 24 24" fill="currentColor">
            <path d="M5.398 0v24h4.42V12.793l4.636 11.207h4.408V0h-4.42v11.135L9.806 0H5.398z"/>
        </svg>

    @elseif($slug == 'spotify')
        <!-- Official Spotify Logo -->
        <svg class="w-2/3 h-2/3 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 0C5.376 0 0 5.376 0 12s5.376 12 12 12 12-5.376 12-12S18.624 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.48-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141 C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.3 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.18-1.38-.72-.18-.6.18-1.2.72-1.38C8.88 5.82 15.96 6.06 20.28 8.58c.54.3.72 1.02.42 1.56-.3.42-1.02.6-1.56.3z"/>
        </svg>

    @elseif($slug == 'adobe')
        <!-- Official Adobe Emblem -->
        <svg class="w-2/3 h-2/3 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M13.966 5.8h4.634L24 20.4h-4.634l-5.4-14.6zM0 20.4L5.4 5.8h4.634L4.634 20.4H0zm8.016-5.8h7.968l-3.984-10.8-3.984 10.8z"/>
        </svg>

    @elseif($slug == 'capcut')
        <!-- Official CapCut Logo -->
        <svg class="w-2/3 h-2/3 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M19.167 3.5H4.833C4.097 3.5 3.5 4.097 3.5 4.833v14.334c0 .736.597 1.333 1.333 1.333h14.334c.736 0 1.333-.597 1.333-1.333V4.833c0-.736-.597-1.333-1.333-1.333zm-4.75 12.25L9.5 12.5l4.917-3.25v6.5z"/>
        </svg>

    @elseif($slug == 'canva')
        <!-- Official Canva Logo Icon -->
        <svg class="w-2/3 h-2/3 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.63 0 12 0zm-1.8 17.5c-2.8 0-4.7-2.1-4.7-5.1 0-3.4 2.3-5.8 5.4-5.8 1.9 0 3.3.9 3.8 2.3l-1.6.8c-.4-.9-1.2-1.5-2.2-1.5-1.9 0-3.3 1.7-3.3 4.2 0 2.1 1.2 3.6 3.1 3.6 1.3 0 2.2-.6 2.7-1.6l1.6.8c-.8 1.5-2.2 2.3-4.8 2.3z"/>
        </svg>

    @elseif($slug == 'google')
        <!-- Official Google 4-Color 'G' Logo -->
        <svg class="w-2/3 h-2/3" viewBox="0 0 24 24">
            <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
            <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.29v3.15C3.3 21.3 7.37 24 12 24z"/>
            <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.29C.47 8.21 0 10.05 0 12s.47 3.79 1.29 5.42l3.99-3.15z"/>
            <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.37 0 3.3 2.7 1.29 6.58l3.99 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
        </svg>

    @else
        <span class="font-black text-white text-xl uppercase">{{ substr($product->name, 0, 1) }}</span>
    @endif
    </div>
@endif