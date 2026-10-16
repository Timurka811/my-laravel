<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'orders' => Order::count(),
            'new_orders' => Order::where('status', 'new')->count(),
            'revenue' => Order::where('status', '!=', 'cancelled')->sum('total'),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}