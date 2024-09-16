<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Account\Supervisor;
use App\Models\Manage\Approval;
use App\Models\Manage\Order;
use App\Models\Master\Driver;
use App\Models\Master\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        $supervisor = Supervisor::all('name', 'id');
        $driver = Driver::all('name', 'id');
        $vehicle = Vehicle::all('no_kendaraan', 'jenis_kendaraan', 'id');
        $order = Order::with('driver', 'admin', 'vehicle', 'approvals', 'approvals.supervisor')
            ->whereHas('approvals', function ($q) use ($request) {
                return $q->where('approvals.supervisor_id', $request->cookie('uid'));
            })
            ->get();
        //dd($order);
        return view('pages.supervisor.approval.index', compact('supervisor', 'driver', 'vehicle', 'order'));
    }

    public function approve(Request $request, int $orderId)
    {
        $payload = [
            'status' => $request->status
        ];

        DB::beginTransaction();
        try {
            Approval::where('order_id', $orderId)->where('supervisor_id', $request->cookie('uid'))->update($payload);

            $approve = Approval::where('order_id', $orderId)->get('status');
            $isApproved = $approve->contains('status', 'setuju');
            $isRejected = $approve->contains('status', 'tidak setuju');

            if ($isApproved) {
                Order::where('id', $orderId)->update([
                    'status' => 'selesai'
                ]);
            } else if ($isRejected) {
                Order::where('id', $orderId)->update([
                    'status' => 'batal'
                ]);
            } else {
                Order::where('id', $orderId)->update([
                    'status' => 'menunggu'
                ]);
            }

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollback();
            return redirect()->back()->with($th->getMessage());
        }
    }
}
