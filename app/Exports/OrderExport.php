<?php

namespace App\Exports;

use App\Models\Manage\Order;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrderExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $result = Order::with('driver', 'admin', 'vehicle', 'approvals', 'approvals.supervisor')
            ->get();
        return view('exports.order-export', [
            'order' => $result,
        ]);
    }
}
