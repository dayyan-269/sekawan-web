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
            $this->getApprovalStatus($orderId);
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollback();
            return redirect()->back()->with($th->getMessage());
        }
    }

    private function getApprovalStatus(int $orderId)
    {
        $approve = Approval::where('order_id', $orderId)->get('status');

        if ($approve->count() === 2) {
            if ($approve[0]->status === 'setuju' && $approve[1]->status === 'setuju') {
                Order::where('id', $orderId)->update([
                    'status' => 'selesai'
                ]);
            } else if ($approve[0]->status === 'tidak setuju' || $approve[1]->status === 'tidak setuju') {
                Order::where('id', $orderId)->update([
                    'status' => 'batal'
                ]);
            } else if ($approve[0]->status === 'menunggu' || $approve[1]->status === 'menunggu') {
                Order::where('id', $orderId)->update([
                    'status' => 'menunggu'
                ]);
            }
        }
    }
}
