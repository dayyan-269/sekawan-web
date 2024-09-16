<?php
namespace App\Http\Controllers\Admin\Master;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manage\OrderRequest;
use App\Models\Account\Supervisor;
use App\Models\Manage\Approval;
use App\Models\Manage\Order;
use App\Models\Master\Driver;
use App\Models\Master\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index()
    {
        $supervisor = Supervisor::all('name', 'id');
        $driver = Driver::all('name', 'id');
        $vehicle = Vehicle::all('no_kendaraan', 'jenis_kendaraan', 'id');
        $order = Order::with('driver', 'admin', 'vehicle', 'approvals', 'approvals.supervisor')->get();

        return view('pages.admin.order.index', compact('supervisor', 'driver', 'vehicle', 'order'));
    }

    public function insert(OrderRequest $request)
    {
        $payload = [
            'admin_id' => $request->admin_id,
            'driver_id' => $request->driver_id,
            'vehicle_id' => $request->vehicle_id,
            'bbm' => $request->bbm,
            'tanggal_order' => $request->tanggal_order,
        ];

        DB::beginTransaction();
        try {
            $order = Order::create($payload);
            foreach ($request->supervisor_id as $key => $value) {
                Approval::create([
                    'order_id' => $order->id,
                    'supervisor_id' => $value
                ]);
            }
            DB::commit();
            return redirect()->back()->withInput();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function update(Request $request, int $id)
    {
        DB::beginTransaction();
        try {
            if ($request->status === 'selesai') {
                Order::where('id', $id)->update([
                    'status' => $request->status,
                    'tanggal_selesai' => date('Y-m-d'),
                ]);
            } else {
                Order::where('id', $id)->update([
                    'status' => $request->status,
                    'tanggal_selesai' => null
                ]);
            }
            $this->updateApproval($id, $request->status);
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with($th->getMessage());
        }
    }

    private function updateApproval(int $orderId, string $status)
    {
        $approval = Approval::where('order_id', $orderId)->get();
        $newStatus = function ($status) {
            if ($status === 'selesai') {
                return 'setuju';
            } else if ($status === 'batal') {
                return 'tidak setuju';
            } else {
                return 'menunggu';
            }
        };

        if ($approval->count() === 2) {
            foreach ($approval as $key => $value) {
                Approval::where('order_id', $orderId)->update([
                    'status' => $newStatus($status),
                ]);
            }
        }
    }

    public function delete(int $id)
    {
        DB::beginTransaction();
        try {
            Order::where('id', $id)->delete();
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with($th->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new OrderExport, 'order-export.xlsx');
    }
}
