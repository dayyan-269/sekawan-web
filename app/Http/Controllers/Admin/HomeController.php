<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manage\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $monthlyOrder = Order::select(
                DB::raw('COUNT(id) as total'),
                DB::raw('MONTH(tanggal_order) as month')
            )
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();

        $monthlyTotal = $monthlyOrder->map(fn($curr) => $curr->total);
        $monthlyTime = $monthlyOrder->map(function ($curr) {
            return Carbon::create()->month($curr->month)->format('F');
        })->toArray();
        $monthlyTime = json_encode($monthlyTime);
        
        $order = Order::with('driver', 'admin', 'vehicle', 'approvals', 'approvals.supervisor')->get();
        
        return view('pages.admin.home', compact('order', 'monthlyTotal', 'monthlyTime'));
    }
}
