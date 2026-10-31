<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /** Like the quote if not liked yet, otherwise remove the like. */
    public function toggle(Quote $quote): RedirectResponse
    {
        $quote->likes()->toggle(Auth::id());

        return back();
    }
}
