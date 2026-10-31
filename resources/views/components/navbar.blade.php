<nav class="sticky top-0 z-50 flex items-center justify-between border-b border-white/20 bg-[#0B1B2B] px-6 py-3">
    <div class="flex items-center gap-4">
        @auth
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="btn-primary">Log Out</button>
            </form>
            <img src="/images/logo.png" alt="" class="h-11 w-11 rounded-full object-cover ring-2 ring-[#00D9FF]">
            <span class="text-white">{{ auth()->user()->name }}</span>
        @endauth
        @guest
            <a href="/login" class="btn-primary">Log In</a>
            <a href="/signup" class="btn-primary">Sign Up</a>
        @endguest
    </div>

    <a href="/" class="text-3xl font-bold tracking-wide text-[#00D9FF]">Knox</a>
</nav>