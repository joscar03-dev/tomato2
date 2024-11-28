<?php

namespace Modules\TomatoProducts\App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class ProductPricesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(\Modules\TomatoProducts\App\Models\Product $model): View
    {
        return view('tomato-products::product-prices.index', compact('model'));
    }
}
