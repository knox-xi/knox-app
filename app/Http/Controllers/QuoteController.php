<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use App\Models\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    /** Public: list all quotes (newest first, or most liked first). */
    public function index(Request $request)
    {
        $sort = $request->query('sort') === 'popular' ? 'popular' : 'latest';

        $query = Quote::with('user')->withCount('likes');

        if ($sort === 'popular') {
            $query->orderByDesc('likes_count');
        }

        $quotes = $query->latest()->get();

        // IDs of the quotes the current user already liked
        $likedIds = Auth::check()
            ? Auth::user()->likedQuotes()->pluck('quotes.id')->all()
            : [];

        return view('welcome', [
            'page' => 'Home',
            'quotes' => $quotes,
            'likedIds' => $likedIds,
            'sort' => $sort,
        ]);
    }

    public function store(QuoteRequest $request): RedirectResponse
    {
        Auth::user()->quotes()->create($request->validated());

        return redirect()->route('home');
    }

    public function update(QuoteRequest $request, Quote $quote): RedirectResponse
    {
        abort_unless($quote->user_id === Auth::id(), 403);

        $quote->update($request->validated());

        return redirect()->route('home');
    }

    public function destroy(Quote $quote): RedirectResponse
    {
        abort_unless($quote->user_id === Auth::id(), 403);

        $quote->delete();

        return redirect()->route('home');
    }
}
