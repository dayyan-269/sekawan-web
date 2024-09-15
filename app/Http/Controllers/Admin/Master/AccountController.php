<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Account\Admin;
use App\Models\Account\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $admin = Admin::simplePaginate();
        $supervisor = Supervisor::simplePaginate();

        return view('pages.admin.master.account.index', compact('admin', 'supervisor'));
    }

    public function insert(Request $request)
    {
        $payload = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        DB::beginTransaction();

        try {
            if ($request->role === 'admin') {
                Admin::create($payload);
            } else {
                Supervisor::create($payload);
            }
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with($th->getMessage())->withInput();
        }
    }

    public function update(Request $request, int $id, string $role)
    {
        DB::beginTransaction();
        try {
            if ($role === 'admin') {
                Admin::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);
            } else {
                Supervisor::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);
            }
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with($th->getMessage())->withInput();
        }
    }

    public function delete(int $id, string $role)
    {
        DB::beginTransaction();

        try {
            if ($role === 'admin') {
                Admin::where('id', $id)->delete();
            } else {
                Supervisor::where('id', $id)->delete();
            }
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with($th->getMessage())->withInput();
        }
    }
}
