<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\DriverRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Master\Driver;

class DriverController extends Controller
{
    public function index()
    {
        $driver = Driver::simplePaginate(15);
        return view('pages.admin.master.driver.index', compact('driver'));
    }

    public function insert(DriverRequest $request)
    {
        $payload = $request->all();
        DB::beginTransaction();
        try {
            Driver::create($payload);
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
            $req = Driver::where('id', $id)->update([
                'name' => $request->name,
                'tipe_pegawai' => $request->tipe_pegawai
            ]);

            DB::commit();
            return redirect()->back()->with('Update success');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors($th->getMessage(), 'message');
        }
    }

    public function delete(Request $request, int $id)
    {
        DB::beginTransaction();
        try {
            Driver::where('id', $id)->delete();
            DB::commit();
            return redirect()->back()->with('Delete success');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors($th->getMessage(), 'message');
        }
    }
}
