@props(['quote', 'liked' => false])

@php
    $isMine = auth()->check() && $quote->user_id === auth()->id();
@endphp

@if ($isMine)
    {{-- My quote: purple, with edit / delete --}}
    <blockquote class="relative rounded-2xl bg-knox-purple p-5 text-white shadow">
        <p class="text-lg">“{{ $quote->content }}”</p>
        <p class="mt-2 text-sm font-semibold opacity-80">— {{ $quote->user->name }}
            <span class="text-xs opacity-70">· {{ $quote->created_at->format('Y-m-d') }}</span>
        </p>

        <div class="mt-3 flex items-center gap-4">
            <x-like-button :quote="$quote" :liked="$liked" :light="true" />
        </div>

        <div class="absolute right-4 bottom-5 flex items-center gap-3">
            <a href="{{ route('home', ['edit' => $quote->id]) }}" class="hover:text-knox-orange"
                aria-label="Edit">✎</a>

            <form method="POST" action="{{ route('quotes.destroy', $quote) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="hover:text-knox-orange" aria-label="Delete">⌫</button>
            </form>
        </div>
    </blockquote>
@else
    {{-- Someone else's quote: read only (+ like) --}}
    <blockquote class="rounded-2xl bg-[#082F4A] p-5 text-white shadow">
        <p class="text-lg">“{{ $quote->content }}”</p>
        <p class="mt-2 text-sm">
            <span class="font-semibold">— {{ $quote->user->name }}</span>
            <span class="text-xs opacity-70">· {{ $quote->created_at->format('Y-m-d') }}</span>
        </p>

        <div class="mt-3">
            <x-like-button :quote="$quote" :liked="$liked" />
        </div>
    </blockquote>
@endif
