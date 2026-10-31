@extends('Layout.app')

@section('title', 'Home')
@section('content')
    @php
        $editingId = request()->filled('edit') ? (int) request('edit') : null;
    @endphp

    <div class="mx-auto max-w-3xl p-8">

        @if ($errors->any())
            <div class="mb-4 rounded bg-red-100 p-3 text-sm text-red-700">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-white">Quotes</h2>

                {{-- Sort: newest / most liked --}}
                <div class="flex gap-3 text-sm">
                    <a href="{{ route('home') }}"
                        class="{{ $sort === 'latest' ? 'font-bold text-[#00D9FF]' : 'text-white hover:underline' }}">Newest</a>
                    <a href="{{ route('home', ['sort' => 'popular']) }}"
                        class="{{ $sort === 'popular' ? 'font-bold text-[#00D9FF]' : 'text-white hover:underline' }}">Most liked</a>
                </div>
            </div>

            @forelse ($quotes as $quote)
                @if (auth()->check() && $quote->user_id === auth()->id() && $quote->id === $editingId)
                    {{-- Edit mode (my quote only) --}}
                    <form method="POST" action="{{ route('quotes.update', $quote) }}"
                        class="space-y-3 rounded-2xl bg-knox-purple p-5 shadow">
                        @csrf
                        @method('PUT')

                        <textarea name="content" rows="3" required minlength="3" maxlength="155" class="input"
                            autofocus>{{ old('content', $quote->content) }}</textarea>

                        <div class="flex gap-2">
                            <button type="submit" class="btn btn-secondary">Save</button>
                            <a href="{{ route('home') }}" class="btn text-white hover:underline">Cancel</a>
                        </div>
                    </form>
                @else
                    <x-quote-card :quote="$quote" :liked="in_array($quote->id, $likedIds)" />
                @endif
            @empty
                <p class="text-gray-500">No quotes yet. Be the first to share one!</p>
            @endforelse
        </section>
    </div>

    @auth
        {{-- Floating "+" button --}}
        <button type="button" popovertarget="quote-popup" aria-label="Share a quote"
            class="fixed bottom-8 right-8 z-40 flex h-16 w-16 items-center justify-center rounded-full bg-knox-purple text-white shadow-xl transition hover:scale-110 hover:bg-knox-purple-light focus:outline-none focus-visible:ring-4 focus-visible:ring-knox-purple/30">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                stroke="currentColor" class="h-8 w-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button>

        {{-- Pop-up form --}}
        <div id="quote-popup" popover
            class="m-auto w-[90%] max-w-lg rounded-3xl bg-white p-0 shadow-2xl backdrop:bg-black/40 backdrop:backdrop-blur-sm">

            <form method="POST" action="{{ route('quotes.store') }}" class="space-y-4 p-6">
                @csrf
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-knox-purple">Share a quote</h2>
                    <button type="button" popovertarget="quote-popup" popovertargetaction="hide" aria-label="Close"
                        class="rounded-full p-1 text-gray-400 hover:bg-gray-100 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div>
                    <textarea id="quote-body" name="content" rows="5" required minlength="3" maxlength="155" autofocus
                        placeholder="Write your quote…"
                        class="input peer resize-none user-invalid:border-red-500">{{ old('content') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500 peer-user-invalid:text-red-600">3–155 characters.</p>
                </div>

                <button type="submit" class="btn btn-primary w-full">Send</button>
            </form>
        </div>
    @else
        <a href="{{ route('login') }}"
            class="fixed bottom-8 right-8 z-40 rounded-full bg-knox-purple px-6 py-4 text-white shadow-xl hover:bg-knox-purple-light">
            Log in to share a quote
        </a>
    @endauth
@endsection
