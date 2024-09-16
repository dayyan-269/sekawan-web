<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\VehicleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Master\Vehicle;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicle = Vehicle::simplePaginate();
        return view('pages.admin.master.vehicle.index', compact('vehicle'));
    }

    public function insert(VehicleRequest $request)
    {
        $payload = $request->all();
        DB::beginTransaction();
        try {
            Vehicle::create($payload);
            DB::commit();
            return redirect()->back()->with('insert success');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors($th->getMessage(), 'message');
        }
    }

    public function update(Request $request, int $id)
    {
        $payload = $request->all();
        DB::beginTransaction();
        try {
            Vehicle::where('id', $id)->update([
                'no_kendaraan' => $request->no_kendaraan,
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'kepemilikan' => $request->kepemilikan,
                'status' => $request->status
            ]);
            DB::commit();
            return redirect()->back()->with('insert success');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors($th->getMessage(), 'message');
        }
    }

    public function delete(int $id)
    {
        DB::beginTransaction();
        try {
            Vehicle::where('id', $id)->delete();
            DB::commit();
            return redirect()->back()->with('Delete success');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors($th->getMessage(), 'message');
        }
    }
}
