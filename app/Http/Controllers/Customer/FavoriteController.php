<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Http\Requests\Customer\FavoriteRequest;

class FavoriteController extends Controller
{
    public function index()
    {

        $favorites = auth()
            ->user()
            ->favorites()
            ->with('product', 'product.image', 'product.category')
            ->get();

        return view('customer.favorites.index')
            ->with('favorites', $favorites);
    }

    public function store(FavoriteRequest $request)
    {
        Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id
        ]);

        return redirect()
            ->route('favorites.index')
            ->with('success', '1 Product added to favorites.');
    }

    public function delete(Favorite $favorite)
    {
        $favorite->delete();
        return redirect()
            ->route('favorites.index')
            ->with('success', '1 Product removed from favorites.');
    }
}
