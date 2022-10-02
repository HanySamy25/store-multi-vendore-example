<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        // return Http::dd()->get('https://www.google.com/');
        // $response = Http::get('https://google.com');
        // dd($response->status());
        // dd($response);
        $products = Product::with('category')->active()
        //->latest()
        ->limit(8)
        ->get();

    return view('front.home', compact('products'));
    }
}
