@props(['quote', 'liked' => false, 'light' => false])

@php
    $color = $light ? 'text-white' : 'text-white';
@endphp

@auth
    <form method="POST" action="{{ route('quotes.like', $quote) }}" class="inline">
        @csrf
        <button type="submit" class="flex items-center gap-1 {{ $color }} hover:scale-110 transition"
            aria-label="{{ $liked ? 'Unlike' : 'Like' }}">
            <span class="text-xl">{{ $liked ? '♥' : '♡' }}</span>
            <span class="text-sm">{{ $quote->likes_count }}</span>
        </button>
    </form>
@else
    <a href="{{ route('login') }}" title="Log in to like" class="flex items-center gap-1 {{ $color }} opacity-80">
        <span class="text-xl">♡</span>
        <span class="text-sm">{{ $quote->likes_count }}</span>
    </a>
@endauth
